<?php
require_once '../config/database_config.php';

$email = $_POST ["login_email"];
$password = md5 ( $_POST ["login_password"] );

$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
$result = $conn->query ( $sql );

if ($result->num_rows == 1) {
	if ($row = $result->fetch_assoc ()) {
		$_SESSION ["uuid"] = $row ["uuid"];
		http_response_code ( 200 );
	}
} else {
	http_response_code ( 400 );
}
?>