<?php
// get_medicine.php
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = "Chalithac*#3031"; // Your database password
$dbname = "healthcare"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT name, quantity FROM mlt_equipments";
$result = $conn->query($sql);

$medicines = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $medicines[] = $row;
    }
}

echo json_encode($medicines);

$conn->close();
