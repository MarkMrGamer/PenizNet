<?php
session_start();
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
<table border="1" width="498" height="500">
<tr>
<td>
</td>
<td>
</td>
</tr>
</table>
<br>
<?php include('footer.php'); ?>
</center>
</html>