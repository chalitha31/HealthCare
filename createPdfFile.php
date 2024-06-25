<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Fetch patient details
function fetchPatientDetails($pdi) {
    require_once "connection.php";

    $patientResultSet = Database::search("SELECT `registered_patients`.`name` AS `name`, `patients_details`.`age` AS `age`, `patients_details`.`medical_report` AS `medical_report`
        FROM `patients_details`
        INNER JOIN `registered_patients` ON `registered_patients`.`p_id` = `patients_details`.`patients_id`
        WHERE `patients_details`.`medical_report` != '' AND `patients_details`.`medical_report` != 'no' AND `patients_details`.`medical_report` != 'yes' AND `patients_details`.`id` = '" . $pdi . "' ORDER BY `patients_details`.`id` DESC LIMIT 1");

    if ($patientResultSet->num_rows > 0) {
        return $patientResultSet->fetch_assoc();
    } else {
        return null;
    }
}

$pdi = $_GET['pdi'];
$pDetails = fetchPatientDetails($pdi);

if ($pDetails) {
    $currentDate = new DateTime();
    $formattedDate = $currentDate->format('F j, Y');

    $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Medical Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0px;
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: #f4f4f4;
            }
            .container {
                width: 80%;
                max-width: 500px;
                margin: 5px auto;
                margin-bottom: 5px;
                padding: 10px 30px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #4CAF50;
                margin-top: 0px;
                text-align: center;
            }
            .section {
                margin-bottom: 10px;
            }
            h3 {
                color: #333;
                border-bottom: 2px solid #4CAF50;
                padding-bottom: 5px;
                margin-bottom: 10px;
                font-size: 15px;
            }
            p {
                margin: 5px 0;
                font-size: 12px;
            }
            p strong {
                color: #000;
            }
            .signature-block {
                margin-top: 20px;
                display: flex;
                flex-direction: column;
                gap: 0px;
            }
            .bill {
                width: 300px;
                padding: 20px;
                margin: 5px auto;
                background-color: white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 5px;
                text-align: center;
            }
            .bill h1 {
                font-size: 1.5em;
                margin-bottom: 10px;
            }
            .bill-info {
                text-align: left;
                margin-bottom: 20px;
            }
            .bill-info p {
                margin: 5px 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            table th, table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            table th {
                background-color: #f2f2f2;
            }
            .total {
                text-align: left;
                margin-bottom: 20px;
            }
            .note {
                font-size: 0.9em;
                color: #666;
            }
            hr {
                border: 2px dotted black;
                width: 500px;
            }
        </style>
    </head>
    <body>
        <div class="bill">
            <h1>Hospital Medical Laboratory</h1>
            <div class="bill-info">
                <p><strong>Patient Name:</strong> ' . $pDetails["name"] . '</p>
                <p><strong>Date:</strong> ' . $formattedDate . '</p>
                <p><strong>Bill Number:</strong> ' . rand(1000, 99999) . '</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fee for the medical test</td>
                        <td>Rs : 100.00</td>
                    </tr>
                </tbody>
            </table>
            <div class="total">
                <p><strong>Total:</strong> Rs : 100.00</p>
            </div>
            <p class="note">Thank you for your visit. Please come again!</p>
        </div>
            <hr>
        <div class="container">
            <h2>Medical Report</h2>
            <div class="section">
                <h3>Patient Information</h3>
                <p><strong>Name:</strong> ' . $pDetails["name"] . '</p>
                <p><strong>Age:</strong> ' . $pDetails["age"] . '</p>
                <p><strong>Date of Examination:</strong> ' . $formattedDate . '</p>
            </div>
            <div class="section">
                <h3>Diagnosis</h3>
                <p>' . $pDetails["medical_report"] . '</p>
            </div>
            <div class="signature-block">
                <p>...........................</p>
                <p>Signature</p>
            </div>
        </div>
    </body>
    </html>';

    $options = new Options();
    $options->set('isPhpEnabled', true); // Enable PHP execution
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($pDetails['name'] . "_Medical_Report.pdf", array("Attachment" => 1));
} else {
    echo "Patient details not found.";
}
?>