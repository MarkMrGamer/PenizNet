<?php
session_start();
include "connection.php";
if (!isset($_SESSION['username'])) {
header('Location: /');
}
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
<h3>Manage Profile</h3>
<br>
<form method="POST" action="update.php">
<address>About Me:</address>
<textarea name="about" style="width:300px;height:100px;"><?php echo $nav['about']; ?></textarea>
<br><br>
<address>Profile Background:</address>
<input type="text" name="background" value="<?php echo $nav['background']; ?>">
<br><br>
<address>Profile Picture:</address>
<input type="text" name="photo" value="<?php echo $nav['photo']; ?>">
<br><br>
<input type="submit" value="Update">
</form>
</td>
</tr>
</table>
<br>
<?php include('footer.php'); ?>
</center>
</html>