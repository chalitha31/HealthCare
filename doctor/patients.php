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
    max-width: 650px;
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
    width: 100%;
    display: flex;
    column-gap: 20px;
    justify-content: space-between;
}

.details-column {
    width: 45%;
    flex: 1;
}

.text-container {
    max-height: 600px;
    overflow-y: auto;
}

.details-column h3 {
    margin-top: 0;
    margin-bottom: 10px;
    color: var(--medium-gray);
}

.details-column p {
    background-color: #f4f4f4;
    padding: 10px;
    border-radius: 5px;
}
.popup-content h2 {
    color: var(--base-color);
    margin-bottom: 20px;
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
                $recordId = $docRes["id"]; 
        ?>
                <tr onclick="showPopup('details-popup-<?php echo $recordId; ?>')">
                    <td ><?php echo $docRes["id"] ?></td>
                    <td><?php echo $docRes["name"] ?></td>
                    <td><?php echo $docRes["Prescriptions_date"] ?></td>
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
                                                <p class="symptoms-text"><?php echo $docRes["symptoms"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="details-column">
                                            <h3>Prescriptions</h3>
                                            <div class="text-container">
                                                <p class="prescriptions-text"><?php echo $docRes["Prescriptions"]; ?></p>
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