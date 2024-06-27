<?php 
session_start();

require_once "../connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDL Cholesterol Report</title>
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
            text-align: center;
            color: var(--base-color);
            margin-bottom: 20px;
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
            font-size: 1em;
            color: var(--dark-gray);
        }

        .additional-info strong {
            display: block;
            margin-top: 10px;
            font-size: 1.1em;
        }

        .additional-info p,
        .additional-info ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .additional-info ul {
            list-style-type: disc;
            margin: 10px 0 0 20px;
        }

        .additional-info ul li {
            margin: 5px 0;
        }

        .recommendations-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .recommendations-table th,
        .recommendations-table td {
            padding: 10px;
            border: 1px solid var(--medium-gray);
            text-align: left;
        }

        .recommendations-table th {
            background-color: var(--base-color);
            color: #fff;
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
            <!-- <div class="header-username"><?php echo $_SESSION["name"] ?></div> -->
            <!-- <button id="loginBtn">Login</button> -->
            <?php $_SESSION["name"] ?>
        </header>

        <div class="container" id="form-container">
            <h2 class="report-title">HDL Cholesterol</h2>
            <div class="patient-info">
                <div>
                    <strong>Patient Details</strong>
                    <p style="visibility: hidden;">Sex: Male</p>
                    <p><?php echo $pDetaila["name"] ?></p>
                    <p>Age: <?php echo $pDetaila["age"] ?> Years</p>
                   
                    <p>PID: 98</p>
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
                        <td>LDL Cholesterol</td>
                        <td><input type="number" id="vldlCholesterol" step="0.01" required></td>
                        <td>
                            < 40.00</td>
                        <td>mg/dL</td>
                    </tr>
                    <!-- <tr>
                    <td>Calculated</t   d>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> -->
                </tbody>
            </table>

            <div class="additional-info">
                <strong>Note:</strong>
                <p>An HDL cholesterol test (High-density lipoprotein) measures the amount of cholesterol found inside high density lipoproteins (HDL) in a simple of your blood. HDL Cholesterol is considered "good cholesterol" and is associated with a lower risk of coronary heart disease events.</p>

                <table class="recommendations-table">
                    <thead>
                        <tr>
                            <th>NLA - 2014 RECOMMENDATIONS</th>
                            <th>Total Cholesterol (mg/dL)</th>
                            <th>HDL Cholesterol (mg/dL)</th>
                            <th>LDL Cholesterol (mg/dL)</th>
                            <th>Triglycerides (mg/dL)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Optimal</td>
                            <td></td>
                            <td>&lt; 40</td>
                            <td>&lt; 100</td>
                            <td>&lt; 150</td>
                        </tr>
                        <tr>
                            <td>Above Optimal</td>
                            <td>&lt; 200</td>
                            <td></td>
                            <td>100 - 129</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Borderline High</td>
                            <td>200 - 239</td>
                            <td></td>
                            <td>130 - 159</td>
                            <td>150 - 199</td>
                        </tr>
                        <tr>
                            <td>High</td>
                            <td>&gt; 240</td>
                            <td>&lt; 60</td>
                            <td>160 - 189</td>
                            <td>200 - 499</td>
                        </tr>
                        <tr>
                            <td>Very High</td>
                            <td></td>
                            <td></td>
                            <td>&gt; 190</td>
                            <td>&gt; 500</td>
                        </tr>
                    </tbody>
                </table>

                <strong>Note:</strong>
                <p>1. Measurements in the same patient can show physiological & analytical variations. Three serial samples 1 week apart are recommended for Total Cholesterol, Triglycerides, HDL & LDL Cholesterol.</p>
                <p>2. As per NLA-2014 guidelines, all adults above the age of 20 years should be screened for lipid status. Selective screening of children above the age of 2 years with a family history of premature cardiovascular disease or those with at least one parent with high total cholesterol is recommended.</p>
            </div>

        </div>
        <div class="button-group">
            <!-- <button type="button" id="dataFeedButton">Data Feed</button> -->
            <button style="background-color: darkgoldenrod;" type="button" id="dataFeedButton">Data Feed</button>

            <!-- <button onclick="exportToJPG('form-container')">Export as JPG</button> -->

            <button onclick="exportToJPG('form-container','<?php echo $pdi ?>','<?php echo $pDetaila['name'] ?>','<?php echo $pDetaila['bloodtest_id'] ?>','<?php echo $type ?>')">Submit</button>

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
                document.getElementById('vldlCholesterol').value = (10 + Math.random() * 30).toFixed(2); // Glucose Fasting 70-100 mg/dL
            });

            // exportBtn.addEventListener('click', (e) => {
            //     exportToJPG('form-container')
            // })

            // function exportToJPG(divID) {
            //     if (!formValidation()) {
            //         alert("cant't Export a blank test report")
            //         return
            //     }
            //     const div = document.getElementById(divID);

            //     html2canvas(div).then(canvas => {
            //         const imageData = canvas.toDataURL('image/jpeg');
            //         fetch('save_image.php', {
            //                 method: 'POST',
            //                 headers: {
            //                     'Content-Type': 'application/x-www-form-urlencoded'
            //                 },
            //                 body: 'image=' + encodeURIComponent(imageData)
            //             })
            //             .then(response => response.text())
            //             .then(data => {
            //                 alert(data);
            //             })
            //             .catch(error => {
            //                 console.error('Error:', error);
            //             });
            //     });
            // }

            // function formValidation() {
            //     for (const input of Array.from(document.querySelectorAll('input'))) {
            //         if (input.value == "") return false;
            //     }
            //     return true
            // }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>