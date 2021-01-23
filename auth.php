<?php
session_start();
include "connection.php";
if (isset($_SESSION['username'])) {
header('Location: /');
}
// login
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    // variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    //check to see if user in database
    $query = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();
	$db = $result->fetch_assoc();
    
    if (password_verify($password, $db['password'])) 
	{
    } 
	else 
	{
        die("Invalid password or username.");
    }
    if ($result->num_rows == 0)
    {
		$query->close();
        die("no user in db");
    }
    else
    {
        $query->close();
        session_regenerate_id();
		$usernamecheck = htmlspecialchars($db['username']);
		$_SESSION['username'] = $usernamecheck;
		$_SESSION['photo'] = $db['photo'];
		$_SESSION['id'] = $db['id'];
		header('Location: home.php');
    }
}
?>