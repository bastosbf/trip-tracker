<?php
require_once '../config/database_config.php';

$name = $_POST ["register_name"];
$email = $_POST ["register_email"];
$password = md5 ( $_POST ["register_password"] );

$uuid = uniqid(substr($email, 0,3));

$sql = "INSERT INTO user (uuid, name, email, password) VALUE ('$uuid', '$name', '$email', '$password')";
if ($conn->query ( $sql ) === TRUE) {
	$_SESSION ["uuid"] = $uuid;
	http_response_code ( 200 );
} else {
	http_response_code ( 400 );
}
?>