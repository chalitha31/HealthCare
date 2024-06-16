<?php
require_once "connection.php";

$userLoginDetails =  json_decode(file_get_contents("php://input"));

// echo $userLoginDetails->email;
// echo json_encode($userLoginDetails);

// if (strlen($userLoginDetails->password) <= 5 || strlen($userLoginDetails->password) >= 20) {
//     echo "password length should be between 6 to 20";
//     exit();
// }


$hashPW = hash('sha256', $userLoginDetails->password);

$resultset = Database::search("SELECT * FROM `user` WHERE `email`='" . $userLoginDetails->email . "'");
$userCount = $resultset->num_rows;
if ($userCount > 0) {

 echo "already used in this email. try again.";
    exit();

}
else {

   $d = new DateTime();
   $tz = new DateTimeZone('Asia/colombo');
   $d->setTimezone($tz);
   $date = $d->format('Y-m-d H:i:s');

   Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`, `password`, `register_Date`,`mobile`) 
   VALUES ('".$userLoginDetails->firstName."','".$userLoginDetails->lastName."','" . $userLoginDetails->email . "', '" . $hashPW . "', '" . $date . "','".$userLoginDetails->contact."')");
   echo "success";
   exit();

}