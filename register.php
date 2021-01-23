<?php
session_start();
if (isset($_SESSION['username'])) {
header('Location: /');
}
?>
<head>
<link rel="icon" type="image/png" href="images/icons/book.png">
<link rel="stylesheet" href="style.css">
</head>
<center>
<?php include('header.php'); ?>
<br>
<form method="POST" action="reg.php">
<label>Username:</label><br>
<input type="text" name="username"><br>
<label>Password:</label><br>
<input type="password" name="password"><br>
<label>Confirm Password:</label><br>
<input type="password" name="password2"><br><br>
<input type="submit">
<br>
<?php include('footer.php'); ?>
</center>