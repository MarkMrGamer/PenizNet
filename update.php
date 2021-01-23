<?php
session_start();
include "connection.php";
if (!isset($_SESSION['username'])) {
header('Location: /peniznet');
}
// update profile
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // variables
    $about = htmlspecialchars($_POST['about']);
    $background = addslashes($_POST['background']);
	$photo = addslashes($_POST['photo']);
    $username = $_SESSION['username'];
	
        //start updating
        $query1 = $mysqli->prepare("UPDATE users SET about = ?, background = ?, photo = ? WHERE username = ?");
        $query1->bind_param('ssss', $about, $background, $photo, $username);
        $query1->execute();
        $query1->close();
        die("updated your profile!");
}
?>