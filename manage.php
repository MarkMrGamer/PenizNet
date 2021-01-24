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
<form method="POST" action="update.php" enctype="multipart/form-data">
<br>
<address>About Me:</address>
<textarea name="about" style="width:300px;height:100px;"><?php echo $nav['about']; ?></textarea>
<br><br>
<address>Profile Background:</address>
  <input type="file" name="image" id="image" accept="image/x-png,image/gif,image/jpeg" />
  <input type="submit" value="Update Background" name="file">
<br><br>
<address>Profile Picture:</address>
  <input type="file" name="image2" id="image2" accept="image/x-png,image/gif,image/jpeg" />
  <input type="submit" value="Update Picture" name="file2">
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