<?php
session_start();
include "connection.php";
if (!isset($_SESSION['username'])) {
header('Location: /');
}
$friend = $_SESSION['username'];
$friendrequests = $mysqli->query("SELECT * FROM friend_requests WHERE request = '$friend'");
?>
<html>
<head>
<link rel="icon" type="image/png" href="images/icons/book.png">
<link rel="stylesheet" href="style.css">
</head>
<center>
<?php include('header.php'); ?>
<br>
<table border="1" width="498">
<tr>
<td>
<h3>Welcome <?=$_SESSION['username']?>!</h3>
<img src="images/icons/cog.png"><a href="manage.php">Manage Profile</a><br>
<img src="images/icons/key.png"><a href="logout.php">Log Out</a>
</td>
</tr>
</table>
<br>
<table border="1" width="498">
<tr>
<td>
<h3>Friend Requests</h3>
<?php 
while($row = $friendrequests->fetch_assoc()) { 
?>
<?php echo $row["user"]; ?> <a href="accept_friend.php?user=<?php echo $row["user"]; ?>">Accept</a> | <a href="deny_friend.php?user=<?php echo $row["user"]; ?>">Deny</a><br>
<?php
}
?>
</td>
</tr>
</table>
<br>
<?php include('footer.php'); ?>
</center>
</html>
