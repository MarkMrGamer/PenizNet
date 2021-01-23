<?php
session_start();
?>
<head>
<link rel="icon" type="image/png" href="images/icons/book.png">
<link rel="stylesheet" href="style.css">
</head>
<center>
<?php include('header.php'); ?>
<br>
<table width="498" border="1">
<tbody><tr>
<td>
<h3>Welcome to PenizNet!</h3>
<?php
if(!isset($_SESSION['username'])) {
  echo "You're not currently signed in. <a href=\"login.php\">Log in here</a> or <a href=\"register.php\">sign up</a>";
} else {
}
?>
</td>
</tr>
</tbody></table>
<br>
<?php include('footer.php'); ?>
</center>
