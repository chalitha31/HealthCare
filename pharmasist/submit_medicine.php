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
$medicineBrand = $_POST['medicineBrand'];
$medicineQuantity = $_POST['medicineQuantity'];
$expirationDate = $_POST['expirationDate'];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
// $date = $d->format('Y-m-d H:i:s');
$date = $d->format('Y-m-d');

if ($medicineQuantity > 0) {

    // Check if the row already exists
    $sql = "SELECT id, quantity FROM medicines WHERE name = '$medicineName' AND brand = '$medicineBrand' AND exp = '$expirationDate'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Row exists, update the quantity
        $row = $result->fetch_assoc();
        $newQuantity = $row['quantity'] + $medicineQuantity;
        $updateSql = "UPDATE medicines SET quantity = $newQuantity WHERE id = " . $row['id'];

        if ($conn->query($updateSql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Row does not exist, insert a new row
        $insertSql = "INSERT INTO medicines (name, brand, quantity, exp,purchase_date) VALUES ('$medicineName', '$medicineBrand', $medicineQuantity, '$expirationDate','$date')";

        if ($conn->query($insertSql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
} else {
    echo "Please Enter Valid Quantity!";
}

$conn->close();
