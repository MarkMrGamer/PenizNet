<?php
session_start();
include("connection.php");
if (!isset($_SESSION['username'])) {
	header('Location: /');
	exit();
}

	// initialize variables
	$username = $_SESSION['username'];
	
if (isset($_GET['id']))
{
$message = $_GET['id'];
$get_message = $mysqli->query("SELECT * FROM messages WHERE id = '$message'");
}
$result = $mysqli->prepare("SELECT * FROM messages WHERE id = ? LIMIT 0,1");
$result->bind_param('s', $message);
$result->execute();
$aaa = $result->get_result();
$resultrows = mysqli_num_rows($aaa);
$aaa2 = $get_message->fetch_assoc();
if ($get_message->num_rows == 0) {
     exit("can't delete a non-existing message");
}
else {
}
if ($aaa2['senderid'] == $_SESSION['id']) {
} else {
    exit("cannot delete someones message");
}
if ($resultrows < 0) {
    exit("can't delete a non-existing message");
}
else {
	$delete = $mysqli->query("DELETE FROM messages WHERE id = '$message'");
	header('Location: chat.php');
}
?>