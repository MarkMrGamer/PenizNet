<?php
session_start();
include "connection.php";
if (!isset($_SESSION['username'])) {
header('Location: /');
}
// sending message
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // variables
    $message = htmlspecialchars($_POST['message']);
	$id = $_SESSION['id'];
	
        //send le message
        $query1 = $mysqli->prepare("INSERT INTO messages (message,senderid) VALUES (?,?)");
        $query1->bind_param('ss', $message, $id);
        $query1->execute();
        $query1->close();
        header('Location: chat.php');
}
?>