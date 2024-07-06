<?php
session_start();
require_once "../connection.php"; ?>

<head>
    <style>
        .medicine-inventory {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }

        .medicine-inventory h2,
        .medicine-inventory h3 {
            color: var(--base-color);
            margin-bottom: 20px;
        }

        .medicine-inventory h2 {
            margin-bottom: 30px;
        }

        .medicine-form {
            display: flex;
            flex-wrap: wrap;
            position: relative;
            gap: 20px;
            margin-bottom: 50px;
            padding-bottom: 50px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--dark-gray);
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--medium-gray);
            border-radius: 5px;
            font-size: 1em;
            color: var(--dark-gray);
            background-color: #FFFFFF;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: var(--base-color);
            outline: none;
        }

        button[type="submit"] {
            position: absolute;
            bottom: 0%;
            padding: 10px 15px;
            background-color: var(--base-color);
            border: none;
            border-radius: 5px;
            color: #FFFFFF;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
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

        tbody tr:hover {
            background-color: var(--medium-gray);
            color: white;
            cursor: pointer;
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
            z-index: 1000;
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

        #searchBar {
        width: 50%;
        /* margin-top: 50px; */
        min-width: 200px;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid var(--medium-gray);
        border-radius: 5px;
        font-size: 16px;
        outline: none;
    }

    #searchBar:focus {
        border-color: var(--base-color);
    }
    </style>
</head>

<body>



    <div class="medicine-inventory">
        <h2>Reports History</h2>
        <input type="text" id="searchBar" placeholder="Search Medicine..." onkeyup="filterTable()">
        <table id="medicineTable">
            <thead>
                <tr>
                    <th>PID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Report Type</th>
                    <th>Issued Date</th>
                </tr>
            </thead>
            <tbody>

                <?php


                $patiientResultSet = Database::search("SELECT  `bloodtest`.`reportName` AS `reportName`,`bloodtest`.`issued_Date` AS `isdate`,`bloodtest`.`id` AS `bid`, `registered_patients`.`name` AS `name`,`patients_details`.`age` AS `age`,`bloodtest`.`test_type` AS `test_type` 
FROM `patients_details` 
INNER JOIN  `registered_patients` ON `registered_patients`.`p_id` = `patients_details`.`patients_id`
INNER JOIN  `bloodtest` ON `bloodtest`.`patientDetails_id` = `patients_details`.`id`
WHERE `bloodtest`.`mlt_id` = '" . $_SESSION["idnum"] . "' AND  `patients_details`.`id` NOT IN (SELECT `patientDetails_id` FROM `bloodtest` WHERE (`reportName` is null or `reportName` = '') ) ORDER BY `bloodtest`.`issued_Date` DESC");

                $numRows = $patiientResultSet->num_rows;

                if ($numRows > 0) {
                    while ($patientDetails = $patiientResultSet->fetch_assoc()) {
                ?>

                        <tr onclick="openReportImage('<?php echo $patientDetails['reportName'] ?>')">
                            <td><?php echo $patientDetails["bid"] ?></td>
                            <td><?php echo $patientDetails["name"] ?></td>
                            <td><?php echo $patientDetails["age"] ?></td>
                            <td><?php echo $patientDetails["test_type"] ?> Report</td>
                            <td><?php echo $patientDetails["isdate"] ?></td>
                          
                        </tr>
                                                               <?php
                    }
                }
                ?>
            </tbody>

        </table>
      

          <!-- The Modal -->
          <div id="myModal" class="modal">
                    <span onclick="closeOpenImage()" class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
    </div>


</body>