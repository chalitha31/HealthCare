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

    $name = $_POST["name"];
    $nic = $_POST["nic"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $contact = $_POST["mobile"];
    $Tname = $_POST["Tname"];
    // $image = $_FILES["pimage"];

    if (isset($_FILES["pimage"])) {
        $image = $_FILES["pimage"];

        $allowd_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
        $fileex = $image["type"];
        // echo  $pimg["name"];
        if (!in_array($fileex, $allowd_image_extention)) {

            echo "Please Select A Valid Image";
        } else {

            $newimageextention;
            if ($fileex == "image/jpg") {
                $newimageextention = ".jpg";
            } else if ($fileex = "image/jpeg") {
                $newimageextention = ".jpeg";
            } else if ($fileex = "image/png") {
                $newimageextention = ".png";
            } else if ($fileex = "image/svg") {
                $newimageextention = ".svg";
            }

            $uniqName = uniqid() . $newimageextention;

            $file_name = "assets//images//Employe_profile//" . $uniqName;
            //   echo $file_name;
            move_uploaded_file($image["tmp_name"], $file_name);

            Database::iud("UPDATE $Tname SET `name` = '" . $name . "',`mobile` = '" . $contact . "',`age` = '" . $age . "',`image` = '" . $uniqName . "',`address` = '" . $address . "',`register_date` = '" . $date . "'
            WHERE `id_num` = '" . $nic . "' AND `email` = '" . $email . "'");
        }
    }else{

        Database::iud("UPDATE $Tname SET `name` = '" . $name . "',`mobile` = '" . $contact . "',`age` = '" . $age . "',`address` = '" . $address . "',`register_date` = '" . $date . "'
        WHERE `id_num` = '" . $nic . "' AND `email` = '" . $email . "'");

    }




    $_SESSION["name"] = $name;
    $_SESSION["mobile"] = $contact;

    echo $Tname;

    // $allowd_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
    // $fileex = $image["type"];
    // // echo  $pimg["name"];
    // if (!in_array($fileex, $allowd_image_extention)) {

    //     echo "Please Select A Valid Image";
    // } else {

    //     $newimageextention;
    //     if ($fileex == "image/jpg") {
    //         $newimageextention = ".jpg";
    //     } else if ($fileex = "image/jpeg") {
    //         $newimageextention = ".jpeg";
    //     } else if ($fileex = "image/png") {
    //         $newimageextention = ".png";
    //     } else if ($fileex = "image/svg") {
    //         $newimageextention = ".svg";
    //     }

    //     $uniqName = uniqid() . $newimageextention;

    //     $file_name = "assets//images//Employe_profile//" . $uniqName;
    //     //   echo $file_name;
    //     move_uploaded_file($image["tmp_name"], $file_name);

    // Database::iud("UPDATE $Tname SET `name` = '".$name."',`mobile` = '".$contact."',`age` = '".$age."',`image` = '".$uniqName."',`address` = '".$address."',`register_date` = '".$date."'
    //  WHERE `id_num` = '".$nic."' AND `email` = '".$email."'");

    //  $_SESSION["name"] = $name;
    //  $_SESSION["mobile"] = $contact;


    // }

} else {
    echo "Invalid request method.";
}
