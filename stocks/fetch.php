<?php
if(isset($_SESSION['username'])) {
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $mysqli->query($query);
$nav = $result->fetch_assoc();
}
?>