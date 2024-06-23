<?php 
require_once "../connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $json = file_get_contents('php://input');

    // Decode the JSON data
    $data = json_decode($json, true);

    // Check if the data contains 'pdi'
    if (isset($data['pdi'])) {
        $pdi = $data['pdi'];

        Database::iud("UPDATE `patients_details` SET `medicine_status` = 'Medication cancelled' WHERE `id` = '$pdi'");
     
        // Send a response back to the client
        echo json_encode(['status' => 'success', 'message' => 'Medication cancelled']);
    } else {
        // Send an error response if the data is invalid
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    }
} else {
    // Send an error response if the request method is not POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}