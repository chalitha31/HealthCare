<?php
// require 'vendor/autoload.php';
require_once 'dompdf/vendor/autoload.php';
// require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Fetch patient details
function fetchPatientDetails($pdi)
{
    require_once "connection.php";

    $patientResultSet = Database::search("SELECT `registered_doctor`.`email` AS `doctor_email`,`registered_doctor`.`mobile` AS `doctor_mobile`,`registered_doctor`.`name` AS `doctor_name`,`patients_details`.`Prescriptions` AS `Prescriptions`,`registered_patients`.`name` AS `name`, `patients_details`.`age` AS `age`, `patients_details`.`medical_report` AS `medical_report`
        FROM `patients_details`
        INNER JOIN `registered_patients` ON `registered_patients`.`p_id` = `patients_details`.`patients_id`
        INNER JOIN `registered_doctor` ON `registered_doctor`.`id_num` = `patients_details`.`doctor_id`
        WHERE  `patients_details`.`Prescriptions` != '' AND `patients_details`.`Prescriptions` != 'null'  AND `patients_details`.`id` = '" . $pdi . "' ORDER BY `patients_details`.`id` DESC LIMIT 1");

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
              
                background-color: #f4f4f4;
            }
            .container {
                width: 95%;
                max-width: 700px;
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
                font-size: 19px;
            }
            p {
                margin: 5px 0;
                font-size: 15px;
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
           
            hr {
                border: 2px dotted black;
                width: 500px;
            }
          .patient-info {
            font-size: 1em;
            color: #333333;
            display: flex;
              justify-content: space-between;
        }
        .patient-info p {
            margin: 2px 0;
        }
   
              .patient-info strong {
            display: block;
            font-size: 1.2em;
            margin-bottom: 5px;
        }
  .report-date {
          
            right: 0%;
            bottom: 0%;
        }
   
        </style>
    </head>
    <body> 
        <div class="container">
             <div style="justify-content: center;" >  
                        <h1 style="color: #4CAF50;text-align:center; margin: 0px;">Primary medical care unit minuwangamuwa</h1>
                        <p style="text-align: center;">130,Main street, minuwangamuwa</p>
                        <p style="text-align: center;">Tel : 035 123 4567, Fax : 035 123 4568</p>  
                </div>

  <h3></h3>
         <div class="patient-info">
                <div>
                    <strong>Patient Details</strong>
                    <p>Name : '.$pDetails["name"].'</p>
                    <p>Age : '.$pDetails["age"].' Years</p>
                    <p>PID: '.$pdi.'</p>
                </div>
                <br/>
                <div class="report-header-right">
                    <strong>Doctor details</strong>
                    <p>Name : '.$pDetails["doctor_name"].'</p>
                    <p>Mobile : '.$pDetails["doctor_mobile"].'</p>
                    <p>Email : '.$pDetails["doctor_email"].'</p>
                    <p class="report-date">Date : '.$formattedDate.'</p>
                </div>
            </div>
<br/>
            <div class="section">
                <h3 style="text-align: center;">Prescription</h3>
                <p style="white-space:pre-wrap;">' . $pDetails["Prescriptions"] . '</p>
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
    $dompdf->stream($pDetails['name'] . "_Medical_Report.pdf", array("Attachment" => 0));
} else {
    echo "Patient details not found.";
}
