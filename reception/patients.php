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
            margin-top: 5px;
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

        .status-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 0.9em;
            cursor: pointer;
            background-color: #fba353;
        }
    </style>





</head>
<h2 class="content-title">Patients</h2>
<input type="text" id="searchBar" placeholder="Search..." onkeyup="filterTable()">
<br>

<table id="dataTable">
    <thead>
        <tr>
            <th>Patients ID</th>
            <th>Patients Name</th>
            <th style="text-align: center;">View</th>
        </tr>
    </thead>
    <tbody>

        <?php
        require_once "../connection.php";


        $patientResultSet = Database::search("SELECT * FROM `registered_patients` ORDER BY `p_id` DESC");

        $patientCount = $patientResultSet->num_rows;

        if ($patientCount > 0) {

            while ($patientResult = $patientResultSet->fetch_assoc()) {
        ?>

                <tr>
                    <td><?php echo $patientResult['p_id'] ?></td>
                    <td><?php echo $patientResult['name'] ?></td>
                    <td  style="text-align: center;"><button onclick="window.location.href='profile-view.php?p_id=<?php echo $patientResult['p_id'] ?>'" class="status-btn">View</button></td>
                </tr>

        <?php
            }
        }

        ?>
    </tbody>
</table>