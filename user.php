<?php
session_start();
include "connection.php";

if (isset($_GET['id'])) 
{
$id = $_GET['id'];
$user = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
if ($user->num_rows == 1) {
$details = $user->fetch_assoc();
}
if ($user->num_rows == 0) {
die("user not found");
}
}
?>
<head>
<link rel="icon" type="image/png" href="images/icons/book.png">
<link rel="stylesheet" href="style.css">
<style>
body {
<?php
if (empty($details["background"])) { 
echo "background-image: url(\"https://cdn.discordapp.com/attachments/777384344523505697/802320276058144768/stripes.png\");";
} else {
echo "background-image: url(\"" . $details["background"] . "\");";
}
?>
}
</style>
</head>
<center>
<?php include('header.php'); ?>
<br>
<table border="1" width="498">
<tbody><tr>
<td>
<h3>
<?php echo $details["username"] ?>
<?php 
$admin = $details["admin"]; 
if ($admin == "true") {
echo "<img src=\"images/icons/user_gray.png\" title=\"Administrator\">";
} else {
echo "<img src=\"images/icons/user.png\" title=\"User\">";
}
?>
<img src="<?php echo $details["photo"] ?>" align="right" width="100" height="100" onerror="this.onerror=null; this.src='images/default.png'">
</h3>
<?php 
if (empty($details["about"])) {
echo "<br>";
} else {
echo "<b>About Me:</b><br>" . $details["about"] . "<br><br>";
}
?>
<?php 
if (isset($_SESSION['username'])) {
$username1 = $_SESSION['username'];
$username = $details["username"];
$user2 = $mysqli->query("SELECT * FROM friends WHERE (user = '$username1' AND friend='$username') OR (user = '$username' AND friend='$username1')");
if ($user2->num_rows > 0) {
echo "<img src=\"images/icons/user_delete.png\"><a href=\"remove_friend.php?user=" . $details["username"] . "\">Remove Friend</a><br>";
} else {
echo "<img src=\"images/icons/user_add.png\"><a href=\"add_friend.php?user=" . $details["username"] . "\">Add as Friend</a><br>";
}
}
?>
<img src="images/icons/report_user.png"><a href="report_user.php?id=<?php echo $details["id"] ?>">Report User</a>
</td>
</tr>
</tbody></table>
<br>
<?php include('footer.php'); ?>
</center>