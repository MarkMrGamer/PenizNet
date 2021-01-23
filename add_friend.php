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
$result = $mysqli->prepare("SELECT user,request FROM friend_requests WHERE user = ? AND request = ? LIMIT 0,1");
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
     exit("can't send a friend request to non existing user");
}
else {
}
if ($user == $_SESSION['username']) {
	exit("you cannot friend yourself :'(");
}
if ($resultrows > 0 && $resultrows1 == 0) {
    echo 'already sent a request!';
}
if ($resultrows == 0 && $resultrows1 == 1) {
    echo 'your friends with the user already!';
}
if ($resultrows1 > 0) {
    echo 'your friends with the user already!';
}
else {
    $stmt = $mysqli->prepare("INSERT INTO friend_requests (user,request) VALUES (?,?)");
	$stmt->bind_param('ss', $username, $user);
	$stmt->execute();
	echo 'sent a friend request to user!';
}
?>