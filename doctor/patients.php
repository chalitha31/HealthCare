<head>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #searchBar {
            width: 30%;
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

        table {
            width: 80%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            text-align: left;
        }

        th {
            background-color: var(--base-color);
            color: white;
        }

        tbody tr {
            cursor: pointer;
        }


        tbody tr:nth-child(even) {
            background-color: #e6e6e6;
        }

        tbody tr:hover {
            background-color: var(--medium-gray);
            color: white;
        }
    </style>

    <script>


    </script>
</head>



<h2 class="content-title">Patients</h2>
<input type="text" id="searchBar" placeholder="Search..." onkeyup="filterTable()">
<table id="dataTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Checked Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once "../connection.php";
        session_start();

        $docresSet = Database::search("SELECT * FROM `patients_details` INNER JOIN `registered_patients` ON `registered_patients`.`p_id` = `patients_details`.`patients_id` WHERE `patients_details`.`doctor_id` = '" . $_SESSION["idnum"] . "'");
        $numr = $docresSet->num_rows;

        if ($numr > 0) {
            while ($docRes = $docresSet->fetch_assoc()) {
        ?>
                <tr onclick="window.location.href='#'">
                    <td><?php echo $docRes["id"] ?></td>
                    <td><?php echo $docRes["name"] ?></td>
                    <td><?php echo $docRes["Prescriptions_date"] ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>