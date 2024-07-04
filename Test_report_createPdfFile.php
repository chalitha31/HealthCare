<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;




function fetchPatientDetails($pdi)
{
    require_once "connection.php";

    $bloodTestResult = Database::search("SELECT * FROM  `bloodtest`  WHERE `patientDetails_id` = '" . $pdi . "' ORDER BY `id` DESC LIMIT 1");

    if ($bloodTestResult->num_rows > 0) {
        return $bloodTestResult->fetch_assoc();
    } else {
        return null;
    }
}

$pdi = $_GET['pdi'];
$pDetails = fetchPatientDetails($pdi);

if ($pDetails) {
    $html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report</title>
    <style>
        @page {
            size: A4 portrait; 
            margin: 0; /* You can set margin and padding to 0 */
        }
        body {
            font-family: Times New Roman;
            font-size: 33px;
            text-align: center;
            border: thin solid black;
            width: 780px;
            height: 1100px;
            margin: 5px 0 0 5px ;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        img {
            width: 100%;
            height: auto;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
    <img src="http://localhost/HealthCare/MLT/images/'.$pDetails["reportName"].'" alt="Medical Report">
</body>
</html>';

    $options = new Options();
    $options->set('isPhpEnabled', true); // Enable PHP execution
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true); // Enable remote file access
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Set paper size to legal and orientation to portrait
    $dompdf->render();
    $dompdf->stream($pDetails['test_type'] ."_Blood_Test_Report_".$pDetails['id'].".pdf", array("Attachment" => 0));
} else {
    echo "Patient details not found.";
}
