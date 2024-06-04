<?php
require_once "connection.php";
session_start();

$userLoginDetails =  json_decode(file_get_contents("php://input"));

if (empty($userLoginDetails->email) || empty($userLoginDetails->password)) {

    echo "All fields are required";
    exit();
} else {

    $pwHash = hash("sha256", "$userLoginDetails->password");

    $resultset = Database::search("SELECT * FROM `user` WHERE `email` = '$userLoginDetails->email' AND `password` = '$pwHash'");
    $userCount = $resultset->num_rows;
    if ($userCount == 1) {

        $userData = $resultset->fetch_assoc();

        session_regenerate_id();
        $_SESSION["fname"] = $userData["fname"];
        $_SESSION["lname"] = $userData["lname"];
        $_SESSION["email"] = $userData["email"];

        echo "success";
        exit();
    } else {

        echo "Invalid Email Or Password";
        exit();
    }
}
