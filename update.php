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
    $username = $_SESSION['username'];
	
	if(isset($_POST["file"])) {
    $target_file = $_FILES['image']['name'];
	$file_type=$_FILES['image']['type'];
	$file_tmp =$_FILES['image']['tmp_name'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	$file1 = "images/uploads/". $target_file;
    $extensions= array("jpeg","jpg","png","gif");
    $temp = explode(".", $_FILES["image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
	$file1 = "images/uploads/" . $newfilename;
	 
      if(in_array($file_ext,$extensions)=== false){
		 die("extension not allowed, please choose a JPEG,GIF or PNG file.");
      } else {
        $query1 = $mysqli->prepare("UPDATE users SET background = ? WHERE username = ?");
        $query1->bind_param('ss', $file1, $username);
        $query1->execute();
        $query1->close();
		move_uploaded_file($file_tmp,"images/uploads/".$newfilename);
        die("updated your profile background!");
	  }
	}
	
	if(isset($_POST["file2"])) {
    $target_file = $_FILES['image2']['name'];
	$file_type=$_FILES['image2']['type'];
	$file_tmp =$_FILES['image2']['tmp_name'];
    $file_ext=strtolower(end(explode('.',$_FILES['image2']['name'])));
	$file2 = "images/uploads/". $target_file;
    $extensions= array("jpeg","jpg","png","gif");
    $temp = explode(".", $_FILES["image2"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
	$file2 = "images/uploads/" . $newfilename;
	
      if(in_array($file_ext,$extensions)=== false){
		 die("extension not allowed, please choose a JPEG,GIF or PNG file.");
      } else {
        $query1 = $mysqli->prepare("UPDATE users SET photo = ? WHERE username = ?");
        $query1->bind_param('ss', $file2, $username);
        $query1->execute();
        $query1->close();
		move_uploaded_file($file_tmp,"images/uploads/".$newfilename);
        die("updated your profile picture!");
	  }
	}
	
        $query1 = $mysqli->prepare("UPDATE users SET about = ? WHERE username = ?");
        $query1->bind_param('ss', $about, $username);
        $query1->execute();
        $query1->close();
        die("updated your profile!");
}
?>