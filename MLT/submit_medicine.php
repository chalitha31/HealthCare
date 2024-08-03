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
$expirationDate = $_POST['expirationDate'];


// Check if the row already exists
$sql = "SELECT id, quantity,avalable_quantity,expire_date FROM mlt_equipments WHERE name = '$medicineName'";
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

    if ($expirationDate == "" || $expirationDate == null) {

        $updateSql = "UPDATE mlt_equipments SET quantity = $updateQuantity , avalable_quantity = $updateQuantity,purchase_date = '$date' WHERE id = " . $row['id'];
    } else {
        $exdate = $row['expire_date'];
        if ($exdate == $expirationDate) {

            $updateSql = "UPDATE mlt_equipments SET quantity = $updateQuantity , avalable_quantity = $updateQuantity,purchase_date = '$date' WHERE id = " . $row['id'];
        } else {

            $updateSql = "INSERT INTO mlt_equipments (name, quantity,purchase_date,avalable_quantity,expire_date) VALUES ('$medicineName', $medicineQuantity,'$date','$medicineQuantity','$expirationDate')";
        }
        // $updateSql = "UPDATE mlt_equipments SET quantity = $updateQuantity , avalable_quantity = $updateQuantity,purchase_date = '$date',view = '1' WHERE id = " . $row['id'];


    }
    if ($conn->query($updateSql) === TRUE) {
        echo "Record updated successfully";
        // echo $row['avalable_quantity'];
        // echo $updateQuantity; 
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Row does not exist, insert a new row
    $insertSql;

    if ($expirationDate == "" || $expirationDate == null) {
        $insertSql = "INSERT INTO mlt_equipments (name, quantity,purchase_date,avalable_quantity,expire_date) VALUES ('$medicineName', $medicineQuantity,'$date','$medicineQuantity',null)";
    } else {

        $insertSql = "INSERT INTO mlt_equipments (name, quantity,purchase_date,avalable_quantity,expire_date) VALUES ('$medicineName', $medicineQuantity,'$date','$medicineQuantity','$expirationDate')";
    }

    // $insertSql = "INSERT INTO mlt_equipments (name, quantity,purchase_date,avalable_quantity) VALUES ('$medicineName', $medicineQuantity,'$date','$medicineQuantity')";

    if ($conn->query($insertSql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

$conn->close();
