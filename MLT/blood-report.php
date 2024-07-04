<?php
session_start();

require_once "../connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.B.C. Examination Routine</title>
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

        .report-title {
            text-align: start;
            color: var(--base-color);
            /* margin-bottom: 20px; */
        }

        .cbc-report-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 5px;
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
            /* font-size: 15px; */
            font-weight: bold;
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
 WHERE `patients_details`.`id` = '" . $pdi . "' ORDER BY `bloodtest`.`id` DESC LIMIT 1");

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


            <form id="cbcReportForm" class="cbc-report-form">
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

                        <p>PID: 55</p>
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
                <h3 class="report-title">Full Blood Count (FBC)</h3>
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
                            <td>Primary Sample Type</td>
                            <td>Blood</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Hemoglobin</strong></td>
                        </tr>
                        <tr>
                            <td>Hemoglobin (Hb)</td>
                            <td><input type="number" id="hemoglobin" step="0.1"></td>
                            <td>13.0 - 17.0</td>
                            <td>g/dL</td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>RBC Count</strong></td>
                        </tr>
                        <tr>
                            <td>Total RBC count</td>
                            <td><input type="number" id="rbcCount" step="0.1"></td>
                            <td>4.5 - 5.5</td>
                            <td>mill/cumm</td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Blood Indices</strong></td>
                        </tr>
                        <tr>
                            <td>Packed Cell Volume (PCV)</td>
                            <td><input type="number" id="pcv" step="0.1"></td>
                            <td>40 - 50</td>
                            <td>%</td>
                        </tr>
                        <tr>
                            <td>Mean Corpuscular Volume (MCV)</td>
                            <td><input type="number" id="mcv" step="0.1"></td>
                            <td>83 - 101</td>
                            <td>fL</td>
                        </tr>
                        <tr>
                            <td>MCH</td>
                            <td><input type="number" id="mch" step="0.1"></td>
                            <td>27 - 32</td>
                            <td>pg</td>
                        </tr>
                        <tr>
                            <td>MCHC</td>
                            <td><input type="number" id="mchc" step="0.1"></td>
                            <td>32.5 - 34.5</td>
                            <td>g/dL</td>
                        </tr>
                        <tr>
                            <td>RDW</td>
                            <td><input type="number" id="rdw" step="0.1"></td>
                            <td>11.6 - 14.0</td>
                            <td>%</td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>WBC Count</strong></td>
                        </tr>
                        <tr>
                            <td>Total WBC count</td>
                            <td><input type="number" id="wbcCount" step="1"></td>
                            <td>4000 - 11000</td>
                            <td>cumm</td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Differential WBC Count</strong></td>
                        </tr>
                        <tr>
                            <td>Neutrophils</td>
                            <td><input type="number" id="neutrophils" step="1"></td>
                            <td>50 - 62</td>
                            <td>%</td>
                        </tr>
                        <tr>
                            <td>Lymphocytes</td>
                            <td><input type="number" id="lymphocytes" step="1"></td>
                            <td>20 - 40</td>
                            <td>%</td>
                        </tr>
                        <tr>
                            <td>Eosinophils</td>
                            <td><input type="number" id="eosinophils" step="1"></td>
                            <td>00 - 06</td>
                            <td>%</td>
                        </tr>
                        <tr>
                            <td>Monocytes</td>
                            <td><input type="number" id="monocytes" step="1"></td>
                            <td>00 - 10</td>
                            <td>%</td>
                        </tr>
                        <tr>
                            <td>Basophils</td>
                            <td><input type="number" id="basophils" step="1"></td>
                            <td>00 - 02</td>
                            <td>%</td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Platelet Count</strong></td>
                        </tr>
                        <tr>
                            <td>Platelet Count</td>
                            <td><input type="number" id="plateletCount" step="1"></td>
                            <td>150000 - 410000</td>
                            <td>cumm</td>
                        </tr>
                        <tr>
                            <td colspan="4">Instruments: Fully automated cell counter - Mindray 300</td>
                        </tr>
                        <tr>
                            <td colspan="4">Interpretation: Further confirm for Anemia</td>
                        </tr>
                    </tbody>
                </table>

            </form>

            <div class="signature-block">
                <p>...........................</p>
                <p>Signature</p>
            </div>
        </div>
        <div class="button-group">
            <button style="background-color: darkgoldenrod;" type="button" id="dataFeedButton">Data Feed</button>
            <!-- <button type="submit" class="submit-btn">Submit</button> -->
            <button id="export-btn" onclick="exportToJPG('form-container','<?php echo $pdi ?>','<?php echo $pDetaila['name'] ?>','<?php echo $pDetaila['bloodtest_id'] ?>')">Submit</button>
        </div>
    <?php
    }
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dataFeedButton = document.getElementById('dataFeedButton');
            // const submitButton = document.querySelector('.submit-btn');

            const form = document.getElementById('cbcReportForm');
            let formObject = {};

            dataFeedButton.addEventListener('click', function() {
                document.getElementById('hemoglobin').value = (13 + Math.random() * 4).toFixed(1); // Hemoglobin 13-17 g/dL
                document.getElementById('rbcCount').value = (4.5 + Math.random() * 1).toFixed(1); // RBC Count 4.5-5.5 mill/cumm
                document.getElementById('pcv').value = (40 + Math.random() * 10).toFixed(1); // PCV 40-50%
                document.getElementById('mcv').value = (83 + Math.random() * 18).toFixed(1); // MCV 83-101 fL
                document.getElementById('mch').value = (27 + Math.random() * 5).toFixed(1); // MCH 27-32 pg
                document.getElementById('mchc').value = (32.5 + Math.random() * 2).toFixed(1); // MCHC 32.5-34.5 g/dL
                document.getElementById('rdw').value = (11.6 + Math.random() * 2.4).toFixed(1); // RDW 11.6-14.0%
                document.getElementById('wbcCount').value = (4000 + Math.random() * 7000).toFixed(0); // WBC Count 4000-11000 cumm
                document.getElementById('neutrophils').value = (50 + Math.random() * 12).toFixed(0); // Neutrophils 50-62%
                document.getElementById('lymphocytes').value = (20 + Math.random() * 20).toFixed(0); // Lymphocytes 20-40%
                document.getElementById('eosinophils').value = (Math.random() * 6).toFixed(0); // Eosinophils 0-6%
                document.getElementById('monocytes').value = (Math.random() * 10).toFixed(0); // Monocytes 0-10%
                document.getElementById('basophils').value = (Math.random() * 2).toFixed(0); // Basophils 0-2%
                document.getElementById('plateletCount').value = (150000 + Math.random() * 260000).toFixed(0); // Platelet Count 150000-410000 cumm
            });

            // submitButton.addEventListener('click', function(event) {
            //     event.preventDefault();

            //     if (!formValidation()) {
            //         // alert("cant't submit blank test report")
            //         Swal.fire({
            //                     icon: "error",
            //                     title: "Oops..!",
            //                     background: "#fff",
            //                     text: "cant't submit blank test report!",
            //                     showConfirmButton: true,
            //                     customClass: {
            //                         popup: 'swal2-dark'
            //                     }

            //                     // timer: 2000
            //                 })
            //         return
            //     }

            //     let inputs = Array.from(form.querySelectorAll('input'));

            //     for (const input of inputs) {
            //         let id = input.getAttribute('id');
            //         let value = input.value;
            //         console.log(id, value)
            //     }
            // });



        });

        function exportToJPG(divID, pdi, name, bloodtest_id) {

            if (!formValidation()) {
                // alert("cant't Export a blank test report")
                Swal.fire({
                    icon: "error",
                    title: "Oops..!",
                    background: "#fff",
                    text: "cant't submit blank test report!",
                    showConfirmButton: true,
                    customClass: {
                        popup: 'swal2-dark'
                    }

                    // timer: 2000
                })
                return
            }
            const div = document.getElementById(divID); // Replace 'report' with the ID of your div

            html2canvas(div).then(canvas => {
                const imageData = canvas.toDataURL('image/jpeg');

                // optional;
                // const postData ={
                //     image: encodeURIComponent(imageData),
                //     pdi: pdi,
                //     name: name,
                //     bloodtestId: bloodtest_id,
                // };

                const postData = 'image=' + encodeURIComponent(imageData) +
                    '&pdi=' + encodeURIComponent(pdi) +
                    '&name=' + encodeURIComponent(name) +
                    '&bloodtestId=' + encodeURIComponent(bloodtest_id) +
                    '&type=' + encodeURIComponent('cbc');

                // optional;

                fetch('save_image.php', {
                        method: 'POST',
                        headers: {
                            // 'Content-Type': 'application/json'
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        // body: 'image=' + encodeURIComponent(imageData)
                        // body: JSON.stringify(postData)
                        body: postData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // alert(data);
                        if (data == "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Complete!",
                                background: "#fff",
                                text: "blood test report sent successfully!",
                                showConfirmButton: true,
                                customClass: {
                                    popup: 'swal2-dark'
                                }

                                // timer: 2000
                            }).then(() => {
                                // alert(data);
                                window.location.href = 'mlt.php?name=registered_mlt';
                                // location.reload();
                                // window.location = "index.php";
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                // color: "#22252c",
                                background: "#fff",
                                // text: "Something went wrong!",
                                text: data,
                                customClass: {
                                    popup: 'swal2-dark'
                                }

                                // footer: '<a href="#">Why do I have this issue?</a>'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        }

        function formValidation() {
            for (const input of Array.from(document.querySelectorAll('input'))) {
                if (input.value == "") return false;
            }
            return true
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>