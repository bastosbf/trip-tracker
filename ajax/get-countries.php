<?php
require_once '../config/database_config.php';

$sql = "SELECT id, name FROM country";
$stmt = $conn->prepare ( $sql );
$stmt->execute ();
$stmt->store_result ();
$num_of_rows = $stmt->num_rows;
$stmt->bind_result ( $id, $name );
if ($num_of_rows > 0) {
	echo '<option value="0">Select the country</option>';
	while ( $stmt->fetch () ) {
		echo '<option value="' . $id . '">' . $name . '</option>';
	}
}
?>