<!DOCTYPE html>
<?php 
session_start();
include('connection.php');
require("fetch.php");
$tax = 0.04;
?>
<html>
	<head>
		<title>your moms - stocks</title>
		<script src='https://www.google.com/recaptcha/api.js' async defer></script>
		<link rel="stylesheet" href="../style.css">
        <script>function onLogin(token){ document.getElementById('submitform').submit(); }</script>
		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['User', 'Money'],
                <?php
                    $stmt = $mysqli->prepare("SELECT money, username FROM users");
                    $stmt->execute();
                    $result1 = $stmt->get_result();
                
                    while($row = $result1->fetch_assoc()) { 
                        echo "['" . $row['username'] . "', " . $row['money'] . "]," . PHP_EOL;
                    }
                ?>
                ['',     0]
            ]);

            var options = {
                title: 'Cash'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
        </script>
		<style>
		table {
        background-color: white;
        color: black;
        }
		</style>
	</head>
	<center>
	    <table border="1">
<tr>
<td>
            <h1>stocks</h1>
            welcome to the (totally) very predictable virtual stock market where you can dump money and lose hundreds of bobux<br><small>DO NOT TAKE THIS SERIOUSLY!!!!</small>
            <p>Stock War I</p>
			<br><br>
            <form method="get" action="buy.php">
				<fieldset>
					Buy: <input required placeholder="Stock Name" type="text" name="name"> <input required placeholder="Amount" type="number" name="amount"> <input type="submit" value="Buy">
				</fieldset>
            </form><hr>
			          <form method="get" action="buy.php">
				<fieldset>
					<input required placeholder="Amount" type="hidden" name="amount" value="100"> <input required placeholder="Stock Name" type="text" name="name"> <input type="submit" value="Buy Max">
				</fieldset>
            </form><hr>
            <h2 style="margin: 0px;">owned stocks</h2>
            <?php 
                $stmt = $mysqli->prepare("SELECT * FROM stocks WHERE owner = ?");
                $stmt->bind_param("s", $_SESSION['username']);
                $stmt->execute();
                $result = $stmt->get_result();
            
                while($row = $result->fetch_assoc()) { 
                    echo "<b>" . $row['amount'] . "</b> of <b>" . $row['stockname'] . "</b> | <a href='sell.php?id=" . $row['id'] . "'>Sell</a><br>";
                }
            ?>
            <hr>
            <br>You have <?php if(isset($_SESSION['username'])) { echo "<b>" . $nav['money'] . "</b> Penies"; } else { echo "Not Logged in"; } ?><br><b>Current Tax Rate:</b> <?php echo $tax; ?> * Price of Stock<br>
            You must input their corperate name, for example: BBUX = Bobux Inc.<br><br>
				    <table border="1" style="background-color: #0000A0;color:#ADD8E6;">
<tr>
<td>
            <?php 
                $stmt = $mysqli->prepare("SELECT * FROM stocknames");
                $stmt->execute();
                $result = $stmt->get_result();
            
                while($row = $result->fetch_assoc()) { 
                    $finalTax = $row['price'] * $tax;
                    echo '<b>[' . $row['coname'] . '] ' . $row['name'] . '</b> <b>[' . $row['price'] . ' <img src="/images/icons/money.png"> + ' . $finalTax . ' <img src="/images/icons/money.png">]</b><br>';
                }
            ?>
			</td>
					</tr>
</table>
            <hr>
			<div id="piechart" style="width: 1200px; height: 500px;"></div>
            <address>powered by the arcader engine, modified
		</tr>
</td>
</table>
</center>
	</body>
</html>