<?php
require_once "connection.php";
session_start();

$userLoginDetails =  json_decode(file_get_contents("php://input"));

if (empty($userLoginDetails->email) || empty($userLoginDetails->password)) {

    echo "All fields are required";
    exit();
} else {

    $pwHash = hash("sha256", "$userLoginDetails->password");

    $Detailstables = ["user","admin", "registered_reception", "registered_pharmacists", "registered_mlt", "registered_doctor"];

    foreach ($Detailstables as $table) {
        $resultset = Database::search("SELECT * FROM $table WHERE `email` = '$userLoginDetails->email' AND `password` = '$pwHash'");
        $userCount = $resultset->num_rows;

        if ($userCount == 1) {

            $userData = $resultset->fetch_assoc();

            session_regenerate_id();

            switch ($table) {
                case 'user':
                    $_SESSION["fname"] = $userData["fname"];
                    $_SESSION["lname"] = $userData["lname"];
                    break;
            case 'admin':
                $_SESSION["name"] = $userData["name"];
                break;
                case 'registered_reception':
                case 'registered_pharmacists':
                case 'registered_mlt':
                case 'registered_doctor':
                    $_SESSION["name"] = $userData["name"];
                    $_SESSION["idnum"] = $userData["id_num"];
                    $_SESSION["mobile"] = $userData["mobile"];
                    break;
            
                default:
                    echo "not found";
                    exit();
                    break;
            }
            
            $_SESSION["email"] = $userData["email"];
            
            echo $table == 'user' ? 'user' : $table;
            exit();

            // switch ($table) {

            //     case 'user':
            //         $_SESSION["fname"] = $userData["fname"];
            //         $_SESSION["lname"] = $userData["lname"];
            //         $_SESSION["email"] = $userData["email"];

            //         echo "user";
            //         exit();
            //         break;

            //     case 'registered_reception':

            //         $_SESSION["fname"] = $userData["name"];
            //         $_SESSION["lname"] = $userData["id_num"];
            //         $_SESSION["lname"] = $userData["mobile"];
            //         $_SESSION["email"] = $userData["email"];


            //         echo "reception";
                 
            //         exit();
            //         break;

            //     case 'registered_pharmacists':

            //         $_SESSION["fname"] = $userData["name"];
            //         $_SESSION["lname"] = $userData["id_num"];
            //         $_SESSION["lname"] = $userData["mobile"];
            //         $_SESSION["email"] = $userData["email"];

            //         echo "pharmacists";
            //         exit();
            //         break;

            //     case 'registered_mlt':

            //         $_SESSION["fname"] = $userData["name"];
            //         $_SESSION["lname"] = $userData["id_num"];
            //         $_SESSION["lname"] = $userData["mobile"];
            //         $_SESSION["email"] = $userData["email"];
                

            //         echo "mlt";
            //         exit();
            //         break;

            //     case 'registered_doctor':

            //         $_SESSION["fname"] = $userData["name"];
            //         $_SESSION["lname"] = $userData["id_num"];
            //         $_SESSION["lname"] = $userData["mobile"];
            //         $_SESSION["email"] = $userData["email"];

            //         echo "doctor";
            //         exit();
            //         break;



            //     default:
                  

            //         echo "not found";
            //         exit();
            //         break;
            // }


        } 
        // else {

        //     echo "Invalid Email Or Password";
           
        //     exit();
        // }
    }
}
