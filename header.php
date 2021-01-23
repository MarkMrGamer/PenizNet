<title>PenizNet</title>
<table border="1" width="500">
<tbody>
<tr>
<td>
<h1>PenizNet</h1>
<?php
if(isset($_SESSION['username'])) {
echo "Logged as " . $_SESSION['username'];
}
?>
<?php
if(isset($_SESSION['username'])) {
include "connection.php";
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $mysqli->query($query);
$nav = $result->fetch_assoc();
echo "<img src=\"images/icons/coins.png\" style=\"float:right;\" title=\"Penies\"><span style=\"float:right;\">" . $nav['money'] . "</span>";
}
?>
</td>
</tr>
<tr>
<td>
<?php
if(isset($_SESSION['username'])) {
?>
<img src="images/icons/house.png"><a href="home.php">Home</a> | <img src="images/icons/comment.png"><a href="chat.php">Chat</a> | <img src="images/icons/user.png"><a href="users.php">Users</a> | <img src="images/icons/chart_bar.png"><a href="/stocks">Stocks</a> | <img src="images/icons/email.png"><a href="mail.php">Mail(<?php echo $nav['mail']; ?>)</a> | <img src="images/icons/key.png"><a href="logout.php">Log Out</a>
<?php
}else{ 
?>
<img src="images/icons/house.png"><a href="home.php">Home</a> | <img src="images/icons/comment.png"><a href="chat.php">Chat</a> | <img src="images/icons/user.png"><a href="users.php">Users</a> | <img src="images/icons/chart_bar.png"><a href="/stocks">Stocks</a> | <img src="images/icons/key.png"><a href="login.php">Login</a>
<?php
}
?>
</td>
</tr>
</tbody>
</table>