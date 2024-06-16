<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once "connection.php";
    session_start();


    // $employeeDetails = json_decode(file_get_contents("php://input"));

    // echo $employeeDetails->pimage;
    // echo $employeeDetails->name;
    // echo $employeeDetails->nic;
    // echo $employeeDetails->mobile;


    $d = new DateTime();
    $tz = new DateTimeZone("Asia/colombo");
    $d->setTimezone($tz);
    $date = $d->format('Y-m-d H:i:s');

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];

    $email = $_POST["email"];

    $contact = $_POST["mobile"];


    Database::iud("UPDATE `user` SET `fname` = '" . $fname . "',`mobile` = '" . $contact . "',`lname` = '" . $lname . "',`register_date` = '" . $date . "'
            WHERE `email` = '" . $email . "'");


            session_regenerate_id();
    $_SESSION["fname"] = $fname;
    $_SESSION["lname"] = $lname;
    $_SESSION["email"] = $email;
    $_SESSION["mobile"] = $contact;

    echo "success";
} else {
    echo "Invalid request method.";
}
