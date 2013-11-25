<?php
session_start();
$phone = $_SESSION['phone'];

$con = mysql_connect("localhost", "heart", "F0undAti0n#1");
mysql_select_db("db_heart_foundation");

$query = "SELECT cbalance,abalance FROM account where phoneNumber='$phone'";
$result = mysql_query($query);
echo "<table padding='10px'>";

while ($row = mysql_fetch_array($result)) {
	echo "<tr><th>Available Balance:</th><td>" . $row['abalance'] . "</td></tr>";
	echo "<tr><th>Current Balance:</th><td>" . $row['cbalance'] . "</td></tr>";
}
echo "</table>";

mysql_close($con);
?>