<?php
// submit_medicine.php
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

// Get the form data
$medicineName = $_POST['medicineName'];
// $medicineBrand = $_POST['medicineBrand'];
$medicineQuantity = $_POST['medicineQuantity'];
// $expirationDate = $_POST['expirationDate'];

// Check if the row already exists
$sql = "SELECT id, quantity FROM mlt_equipments WHERE name = '$medicineName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Row exists, update the quantity
    $row = $result->fetch_assoc();
    $newQuantity = $row['quantity'] + $medicineQuantity;
    $updateSql = "UPDATE mlt_equipments SET quantity = $newQuantity WHERE id = " . $row['id'];

    if ($conn->query($updateSql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Row does not exist, insert a new row
    $insertSql = "INSERT INTO mlt_equipments (name, quantity) VALUES ('$medicineName', $medicineQuantity)";

    if ($conn->query($insertSql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

$conn->close();
