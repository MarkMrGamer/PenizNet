<?php
if(isset($_SESSION['username'])) {
$name2 = $_SESSION['username'];
$query2 = "SELECT * FROM stocks WHERE owner = '$name2'";
$result2 = $mysqli->query($query2);
$nav2 = $result2->fetch_assoc();
}
$id2 = $nav2['id'];
function doesStockExist($name2, $connection) {
	$stmt = $connection->prepare("SELECT * FROM stocknames WHERE coname = ?");
	$stmt->bind_param("s", $name2);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) { return false; } else { return true;}
	$stmt->close();
}

function getStockPrice($name2, $connection) {
	$stmt = $connection->prepare("SELECT * FROM stocknames WHERE coname = ?");
	$stmt->bind_param("s", $name2);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) return('error');
	while($row = $result->fetch_assoc()) {
		$price = $row['price'];
	} 
	$stmt->close();
	return $price;
}

function checkIfOwnsStock($name2, $id, $connection) {
	$stmt = $connection->prepare("SELECT * FROM stocks WHERE owner = ? AND id = ?");
	$stmt->bind_param("ss", $name2, $id2);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 1) { return true; } else { return false; }
	$stmt->close();
}
?>