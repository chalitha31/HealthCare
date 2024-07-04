<?php 
session_start();

require_once "../connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasting Blood Sugar (FBS) Report</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            margin-top: 100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: #000000 2px solid;
        }

        .patient-info {
            /* margin-bottom: 20px; */
            font-size: 1em;
            color: var(--dark-gray);
            display: flex;
            justify-content: space-between;
            /* background-color: rgb(241, 241, 241); */
            /* padding: 10px; */
        }

        #form-container hr {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .report-header-right {
            text-align: right;
            position: relative;
        }

        .report-date {
            position: absolute;
            right: 0%;
            bottom: 0%;
        }

        .patient-info strong {
            display: block;
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .patient-info p {
            margin: 2px 0;
        }


        .report-title {
            text-align: start;
            color: var(--base-color);
            /* margin-bottom: 20px; */
        }

        .fbs-report-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .report-table th,
        .report-table td {
            padding: 10px;
            border: 1px solid var(--medium-gray);
            text-align: left;
        }

        .report-table th {
            background-color: var(--base-color);
            color: #fff;
        }

        .additional-info {
            margin-top: 20px;
        }

        .additional-info strong {
            display: block;
            margin-top: 10px;
        }

        .additional-info ul {
            list-style-type: disc;
            margin: 10px 0 0 20px;
        }

        .button-group {
            align-self: center;
            padding-bottom: 100px;
        }

        button {
            padding: 10px 15px;
            background-color: var(--base-color);
            border: none;
            border-radius: 5px;
            color: #FFFFFF;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: var(--second-base-color);
        }

        input {
            border: none;
            padding: 8px 10px;
        }
        .signature-block {
            margin-top: 20px;
            display: flex;
            align-items: end;
            flex-direction: column;
            gap: 0px;
        }
    </style>
</head>

<body>

    <?php

$type = $_GET["type"];
    $pdi = $_GET["pdi"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/colombo");
    $d->setTimezone($tz);
    $date = $d->format('Y-m-d');
    // $date = $d->format('Y-m-d H:i:s');

    $patiientResultSet = Database::search("SELECT `registered_patients`.`p_id` AS `p_id`,`patients_details`.`medical_report` AS `mediReport`,`patients_details`.`id` AS `pdi`,`patients_details`.`age` AS `age`, `registered_patients`.`name` AS `name`, `registered_patients`.`email` AS `email`,
`registered_patients`.`mobile` AS `mobile`, `registered_patients`.`address` AS `address`, `bloodtest`.`id` AS `bloodtest_id`
 FROM `registered_patients` 
 INNER JOIN `patients_details` ON `registered_patients`.`p_id` =`patients_details`.`patients_id`  
 INNER JOIN `bloodtest` ON `bloodtest`.`patientDetails_id` =`patients_details`.`id`  
 WHERE `patients_details`.`id` = '" . $pdi . "'  ORDER BY `bloodtest`.`id` DESC LIMIT 1");

    $numRows = $patiientResultSet->num_rows;

    if ($numRows > 0) {
        $pDetaila = $patiientResultSet->fetch_assoc();



    ?>

        <header>
            <div class="logo">Healthcare</div>
            <div class="header-username"><?php echo $_SESSION["name"] ?></div>
            <!-- <button id="loginBtn">Login</button> -->
        </header>

        <div class="container" id="form-container">
        <div style="justify-content: center;" class="patient-info">
                    <div>
                        <h1 style="color: #0080c0;">Primary medical care unit minuwangamuwa</h1>
                        <p style="text-align: center;">130,Main street, minuwangamuwa</p>
                        <h2 style="color: #b70000; text-align: center;">MEDICAL LABORATORY REPORT</h2>
                    </div>
                   
                </div>
                <hr />
            <div class="patient-info">
                <div>
                    <strong>Patient Details</strong>
                    <p style="visibility: hidden;">Sex: Male</p>
                    <p><?php echo $pDetaila["name"] ?></p>
                    <p>Age: <?php echo $pDetaila["age"] ?> Years</p>
                   
                    <p>PID: 45</p>
                </div>
                <div class="report-header-right">
                    <strong>Laboratory Personnel</strong>
                    <p><?php echo $_SESSION["name"] ?></p>
                    <p><?php echo $_SESSION["mobile"] ?></p>
                    <p><?php echo $_SESSION["email"] ?></p>
                    <p class="report-date">Date : <?php echo $date ?></p>
                </div>
            </div>
            <hr>
            <h3 class="report-title">Fasting Plasma Glucose (FPG)</h3>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Investigation</th>
                        <th>Result</th>
                        <th>Reference Value</th>
                        <th>Unit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>GLUCOSE, FASTING, PLASMA</td>
                        <td><input type="number" id="glucoseFasting" step="0.01" required></td>
                        <td>70.00 - 100.00</td>
                        <td>mg/dL</td>
                    </tr>
                    <!-- <tr>
                        <td>Hexokinase</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> -->
                </tbody>
            </table>

            <div class="additional-info">
                <strong>Note:</strong>
                <p>Additional tests available for Diabetic control are Glycated Hemoglobin (HbA1c), Fructosamine & Microalbumin urine</p>
                <strong>Comments:</strong>
                <p>Conditions which can lead to lower postprandial glucose levels as compared to fasting glucose are excessive insulin release, rapid gastric emptying & brisk glucose absorption.</p>
                <strong>Probable causes:</strong>
                <ul>
                    <li>Early Type II Diabetes / Glucose intolerance.</li>
                    <li>Drugs like Salicylates, Beta blockers, Pentamidine etc.</li>
                    <li>Alcohol.</li>
                    <li>Dietary – Intake of excessive carbohydrates and foods with high glycemic index.</li>
                    <li>Exercise in between samples</li>
                    <li>Family history of Diabetes</li>
                    <li>Idiopathic</li>
                    <li>Partial / Total Gastrectomy</li>
                </ul>
            </div>
            <div class="signature-block">
                <p>...........................</p>
                <p>Signature</p>
            </div>
        </div>
        <div class="button-group">
            <!-- <button type="button" id="dataFeedButton">Data Feed</button> -->
            <button style="background-color: darkgoldenrod;" type="button" id="dataFeedButton">Data Feed</button>

            <!-- <button onclick="exportToJPG('form-container')">Export as JPG</button> -->
          
            <button  onclick="exportToJPG('form-container','<?php echo $pdi ?>','<?php echo $pDetaila['name'] ?>','<?php echo $pDetaila['bloodtest_id'] ?>','<?php echo $type ?>')">Submit</button>

        </div>
    <?php
    }
    ?>

<script src="../assets/js/test.js"></script>
    <script>
 
   
        document.addEventListener('DOMContentLoaded', function() {
 
            const dataFeedButton = document.getElementById('dataFeedButton');
            // const exportButton = document.getElementById('exportButton');
            // const form = document.getElementById('fbsReportForm');
            // const exportBtn = document.getElementById('export-btn');

            dataFeedButton.addEventListener('click', function() {
                document.getElementById('glucoseFasting').value = (70 + Math.random() * 30 + 70).toFixed(2); // Glucose Fasting 70-100 mg/dL
            });

            // exportBtn.addEventListener('click', (e) => {
            //     exportToJPG('form-container')
            // })
        
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>