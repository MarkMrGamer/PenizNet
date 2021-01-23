<?php
session_start();
include("connection.php");

if (!isset($_SESSION['username'])) {
	header('Location: /');
	exit();
}

	// initialize variables
	$username = $_SESSION['username'];
	
if (isset($_GET['user']))
{
$user = $_GET['user'];
$get_user = $mysqli->query("SELECT * FROM users WHERE username = '$user'");
}
$result = $mysqli->prepare("SELECT id,user,request FROM friend_requests WHERE user = ? AND request = ? LIMIT 0,1");
$result->bind_param('ss', $username, $user);
$result->execute();
$aaa = $result->get_result();
$resultrows = mysqli_num_rows($aaa);
$result1 = $mysqli->prepare("SELECT * FROM friends WHERE user = ? AND friend = ? LIMIT 0,1");
$result1->bind_param('ss', $username, $user);
$result1->execute();
$aaa1 = $result1->get_result();
$resultrows1 = mysqli_num_rows($aaa1);
if ($get_user->num_rows == 0) {
     exit("can't remove friend to non existing user");
}
else {
}
if ($resultrows < 0) {
    echo 'cannot remove a friend if not friend request';
}
else {
	$details1 = $mysqli->query("SELECT * FROM friends WHERE user = '$user' OR friend = '$user'");
	$details = $details1->fetch_assoc();
	$user1 = $details["user"];
	$user2 = $details["friend"];
	$stmtdelete = $mysqli->query("DELETE FROM friends WHERE (user = '$user1' AND friend = '$user2') OR (user = '$user2' AND friend = '$user1')");
	echo 'removed a friend!';
}
?>