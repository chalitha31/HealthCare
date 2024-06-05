<?php

require_once "../connection.php";

session_start();

$patientDetails = json_decode(file_get_contents("php://input"));

$name = $patientDetails->name;
$nic = $patientDetails->nic;
$age = $patientDetails->age;
$email = $patientDetails->email;
$address = $patientDetails->address;
$contact = $patientDetails->contact;
$symptoms = $patientDetails->symptoms;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

// $resiption_id = $_SESSION['id'];

Database::iud("INSERT INTO `registered_patients` (`name`,`mobile`,`email`,`id_num`,`address`,`age`,`register_date`,`reception_id`) 
VALUES('".$name."','".$contact."','".$email."','".$nic."','".$address."','".$age."','".$date."','1542658v') ");

$patienResult = Database::search("SELECT * FROM `registered_patients` WHERE `register_date` = '$date' AND `name` = '$name'");
$numrow = $patienResult->num_rows;
 if ($numrow > 0)
 {
 $pd = $patienResult->fetch_assoc();
$p_id = $pd["p_id"];


Database::iud("INSERT INTO `patients_details` (`patients_id`,`reception_id`,`symptoms`,`Prescriptions`,`doctor_id`,`symptoms_date`,`age`)
 VALUES('".$p_id."','1542658v','".$symptoms."','','785645v','".$date."','".$age."') ");
 echo "success";
//  echo $p_id;
 exit();
 }

 echo "some process is not working";