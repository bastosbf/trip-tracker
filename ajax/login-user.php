<?php
require_once '../config/database_config.php';

$email = $_POST ["login_email"];
$password = md5 ( $_POST ["login_password"] );

$sql = "SELECT uuid FROM user WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);

$stmt->execute();
$stmt->store_result();
$num_of_rows = $stmt->num_rows;
$stmt->bind_result($uuid);

if ($num_of_rows == 1) {
	if ($stmt->fetch()) {
		$_SESSION ["uuid"] = $uuid;
		http_response_code ( 200 );
	}
} else {
	http_response_code ( 400 );
}
$stmt->close();
?>