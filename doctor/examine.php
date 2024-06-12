<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examine</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container-header {
            width: 100%;
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 10px;
        }

        .container-header h1 {
            margin: 0% auto;
        }

        .examined-btn {
            position: absolute;
            right: 0%;
            padding: 10px 15px;
            background-color: var(--base-color);
            border: none;
            border-radius: 5px;
            color: #FFFFFF;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .examined-btn:hover {
            background-color: var(--second-base-color);
        }

        h1 {
            color: var(--base-color);
            text-align: center;
            margin-bottom: 20px;
        }

        .patient-details {
            background-color: rgb(241, 241, 241);
            padding: 20px;
            border-radius: 10px;
        }

        .patient-details,
        .health-issues,
        .doctor-prescription,
        .medical-report,
        .symptoms-table-container {
            margin-bottom: 20px;
        }

        h3 {
            color: var(--base-color);
            margin-bottom: 10px;
        }

        .patient-details p,
        .health-issues p {
            margin: 5px 0;
            color: var(--dark-gray);
        }

        textarea {
            width: 100%;
            max-width: 100%;
            min-width: 100%;
            padding: 10px;
            border: 1px solid var(--medium-gray);
            border-radius: 5px;
            font-size: 1em;
            color: var(--dark-gray);
            background-color: #FFFFFF;
            transition: border-color 0.3s;
        }

        textarea:focus {
            border-color: var(--base-color);
            outline: none;
        }

        .submit-records {
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: var(--base-color);
            border: none;
            border-radius: 5px;
            color: #FFFFFF;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-records:hover {
            background-color: var(--second-base-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            text-align: left;
        }

        thead th {
            background-color: var(--base-color);
            color: #FFFFFF;
        }

        tbody tr {
            cursor: pointer;
        }

        tbody tr:hover {
            background-color: var(--medium-gray);
            color: white;
        }

        .status-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 0.9em;
            cursor: pointer;
        }

        .status-btn.pending {
            background-color: var(--base-color);
            color: white;
        }

        .status-btn.checked {
            background-color: var(--medium-gray);
            color: white;
        }

        .popup-container {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
        }

        .details-columns {
            display: flex;
            justify-content: space-between;
        }

        .details-column {
            width: 45%;
        }

        .details-column h3 {
            margin-top: 0;
        }

        .details-column p {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: max-content min-content max-content;
            align-items: first baseline;
            column-gap: 10px;
        }
    </style>
</head>

