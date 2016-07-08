<?php
require_once '../config/database_config.php';

$uuid = $_SESSION ["uuid"];
$state = split(":", $_POST ["trip_state"])[0];
$date = $_POST ["trip_date"];

$latitude = isset($_POST ["trip_latitude"]) ? $_POST ["trip_latitude"] : null;
$longitude = isset($_POST ["trip_longitude"]) ? $_POST ["trip_longitude"] : null;

if ($latitude != null && $longitude  != null) {
	$sql = "UPDATE state SET latitude = ?, longitude = ? WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ddi", $latitude, $longitude, $state);
	$stmt->execute();
	$stmt->close();
}

/*if(!file_exists("../photos/$uuid")) {
	mkdir("../photos/$uuid");
}

$source = $_FILES ["trip_photo"] ["tmp_name"];
$filename = $_FILES ["trip_photo"] ["name"];
$target = "../photos/$uuid/$filename";
move_uploaded_file ( $source, $target );

$sql = "INSERT INTO trip (user_id, state_id, date, photo) VALUE (?, ?, ? ,?)";*/
$sql = "INSERT INTO trip (user_id, state_id, date) VALUE (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $uuid, $state, $date);
if ($stmt->execute() === TRUE) {
	http_response_code ( 200 );
} else {
	http_response_code ( 400 );
}
$stmt->close();
?>