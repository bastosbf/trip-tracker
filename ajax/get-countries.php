<?php
require_once '../config/database_config.php';

$sql = "SELECT * FROM country";
$result = $conn->query ( $sql );
if ($result->num_rows > 0) {
	echo '<option value="0">Select the country</option>';
	while ( $row = $result->fetch_assoc () ) {
		echo '<option value="' . $row ["id"] . '">' . $row ["name"] . '</option>';
	}
}
?>