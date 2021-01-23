<?php
session_start();
include "connection.php";
$users = $mysqli->query("SELECT id,username,admin FROM users");
?>
<head>
<link rel="icon" type="image/png" href="images/icons/book.png">
<link rel="stylesheet" href="style.css">
</head>
<center>
<?php include('header.php'); ?>
<br>
<table border="1"> 
<?php 
while($row = $users->fetch_assoc()) { 
?>
<tr> 
<td>
<a href="user.php?id=<?php echo $row["id"] ?>">
<?php 
$admin = $row["admin"]; 
if ($admin == "true") {
echo "<img src=\"images/icons/user_gray.png\">";
} else {
echo "<img src=\"images/icons/user.png\">";
}
?>
<?php echo $row["username"]; ?>
</a>
</td>
</tr>
<?php
}
?>
</table>
<br>
<?php include('footer.php'); ?>
</center>
