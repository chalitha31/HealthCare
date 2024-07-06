<?php
require_once "../database_config.php";

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$medicineName = $_POST['medicineName'];
// $medicineBrand = $_POST['medicineBrand'];
$medicineQuantity = $_POST['medicineQuantity'];
// $expirationDate = $_POST['expirationDate'];

// Check if the row already exists
$sql = "SELECT id, quantity FROM mlt_equipments WHERE name = '$medicineName'";
$result = $conn->query($sql);

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
// $date = $d->format('Y-m-d H:i:s');
$date = $d->format('Y-m-d');

if ($result->num_rows > 0) {
    // Row exists, update the quantity
    $row = $result->fetch_assoc();
    $newQuantity = $row['quantity'] + $medicineQuantity;
    $updateQuantity = $row['avalable_quantity'] + $medicineQuantity;
    $updateSql = "UPDATE mlt_equipments SET quantity = $newQuantity , avalable_quantity = $updateQuantity WHERE id = " . $row['id'];

    if ($conn->query($updateSql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Row does not exist, insert a new row
    $insertSql = "INSERT INTO mlt_equipments (name, quantity,purchase_date,avalable_quantity) VALUES ('$medicineName', $medicineQuantity,'$date','$medicineQuantity')";

    if ($conn->query($insertSql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

$conn->close();
