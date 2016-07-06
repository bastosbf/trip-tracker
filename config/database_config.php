<?php
session_start();

#mysql.hostinger.com.br
$host = "localhost"; 
#u170290546_trip
$db = "trip_tracker";
#u170290546_trip
$user = "root";
#EoCUT7s084
$password = "123456";



$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>