<body>


    <?php


    require_once "../connection.php";

    $pid = $_GET["pid"];



    $patiientResultSet = Database::search("SELECT `patients_details`.`id` AS `pdi`,`registered_patients`.`age` AS `age`, `registered_patients`.`name` AS `name`, `registered_patients`.`email` AS `email`,
     `registered_patients`.`mobile` AS `mobile`, `registered_patients`.`address` AS `address`, `patients_details`.`symptoms` AS `symptoms`
      FROM `registered_patients` INNER JOIN `patients_details` ON `registered_patients`.`p_id` =`patients_details`.`patients_id`  WHERE `p_id` = '" . $pid . "'");

    $numRows = $patiientResultSet->num_rows;

    if ($numRows == 1) {
        $pDetaila = $patiientResultSet->fetch_assoc();
 

    ?>

    <div class="container">
        <div class="container-header">
            <h1>Patient Examination</h1>
            <!-- <button onclick="examined()" class="examined-btn">Examined</button> -->
            <button onclick="examined(<?php echo $pDetaila['pdi'] ?>)" id="examined-btn" class="examined-btn">Examined</button>
        </div>

     

            <div class="patient-details">
                <h3>Patient Details</h3>


                <div class="detail-grid">
                    <strong>Name</strong>
                    <strong>:</strong>
                    <p><?php echo $pDetaila["name"] ?></p>
                    <strong>Age</strong>
                    <strong>:</strong>
                    <p><?php echo $pDetaila["age"] ?></p>
                    <strong>Email</strong>
                    <strong>:</strong>
                    <p><?php echo $pDetaila["email"] ?></p>
                    <strong>Contact Number</strong>
                    <strong>:</strong>
                    <p><?php echo $pDetaila["mobile"] ?></p>
                    <strong>Address</strong>
                    <strong>:</strong>
                    <p><?php echo $pDetaila["address"] ?></p>
                </div>

            </div>

            <div class="health-issues">
                <h3 style="color: red;">Current Health Issues</h3>
                <p><?php echo $pDetaila["symptoms"] ?></p>
            </div>



            <div class="doctor-prescription">
                <h3>Doctor's Prescription</h3>
                <textarea id="prescription" rows="4" placeholder="Enter doctor's prescription here..."></textarea>
                <button onclick="submitPrescription(<?php echo $pDetaila['pdi'] ?>)" class="submit-records">Sumbit</button>
            </div>

            <div class="medical-report">
                <h3>Patient Medical Report</h3>
                <textarea id="medicalReport" rows="4" placeholder="Enter patient medical report here..."></textarea>
                <button onclick="submitPrescription(<?php echo $pDetaila['pdi'] ?>)" class="submit-records">Sumbit</button>
            </div>

        <?php
        }
        ?>

        <div class="symptoms-table-container">
            <h3>Patient Records</h3>
            <table id="symptomsTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Symptoms Added Date and Time</th>
                        <!-- <th>Age</th> -->
                        <th>Doctor Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="showPopup('details-popup')">
                        <td>1</td>
                        <td>2024-06-01 10:00 AM</td>
                        <!-- <td>30</td> -->
                        <td><button class="status-btn pending">Pending</button></td>
                    </tr>
                    <tr onclick="showPopup('details-popup')">
                        <td>2</td>
                        <td>2024-06-02 11:00 AM</td>
                        <!-- <td>30</td> -->
                        <td><button class="status-btn checked">Checked</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Popup Container for Details -->
        <div id="details-popup" class="popup-container">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup('details-popup')">&times;</span>
                <h2>Details</h2>
                <div class="details-columns">
                    <div class="details-column">
                        <h3>Symptoms</h3>
                        <p id="symptoms-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="details-column">
                        <h3>Prescriptions</h3>
                        <p id="prescriptions-text">Nullam dictum felis eu pede mollis pretium.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#symptomsTable tbody tr');
            const symptomsText = document.getElementById('symptoms-text');
            const prescriptionsText = document.getElementById('prescriptions-text');

            rows.forEach(row => {
                row.addEventListener('click', function() {
                    // Example data - in a real application, you would fetch this data
                    const symptomsData = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
                    const prescriptionsData = "Nullam dictum felis eu pede mollis pretium.";

                    symptomsText.textContent = symptomsData;
                    prescriptionsText.textContent = prescriptionsData;

                    showPopup('details-popup');
                });
            });
        });

        function showPopup(popupId) {
            document.getElementById(popupId).style.display = 'flex';
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = 'none';
        }

        // examinedBtn = document.getElementById('examined-btn');
        // examinedBtn.addEventListener('click', (e) =>
       function examined(pdi)  {
            console.log('examine btn', localStorage.getItem('examined'));
            if (localStorage.getItem('examined') == null || localStorage.getItem('examined') == 'false') {
                localStorage.setItem('examined', 'true');
            }
            submitPrescription(pdi);
            window.location.href = 'doctor.php?name=registered_doctor';
        }
        // )

        function submitPrescription(pid) {
            // http://localhost/HealthCare/doctor/prescriptionProcess.php

            const prescription = document.getElementById("prescription").value;
            const medicalReport = document.getElementById("medicalReport").value;

            const f = new FormData();

            f.append("prescription", prescription);
            f.append("medicalReport", medicalReport);
            f.append("pid", pid);

            fetch("http://localhost/HealthCare/doctor/prescriptionProcess.php", {

                    method: 'POST',
                    body: f,

                })

                .then(responce => {
                    return responce.text();
                })
                .then(data => {
                    alert(data);
                    location.reload();
                })

                .catch(error => {
                    console.log(error);
                })

        }
    </script>
</body>

</html>