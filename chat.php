<?php
session_start();
include "connection.php";
$message = $mysqli->query("SELECT * FROM messages ORDER BY id DESC");
?>
<html>
<head>
<link rel="icon" type="image/png" href="images/icons/book.png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">
</head>
<script>
$(document).ready(function() {
  var len = 0;
  var maxchar = 500;

  $( '#my-input' ).keyup(function(){
    len = this.value.length
    if(len > maxchar){
        return false;
    }
    else if (len > 0) {
        $( "#remainingC" ).html(( maxchar - len ) + " characters left" );
    }
    else {
        $( "#remainingC" ).html(( maxchar ) + " characters left" );
    }
  })
});

</script>
<center>
<?php include('header.php'); ?>
<br>
<table border="1" width="498">
<tbody><tr>
<td>
<form action="send_message.php" method="POST">
    <b>Chat</b><br>
    What are you up to or...
	<?php 
	if (isset($_SESSION['username'])) {
    echo "<textarea name=\"message\" style=\"margin: 0px; width: 493px; height: 52px;\" spellcheck=\"false\" maxlength=\"500\" id=\"my-input\"></textarea> <input type=\"submit\" value=\"Send\"> <span id='remainingC'></span>";
	} else {
    echo "you're not logged in";
    }
	?>
</form>
</td>
</tr>
</tbody></table>
<?php 
while($sender = $message->fetch_assoc()) { 
$sender2 = $sender["senderid"];
$message2 = $mysqli->query("SELECT * FROM users WHERE id = '$sender2'");
$sender3 = $message2->fetch_assoc();
?>
<br>
<table border="1" width="498">
<tbody><tr>
<td>
<img src="<?php echo $sender3["photo"]; ?>" align="left" width="50" height="50" onerror="this.onerror=null; this.src='images/default.png'"> <b><a href="user.php?id=<?php echo $sender["senderid"]; ?>"><?php echo $sender3["username"]; ?></a>
<?php 
$admin = $sender3["admin"]; 
if ($admin == "true") {
echo "<img src=\"images/icons/user_gray.png\">";
} else {
echo "<img src=\"images/icons/user.png\">";
}
?>
</b> 
<?php
if (isset($_SESSION['username'])) {
if ($sender3["username"] == $_SESSION['username']) {
echo "(<a href=\"delete_message.php?id=" . $sender["id"] . "\" align=\"right\">Delete</a>)";
} else {
}
}
?>
<br>
<?php echo $sender["message"]; ?>
</td>
</tr>
</tbody></table>
<?php
}
?>
<br>
<?php include('footer.php'); ?>
</center>
</html>