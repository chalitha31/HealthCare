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
        }
    </style>
</head>

<body>



    <div class="medicine-inventory">
        <h2>Reports History</h2>
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
require_once "../connection.php";
session_start();

$patiientResultSet = Database::search("SELECT  `bloodtest`.`issued_Date` AS `isdate`,`bloodtest`.`id` AS `bid`, `registered_patients`.`name` AS `name`,`patients_details`.`age` AS `age`,`bloodtest`.`test_type` AS `test_type` 
FROM `patients_details` 
INNER JOIN  `registered_patients` ON `registered_patients`.`p_id` = `patients_details`.`patients_id`
INNER JOIN  `bloodtest` ON `bloodtest`.`patientDetails_id` = `patients_details`.`id`
WHERE `bloodtest`.`mlt_id` = '".$_SESSION["idnum"]."' AND  `patients_details`.`id` NOT IN (SELECT `patientDetails_id` FROM `bloodtest` WHERE (`reportName` is null or `reportName` = '') )");

    $numRows = $patiientResultSet->num_rows;

    if ($numRows > 0) {
        while ($patientDetails = $patiientResultSet->fetch_assoc()) {
    ?>

                <tr>
                    <td><?php echo $patientDetails["bid"] ?></td>
                    <td><?php echo $patientDetails["name"] ?></td>
                    <td><?php echo $patientDetails["age"] ?></td>
                    <td><?php echo $patientDetails["test_type"] ?> Report</td>
                    <td><?php echo $patientDetails["isdate"] ?></td>
                </tr>
                <?php 
    }}
                ?>
            </tbody>

        </table>
    </div>


</body>