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
            white-space: pre-line;
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

        .req-test {
            display: flex;
            flex-direction: column;
            max-width: max-content;
            gap: 10px;
            margin-bottom: 20px;
        }

        .req-test select {
            padding: 5px;
        }

        .req-test .submit-records {
            width: max-content;
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

        /* image view model */

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }

        /* image view model */
    </style>
</head>

<body>


    <?php


    require_once "../connection.php";

    $pid = $_GET["pid"];



    $patiientResultSet = Database::search("SELECT `registered_patients`.`p_id` AS `p_id`,`patients_details`.`medical_report` AS `mediReport`,`patients_details`.`id` AS `pdi`,`patients_details`.`age` AS `age`, `registered_patients`.`name` AS `name`, `registered_patients`.`email` AS `email`,
     `registered_patients`.`mobile` AS `mobile`, `registered_patients`.`address` AS `address`, `patients_details`.`symptoms` AS `symptoms`, `patients_details`.`Prescriptions` AS `prescriptions`
      FROM `registered_patients` INNER JOIN `patients_details` ON `registered_patients`.`p_id` =`patients_details`.`patients_id`  WHERE `patients_details`.`id` = '" . $pid . "'");

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
                <!-- echo htmlspecialchars_decode($pDetaila["symptoms"]) ?> -->
                <p style="white-space:pre-wrap;"><?php echo $pDetaila["symptoms"] ?></p>
            </div>

            <br />
            <br />
            <?php
            if ($pDetaila['prescriptions'] == '') {
            ?>
            <div class="req-test">
                <h3>Request a Test from MLT</h3>
                <label for="test">Test Type:</label>

                <select name="test" id="test">
                    <option value="cbc">CBC</option>
                    <option value="hdl">HDL</option>
                    <option value="ldl">LDL</option>
                    <option value="ppbs">PPBS</option>
                    <option value="vldl">VLDL</option>
                    <option value="fbs">FBS</option>
                </select>
                <button onclick="mltBloodRequest(<?php echo $pid ?>);" class="submit-records">Sumbit</button>

                <?php

                $mltBloodResultSet = Database::search("SELECT * FROM `bloodtest` WHERE `patientDetails_id` = '" . $pid . "'  ORDER BY `id` DESC LIMIT 1");
                $mltBloodRow = $mltBloodResultSet->num_rows;
                if ($mltBloodRow == 1) {
                    $mltBloodData = $mltBloodResultSet->fetch_assoc();

                    if ($mltBloodData['reportName'] != '' || $mltBloodData['reportName'] != null) {
                ?>
                        <img id="myImg" src="../MLT/images/<?php echo $mltBloodData['reportName'] ?>" alt="Medical Report" style="width:50%;max-width:80px;border: 2px solid red;">

                        <!-- The Modal -->
                        <div id="myModal" class="modal">
                            <span onclick="closeOpenImage()"  class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>

                        <button onclick="openReportImage()" class="submit-records">View Test Report</button>

                <?php
                    }
                }
                ?>
            </div>

            <br />
            <!--p & m -->
            <?php
            }
            if ($pDetaila['prescriptions'] == '') {
            ?>

                <div class="doctor-prescription">
                    <h3>Doctor's Prescription</h3>
                    <textarea style="white-space: pre-line;" id="prescription" rows="4" placeholder="Enter doctor's prescription here..."></textarea>
                    <?php
                    if ($pDetaila['mediReport'] == 'no') {
                    ?>
                        <button onclick="submitPrescription('<?php echo $pDetaila['pdi'] ?>','no')" class="submit-records">Sumbit</button>

                    <?php
                    }

                    ?>
                </div>

                <?php
                if ($pDetaila['mediReport'] == 'yes') {
                ?>

                    <div class="medical-report">
                        <h3>Patient Medical Report</h3>
                        <textarea style="white-space: pre-line;" id="medicalReport" rows="4" placeholder="Enter patient medical report here..."></textarea>
                        <!-- <button onclick="submitPrescription(<?php echo $pDetaila['pdi'] ?>)" class="submit-records">Sumbit</button> -->
                    </div>

                    <button onclick="submitPrescription('<?php echo $pDetaila['pdi'] ?>','yes')" class="submit-records">Sumbit</button>


            <?php
                }
            }
            ?>


            <!--p & m -->

            <div class="symptoms-table-container">
                <h3>Patient Records</h3>
                <table id="symptomsTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Symptoms Added Date and Time</th>
                            <th>Age</th>
                            <th>Doctor Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr onclick="showPopup('details-popup')">
                        <td>1</td>
                        <td>2024-06-01 10:00 AM</td>
                       
                        <td><button class="status-btn pending">Pending</button></td>
                    </tr>
                    <tr onclick="showPopup('details-popup')">
                        <td>2</td>
                        <td>2024-06-02 11:00 AM</td>
                       
                        <td><button class="status-btn checked">Checked</button></td>
                    </tr> -->


                        <?php
                        $patientDetailsResultSet = Database::search("SELECT * FROM `patients_details` WHERE `patients_id` = '" . $pDetaila['p_id'] . "' ORDER BY `id` DESC");
                        $patientDetailsCount = $patientDetailsResultSet->num_rows;

                        if ($patientDetailsCount > 0) {
                            while ($patientDetailsResult = $patientDetailsResultSet->fetch_assoc()) {
                                $recordId = $patientDetailsResult["id"]; // Assuming id is unique for each record
                        ?>
                                <tr onclick="showPopup('details-popup-<?php echo $recordId; ?>')">
                                    <td><?php echo $recordId; ?></td>
                                    <td><?php echo $patientDetailsResult["symptoms_date"]; ?></td>
                                    <td><?php echo $patientDetailsResult["age"]; ?></td>

                                    <?php if (empty($patientDetailsResult["Prescriptions"])) { ?>
                                        <td><button class="status-btn pending">Pending</button></td>
                                    <?php } else { ?>
                                        <td><button class="status-btn checked">Checked</button></td>
                                    <?php } ?>
                                </tr>

                                <!-- Popup Container for Details -->
                                <div id="details-popup-<?php echo $recordId; ?>" class="popup-container" style="display: none;">
                                    <div class="popup-content">
                                        <span class="close-btn" onclick="closePopup('details-popup-<?php echo $recordId; ?>')">&times;</span>
                                        <h2>Record</h2>
                                        <div class="details-columns">
                                            <div class="details-column">
                                                <h3>Symptoms</h3>
                                                <div class="text-container">
                                                    <p class="symptoms-text"><?php echo $patientDetailsResult["symptoms"]; ?></p>
                                                </div>
                                            </div>
                                            <div class="details-column">
                                                <h3>Prescriptions</h3>
                                                <div class="text-container">
                                                    <p class="prescriptions-text"><?php echo $patientDetailsResult["Prescriptions"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Popup Container for Details -->
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <!-- Popup Container for Details -->
            <!-- <div id="details-popup" class="popup-container">
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
        </div> -->
        </div>
    <?php
    }

    ?>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // const rows = document.querySelectorAll('#symptomsTable tbody tr');
            // const symptomsText = document.getElementById('symptoms-text');
            // const prescriptionsText = document.getElementById('prescriptions-text');

            // rows.forEach(row => {
            //     row.addEventListener('click', function() {
            //         // Example data - in a real application, you would fetch this data
            //         const symptomsData = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
            //         const prescriptionsData = "Nullam dictum felis eu pede mollis pretium.";

            //         symptomsText.textContent = symptomsData;
            //         prescriptionsText.textContent = prescriptionsData;

            //         showPopup('details-popup');
            //     });
            // });
        });

        function showPopup(popupId) {
            document.getElementById(popupId).style.display = 'flex';
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = 'none';
        }

        // examinedBtn = document.getElementById('examined-btn');
        // examinedBtn.addEventListener('click', (e) =>
        function examined(pdi) {
            // console.log('examine btn', localStorage.getItem('examined'));
            if (localStorage.getItem('doc-exmlist') == null || localStorage.getItem('doc-exmlist') == 'false') {
                localStorage.setItem('doc-exmlist', 'true');
            }
            // submitPrescription(pdi);
            fetch("http://localhost/HealthCare/doctor/examineProcess.php?pdi=" + pdi, {

                    method: 'GET',

                })

                .then(responce => {
                    return responce.text();
                })
                .then(data => {
                    // alert(data);
                    // location.reload();

                    if (data == "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Your work has been saved",
                            background: "#fff",
                            text: "patient examined successfully!",
                            showConfirmButton: true,
                            customClass: {
                                popup: 'swal2-dark'
                            }

                            // timer: 2000
                        }).then(() => {
                            // alert(data);
                            window.location.href = 'doctor.php?name=registered_doctor';
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
                    console.log(error);
                })

            // window.location.href = 'doctor.php?name=registered_doctor';
        }
        // )

        function submitPrescription(pid, mediReport) {
            // http://localhost/HealthCare/doctor/prescriptionProcess.php

            const prescription = document.getElementById("prescription").value;
            let medicalReport = '';
            if (mediReport == 'yes') {
                medicalReport = document.getElementById("medicalReport").value;
            }
            const f = new FormData();

            f.append("prescription", prescription);
            if (mediReport == 'yes') {
                f.append("medicalReport", medicalReport);
            }
            f.append("pid", pid);

            fetch("http://localhost/HealthCare/doctor/prescriptionProcess.php", {

                    method: 'POST',
                    body: f,

                })

                .then(responce => {
                    return responce.text();
                })
                .then(data => {
                    // alert(data);
                    // location.reload();

                    if (data == "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Your work has been saved",
                            background: "#fff",
                            showConfirmButton: true,
                            customClass: {
                                popup: 'swal2-dark'
                            }

                            // timer: 2000
                        }).then(() => {
                            // alert(data);

                            location.reload();
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
                    console.log(error);
                })

        }


        // blood Request

        function mltBloodRequest(pdi) {

            let testType = document.getElementById("test").value;

            // alert (testType + pdi);

            fetch("http://localhost/HealthCare/doctor/bloodRequestProcess.php?pdi=" + pdi + "&testType=" + testType, {

                    method: 'GET',

                })

                .then(responce => {
                    return responce.text();
                })
                .then(data => {
                    // alert(data);
                    // location.reload();

                    // if (data == "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Complete!",
                        background: "#fff",
                        text: "blood test request sent successfully",
                        showConfirmButton: true,
                        customClass: {
                            popup: 'swal2-dark'
                        }

                        // timer: 2000
                    }).then(() => {
                        // alert(data);
                        // location.reload();  
                        window.location.href = 'doctor.php?name=registered_doctor';
                        // window.location = "index.php";
                    });
                    // } 
                    // else {
                    //     Swal.fire({
                    //         icon: "error",
                    //         title: "Oops...",
                    //         // color: "#22252c",
                    //         background: "#fff",
                    //         // text: "Something went wrong!",
                    //         text: data,
                    //         customClass: {
                    //             popup: 'swal2-dark'
                    //         }

                    //         // footer: '<a href="#">Why do I have this issue?</a>'
                    //     });
                    // }

                })

                .catch(error => {
                    console.log(error);
                })

        }

function openReportImage(){
        // Get the modal
        var modal = document.getElementById("myModal");
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
     
            modal.style.display = "block";
            modalImg.src = img.src;
            captionText.innerHTML = img.alt;
       

    }

    function closeOpenImage(){
        // Get the <span> element that closes the modal
      
        var modal = document.getElementById("myModal");
        // When the user clicks on <span> (x), close the modal
       
            modal.style.display = "none";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>