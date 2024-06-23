<?php
require_once "../connection.php";
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $json = file_get_contents('php://input');

    // Decode the JSON data
    $data = json_decode($json, true);

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    // Check if the data is an array
    if (isset($data['pdi']) && isset($data['medicines'])) {
        // Iterate over the array
        $pdi = $data['pdi'];
        $medicines = $data['medicines'];

        $allReadyMedicine = false;

        foreach ($medicines as $medicine) {
            // Access each field in the row
            $mname = $medicine['mname'];
            $mbrand = $medicine['mbrand'];
            $mqty = $medicine['mqty'];
            $mexdate = $medicine['mexdate'];
            // $pdi = $row['pdi'];

            $medicineResultSet = Database::search("SELECT * FROM `medicines` WHERE `name` = '$mname' AND `brand` = '$mbrand' AND `exp` = '$mexdate'");

            if ($medicineResultSet->num_rows > 0) {

                $mediData = $medicineResultSet->fetch_assoc();

                $currentQty = $mediData["quantity"];


                if ($currentQty >= $mqty) {

                    $mediId = $mediData["id"];
                    $allReadyMedicine = true;

                    // echo $mediId;
                } else {

                    $allReadyMedicine = false;
                    echo $mname . " available Qty : " . $currentQty;
                    exit();
                }
            } else {

                echo "Can't find medicine!";
                break;
                exit();
            }


            // serach medicine table get id and check qty

        }


        if ($allReadyMedicine) {

            //   echo "el".$pdi;


            foreach ($medicines as $medicine) {
                // Access each field in the row
                $mname = $medicine['mname'];
                $mbrand = $medicine['mbrand'];
                $mqty = $medicine['mqty'];
                $mexdate = $medicine['mexdate'];
                // $pdi = $row['pdi'];

                $medicineResultSet = Database::search("SELECT * FROM `medicines` WHERE `name` = '$mname' AND `brand` = '$mbrand' AND `exp` = '$mexdate'");

                $mediData = $medicineResultSet->fetch_assoc();

                $currentQty = $mediData["quantity"];

                $mediId = $mediData["id"];

                Database::iud("INSERT INTO `medicines_recode` (`patientDetails_id`,`medicine_id`,`qty`,`date`) VALUES('$pdi','$mediId','$mqty','$date')");

                $updateQty = $currentQty - $mqty;

                Database::iud("UPDATE `medicines` SET `quantity` = '$updateQty' WHERE `id` = '$mediId'");
                Database::iud("UPDATE `patients_details` SET `medicine_status` = 'true' WHERE `id` = '$pdi'");
            }

            echo "success";
            exit();
        } else {
            echo "some insert error";
            exit();
        }


        // Send a response back to the client
        // echo json_encode(['status' => 'success']);
    } else {
        // Send an error response if the data is not an array
        // echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        echo "Invalid data";
        exit();
    }
} else {
    // Send an error response if the request method is not POST
    // echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    echo "Invalid request method";
    exit();
}
