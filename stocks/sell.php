<?php

session_start();

require("connection.php");
require("fetch.php");
require("stocks.php");

if(isset($_SESSION['username']) && isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT * FROM stocks WHERE id = ?");
	$stmt->bind_param("s", $_GET['id']);
	$stmt->execute();
	$result = $stmt->get_result();
	while($row = $result->fetch_assoc()) {
        $stockName = $row['stockname'];
        $amount = $row['amount'];
	} 
	$stmt->close();

    $currentBobux = floatval($nav['money']);
    $stockAmount = (int)htmlspecialchars($amount);
    $stockPrice = getStockPrice($stockName, $mysqli);

    if($stockPrice < 0) {
        die("lmao STOck CRASHED");
    }

    $stockPrice = $stockPrice * ((rand(1, 5) / 85) + 1);

    if(checkIfOwnsStock($_SESSION['username'], $_GET['id'], $mysqli) != false) {
        die("You do not own this stock!");
    } 
    
    $final = $currentBobux + ($stockAmount * $stockPrice);

    $stmt = $mysqli->prepare("UPDATE users SET money = ? WHERE username = ?");
    $stmt->bind_param("ds", $final, $_SESSION['username']);
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("DELETE FROM stocks WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
} else {
    die("you aren't logged in or didnt provide enough arguments");
}
?>