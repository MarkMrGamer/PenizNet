<?php
session_start();

require("connection.php");
require("fetch.php");
require("stocks.php");


if(isset($_SESSION['username']) && isset($_GET['name']) && isset($_GET['amount'])) {
    $currentBobux = floatval($nav['money']);
    $stockName = htmlspecialchars($_GET['name']);
    $stockAmount = (int)htmlspecialchars($_GET['amount']);
    $stockPrice = getStockPrice($stockName, $mysqli);
    $tax = (rand(0, 5) / 100);
    $newAmount = $stockPrice * $tax;
    $newStockPrice = $stockPrice * ((rand(-30, 40) / 100) + 1);

    if($stockAmount <= 0) {
        die("no");
    }
    //check if bankrupt
    if($currentBobux <= 0) {
        die("you're bankrupt. tell site owner to reset ur money");
    } 

    if($stockPrice < 0) {
        die("THIS STOCK HAS CRASHED!");
    }

    //check if stock dont exist
    if(doesStockExist($stockName, $mysqli) != true) {
        die("stock doesn't exist");
    } 

    $final = ($currentBobux - ($stockPrice * $stockAmount)) - $newAmount;

    //check if will in be debt after buying
    if($final <= 0) {
        die("you can't buy or Go Debt");
    }

    $stmt = $mysqli->prepare("UPDATE stocknames SET price = ? WHERE coname = ?");
    $stmt->bind_param("ds", $newStockPrice, $stockName);
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("UPDATE users SET money = ? WHERE username = ?");
    $stmt->bind_param("ds", $final, $_SESSION['username']);
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("INSERT INTO stocks (stockname, amount, owner) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $stockName, $stockAmount, $_SESSION['username']);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
} else {
    die("you aren't logged in or didnt provide enough arguments");
}
?>