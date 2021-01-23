<?php
session_start();
include "connection.php";
if (isset($_SESSION['username'])) {
header('Location: /');
}
// register
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    // variables
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = "none@email.com";

    //check to see if user in database
    $query = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($password2 == $password)
    {
    }
    else
    {
        die("passwords not same");
    }
    if (empty($username))
    {
        die("Username required");
    }
    if (empty($password) && empty($password2))
    {
        die("Password required");
    }
    if ($result->num_rows > 0)
    {
        die("user already taken");
    }
    else
    {
        $query->close();
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query1 = $mysqli->prepare("INSERT INTO users (username,password,email) VALUES (?,?,?)");
        $query1->bind_param('sss', $username, $password_hash, $email);
        $query1->execute();
        $query1->close();
        die("user inserted <a href=\"login.php\">login</a>");
    }
}
?>