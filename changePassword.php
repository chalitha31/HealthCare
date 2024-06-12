<?php
require_once "connection.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $pwdata = json_decode(file_get_contents("php://input"));

// $currentPassword  = $_POST['currentPassword'];
// $newPassword = $_POST['newPassword'];
// $confirmnewPassword = $_POST['confirmnewPassword'];

$currentPassword  = $pwdata->currentPassword;
$newPassword = $pwdata->newPassword;
$confirmnewPassword = $pwdata->confirmnewPassword;
$table = $pwdata->table;

if(empty($currentPassword)) {
echo "Please enter your current password!";

}elseif (empty($newPassword)) {

    echo "Please enter your new password!";
   
}else if (empty($confirmnewPassword)) {

    echo "Please enter your confirm new Password!";
   
}else if ($newPassword != $confirmnewPassword) {
   echo "new password mismatch confirm new Password!";
  
}else {

    $NewpwHash = hash("sha256", "$newPassword");
    $CurpwHash = hash("sha256", "$currentPassword");

    // $Detailstables = ["user","admin", "registered_reception", "registered_pharmacists", "registered_mlt", "registered_doctor"];

    // foreach ($Detailstables as $table) {
        $resultset = Database::search("SELECT * FROM `$table` WHERE `email` = '".$_SESSION["email"]."' AND `id_num` = '".$_SESSION["idnum"]."'");
        $userCount = $resultset->num_rows;

        if ($userCount == 1) {
            $userData = $resultset->fetch_assoc();

            $currentPW = $userData["password"];
            $idnum = $userData["id_num"];

            if($currentPW == $CurpwHash){

                Database::iud("UPDATE $table SET `password` = '".$NewpwHash."' WHERE `id_num` = '".$idnum."'");
                echo "success";
            }else{

                echo "Your current password is incorrect!";
              
            }


        }
    
    // }
}

}else{

    echo "invalid request method";
    
}