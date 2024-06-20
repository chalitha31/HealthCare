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
$medicineBrand = $_POST['medicineBrand'];
$medicineQuantity = $_POST['medicineQuantity'];
$expirationDate = $_POST['expirationDate'];

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
    $insertSql = "INSERT INTO medicines (name, brand, quantity, exp) VALUES ('$medicineName', '$medicineBrand', $medicineQuantity, '$expirationDate')";

    if ($conn->query($insertSql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

$conn->close();
