<head>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--base-color);
            text-align: center;
            margin-bottom: 20px;
        }

        .queue-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .queue-info h3 {
            color: var(--base-color);
        }

        .patient-cards {
            display: flex;
            flex-wrap: wrap;
            height: max-content;
            gap: 20px;
            justify-content: center;
        }

        .patient-card {
            background-color: #fff;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(25% - 20px);
            text-align: center;
            display: flex;
            flex-direction: column;
        }

        .patient-card h3 {
            color: var(--dark-gray);
            margin-bottom: 10px;
        }

        .patient-card p {
            color: var(--dark-gray);
            margin-bottom: 15px;
        }

        .examine-btn {
            padding: 10px 15px;
            background-color: var(--base-color);
            border: none;
            border-radius: 5px;
            color: #FFFFFF;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: auto;
        }

        .examine-btn:hover {
            background-color: var(--second-base-color);
        }

        @media (max-width: 768px) {
            .patient-card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .patient-card {
                width: 100%;
            }
        }
    </style>
</head>

<?php
session_start();
require_once "../connection.php";


$totalResultSet = Database::search("SELECT COUNT(*) AS total FROM `patients_details` 
WHERE `Prescriptions` != '' AND `medicine_status` = 'pending' ");

// `id` NOT IN (SELECT `patientDetails_id` FROM `bloodtest`  WHERE (`reportName` is null or `reportName` = ''))

$totalRow = $totalResultSet->fetch_assoc();
$totalPatients = $totalRow['total'];

?>

<body>
    <div class="container">
        <h1>Patients accepting Medicine</h1>

        <div class="queue-info">
            <!-- <h3>Number of Patients in Queue: <span id="queueCount">4</span></h3> -->
            <h3>Number of Patients in Queue : <span style="color: red; font-weight: 900;" id="queueCount"><?php echo $totalPatients ?></span></h3>
        </div>

        <div class="patient-cards">
            <?php
            $patiientResultSet = Database::search("SELECT  `patients_details`.`id` AS `pid`, `registered_patients`.`name` AS `name`,`patients_details`.`age` AS `age` 
        FROM `patients_details` 
        INNER JOIN  `registered_patients` ON `registered_patients`.`p_id` = `patients_details`.`patients_id`
        WHERE `patients_details`.`Prescriptions` != '' AND `patients_details`.`medicine_status`  = 'pending'   LIMIT 8");

            $numRows = $patiientResultSet->num_rows;

            if ($numRows > 0) {
                while ($patientDetails = $patiientResultSet->fetch_assoc()) {
            ?>

                    <!-- <div class="patient-card">
                <h3>John Doe</h3>
                <p><strong>Age:</strong> 30</p>
                <button class="examine-btn" onclick="examinePatient()">Produce</button>
            </div> -->

                    <div class="patient-card">
                        <h3><?php echo $patientDetails["name"] ?></h3>
                        <p><strong>Age:</strong> <?php echo $patientDetails["age"] ?></p>
                        <button class="examine-btn" onclick="examinePatient(<?php echo $patientDetails['pid'] ?>)">Checking</button>
                    </div>

            <?php
                }
            }
            ?>

        </div>
    </div>
</body>