<?php
require_once "../connection.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $postData = json_decode(file_get_contents("php://input"));

    $data = isset($_POST['image']) ? $_POST['image'] : '';
    $pdi = isset($_POST['pdi']) ? $_POST['pdi'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $bloodtestId = isset($_POST['bloodtestId']) ? $_POST['bloodtestId'] : '';

    // $data = $postData->image;
    // $data = $_POST["image"];
    $data = str_replace('data:image/jpeg;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode($data);
    // echo $data;
    // $name = $postData->name;
    // $pdi = $postData->pdi;
    // $bloodtestId = $postData->bloodtestId;

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/colombo");
    $d->setTimezone($tz);
    // $date = $d->format('Y-m-d');
    $date = $d->format('Y-m-d H:i:s');
    $datereport = $d->format('Y-m-d_H-i-s');

    $name = str_replace(' ', '', $name);

    // Generate a filename with the current date and time
    $filename = $type . '_medical_report_' . $pdi . '_' . $name . '_' . $datereport . '.jpg';
    $file = 'images/' . $filename;

    if (file_put_contents($file, $data)) {
        // echo 'Image saved successfully as ' . $filename;

        // update the image filename into the database

        Database::iud("UPDATE `bloodtest` SET `reportName` = '" . $filename . "' ,`issued_Date` = '" . $date . "' , `mlt_id` = '" . $_SESSION["idnum"] . "' WHERE `id` ='" . $bloodtestId . "' ");

        echo "success";
    } else {
        echo 'Failed to save image';
    }
} else {
    echo 'Invalid request';
}
