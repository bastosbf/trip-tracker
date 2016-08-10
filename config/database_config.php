<?php
session_start();

$host = "localhost"; 
$db = "trip_tracker";
$user = "root";
$password = "";


$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>
