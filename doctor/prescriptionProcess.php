<?php
require_once "../connection.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prescription = $_POST["prescription"];
    $medicalReport = $_POST["medicalReport"];
    $pdi = $_POST["pid"];

    $result = Database::search("SELECT * FROM  `patients_details` WHERE `id` = '" . $pdi . "' AND `Prescriptions` = '' AND `medical_report` = ''");
    $pnumRow = $result->num_rows;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

    if (!empty($prescription) && empty($medicalReport)) {

        Database::iud("UPDATE `patients_details` SET `Prescriptions` = '" . $prescription . "' ,`doctor_id` = '" . $_SESSION["idnum"] . "' , `Prescriptions_date` = '".$date."' WHERE `id` ='" . $pdi . "' ");
        echo "prescription add successful! ";
    } elseif (!empty($medicalReport) && empty($prescription)) {

        Database::iud("UPDATE `patients_details` SET `medical_report` = '" . $medicalReport . "' ,`doctor_id` = '" . $_SESSION["idnum"] . "' , `Prescriptions_date` = '".$date."' WHERE `id` ='" . $pdi . "' ");
        echo "medical report  add successful! ";
    } elseif (!empty($medicalReport) && (!empty($prescription))) {

        Database::iud("UPDATE `patients_details` SET `Prescriptions` = '" . $prescription . "',`medical_report` = '" . $medicalReport . "' ,`doctor_id` = '" . $_SESSION["idnum"] . "' , `Prescriptions_date` = '".$date."' WHERE `id` ='" . $pdi . "' ");
        echo "medical report and prescription add successful! ";

    } elseif (empty($prescription)  && empty($medicalReport)) {

        if ($pnumRow > 0) {

            echo "Please enter medical report or prescription!";
        }
    }
} else {
    echo "Invalid request method.";
}
