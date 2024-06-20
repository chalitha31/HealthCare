<?php

require_once "../connection.php";

session_start();

$patientDetails = json_decode(file_get_contents("php://input"));

$status = $patientDetails->status;


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

// $resiption_id = $_SESSION['id'];


if ($status == "add") {


    if (empty($patientDetails->name)) {
        echo "please enter patient name";
        exit();
    } else if (empty($patientDetails->age)) {
        echo "please enter patient age";
        exit();
    } else if (empty($patientDetails->address)) {
        echo "please enter patient address";
        exit();
    } else if (empty($patientDetails->contact)) {
        echo "please enter patient contact number";
        exit();
    } else if (empty($patientDetails->symptoms)) {
        echo "please enter patient symptoms";
        exit();
    } else {

        $name = $patientDetails->name;
        $nic = $patientDetails->nic;
        $age = $patientDetails->age;
        $email = $patientDetails->email;
        $address = $patientDetails->address;
        $contact = $patientDetails->contact;
        $symptoms = $patientDetails->symptoms;
        $medicalReport = $patientDetails->medicalReport;

        $symptoms =  htmlspecialchars($symptoms, ENT_QUOTES, 'UTF-8');

        Database::iud("INSERT INTO `registered_patients` (`name`,`mobile`,`email`,`id_num`,`address`,`age`,`register_date`,`reception_id`) 
VALUES('" . $name . "','" . $contact . "','" . $email . "','" . $nic . "','" . $address . "','" . $age . "','" . $date . "','" . $_SESSION["idnum"] . "') ");

        $patienResult = Database::search("SELECT * FROM `registered_patients` WHERE `register_date` = '$date' AND `name` = '$name'");
        $numrow = $patienResult->num_rows;

        if ($numrow > 0) {
            $pd = $patienResult->fetch_assoc();
            $p_id = $pd["p_id"];


            if ($medicalReport) {

                Database::iud("INSERT INTO `patients_details` (`patients_id`,`reception_id`,`symptoms`,`Prescriptions`,`doctor_id`,`symptoms_date`,`age`,`medical_report`)
        VALUES('" . $p_id . "','" . $_SESSION["idnum"] . "','" . $symptoms . "','','0000000000','" . $date . "','" . $age . "','yes') ");
                echo "success";
                exit();
            } else {

                Database::iud("INSERT INTO `patients_details` (`patients_id`,`reception_id`,`symptoms`,`Prescriptions`,`doctor_id`,`symptoms_date`,`age`,`medical_report`)
        VALUES('" . $p_id . "','" . $_SESSION["idnum"] . "','" . $symptoms . "','','0000000000','" . $date . "','" . $age . "','no') ");
                echo "success";
                exit();
            }
        } else {

            echo "some Insert process is not working";
            exit();
        }
    }
} elseif ($status == "update") {



    if (empty($patientDetails->age)) {
        echo "please enter patient age";
        exit();
    } else if (empty($patientDetails->address)) {
        echo "please enter patient address";
        exit();
    } else if (empty($patientDetails->contact)) {
        echo "please enter patient contact number";
        exit();
    } else {

        $age = $patientDetails->age;
        $email = $patientDetails->email;
        $address = $patientDetails->address;
        $contact = $patientDetails->contact;

        $patientProfile_id = $patientDetails->patientProfile_id;

        Database::iud("UPDATE `registered_patients` SET `age` = '" . $age . "', `address` = '" . $address . "', `email` = '" . $email . "', `mobile` = '" . $contact . "' , `register_date` = '" . $date . "' WHERE `p_id` = '" . $patientProfile_id . "' ");
        echo "success";
        exit();
    }
} else {


    if (empty($patientDetails->age)) {
        echo "please enter patient age";
        exit();
    } else if (empty($patientDetails->symptoms)) {
        echo "please enter patient symptoms";
        exit();
    } else {

        $age = $patientDetails->age;
        $symptoms = $patientDetails->symptoms;
        $medicalReport = $patientDetails->medicalReport;

        $symptoms =  htmlspecialchars($symptoms, ENT_QUOTES, 'UTF-8');

        $patientProfile_id = $patientDetails->patientProfile_id;

        if ($medicalReport) {

            Database::iud("INSERT INTO `patients_details` (`patients_id`,`reception_id`,`symptoms`,`Prescriptions`,`doctor_id`,`symptoms_date`,`age`,`medical_report`)
            VALUES('" . $patientProfile_id . "','" . $_SESSION["idnum"] . "','" . $symptoms . "','','0000000000','" . $date . "','" . $age . "','yes') ");
                echo "success";
                exit();

        }else{

            Database::iud("INSERT INTO `patients_details` (`patients_id`,`reception_id`,`symptoms`,`Prescriptions`,`doctor_id`,`symptoms_date`,`age`,`medical_report`)
            VALUES('" . $patientProfile_id . "','" . $_SESSION["idnum"] . "','" . $symptoms . "','','0000000000','" . $date . "','" . $age . "','no') ");
                echo "success";
                exit();

        }

 
    }
}
