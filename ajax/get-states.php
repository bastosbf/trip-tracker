<?php
require_once '../config/database_config.php';

$country = $_POST ["country"];

$sql = "SELECT * FROM state WHERE country_id = $country";
$result = $conn->query ( $sql );
if ($result->num_rows > 0) {
	echo '<option value="0">Select the state</option>';
	while ( $row = $result->fetch_assoc () ) {
		echo '<option value="' . $row ["id"] . ':'. $row ["latitude"] . ':' .$row ["longitude"] .'">' . $row ["name"] . '</option>';
	}
}
?>