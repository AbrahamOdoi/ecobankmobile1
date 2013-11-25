<?php
session_start();
$phoneNum = $_POST['phone'];
$pin = $_POST['pin'];

// $dbcon = mysql_connect("localhost", "root", "");
// mysql_select_db("test");

$dbcon = mysql_connect("localhost", "heart", "F0undAti0n#1");
mysql_select_db("db_heart_foundation");


$query="select * from account where phoneNumber='$phoneNum' and pin='$pin'";
$execute=mysql_query($query);
$rowNum=mysql_num_rows($execute);

if ($rowNum>0) {
	echo "1";
} else {
	echo "0";
}

?>