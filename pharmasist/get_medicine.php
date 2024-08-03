<?php
require_once "../database_config.php";

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
$d = new DateTime();
$d14 = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$d14->setTimezone($tz);
$d14->modify('14 days');
$date14days = $d14->format('Y-m-d');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT DISTINCT name, brand FROM medicines ";
$result = $conn->query($sql);

$medicines = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $medicines[] = $row;
    }
}

echo json_encode($medicines);

$conn->close();
