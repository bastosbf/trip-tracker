<?php
require_once '../config/database_config.php';

$country = $_POST ["country"];

$sql = "SELECT id, latitude, longitude, name FROM state WHERE country_id = ?";
$stmt = $conn->prepare ( $sql );
$stmt->bind_param ( "i", $country );
$stmt->execute ();
$stmt->store_result ();
$num_of_rows = $stmt->num_rows;
$stmt->bind_result ( $id, $latitude, $longitude, $name );
if ($num_of_rows > 0) {
	echo '<option value="0">Select the state</option>';
	while ( $stmt->fetch () ) {
		echo '<option value="' . $id . ':' . $latitude . ':' . $longitude . '">' . $name . '</option>';
	}
}
$stmt->close ();
?>