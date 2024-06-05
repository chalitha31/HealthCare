<?php
require_once "../connection.php";

$patient_id = $_GET["p_id"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile View</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/profile-view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="header">
        <div class="logo">Healthcare</div>
        <div class="header-username">UserName</div>
    </header>
    <div class="container">
        <div class="profile-details">
            <div class="detail-heading">
                <h2>Patient Details</h2>
                <i class="fa-solid fa-pen-to-square"></i>
            </div>

            <?php

            $patientResultSet = Database::search("SELECT * FROM `registered_patients` WHERE `p_id` = '" . $patient_id . "'");

            $patientCount = $patientResultSet->num_rows;

            if ($patientCount == 1) {
                $patientResult = $patientResultSet->fetch_assoc();
            ?>

                <div class="form-row">
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="profile-inputs" type="text" id="name" name="name" value="<?php echo $patientResult["name"]; ?>" disabled required>
                        <!-- <span>John Doe</span> -->
                    </div>
                    <div class="form-group">
                        <label>NIC:</label>
                        <input class="profile-inputs" type="text" id="nic" name="name" value="<?php echo $patientResult["id_num"]; ?>" disabled required>
                        <!-- <span>123456789V</span> -->
                    </div>
                    <div class="form-group">
                        <label>Age:</label>
                        <input class="profile-inputs" type="number" id="age" name="age" value="<?php echo $patientResult["age"]; ?>" disabled required>
                        <!-- <span>30</span> -->
                    </div>
                    <div class="form-group">
                        <label>Email (optional):</label>
                        <input class="profile-inputs" type="email" id="email" name="email" value="<?php echo $patientResult["email"]; ?>" disabled>
                        <!-- <span>john.doe@example.com</span> -->
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input class="profile-inputs" type="text" id="address" name="address" value="<?php echo $patientResult["address"]; ?>" disabled required>
                        <!-- <span>123 Main Street</span> -->
                    </div>
                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input class="profile-inputs" type="text" id="contact" name="contact" value="<?php echo $patientResult["mobile"]; ?>" disabled required>
                        <!-- <span>+123456789</span> -->
                    </div>
                </div>
                <button class="save-details">Save</button>

            <?php
            }
            ?>


        </div>



        <!-- <hr> -->

        <div class="symptoms-table-container">
            <button onclick="showPopup('add-symptoms-popup')" class="add-symptoms-btn">Add New Symptoms</button>
            <h2>Patient Records</h2>
            <table id="symptomsTable">
                <thead>
                    <tr>
                        <th>Record No</th>
                        <th>Symptoms Added Date and Time</th>
                        <th>Age</th>
                        <th>Doctor Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $patientDetailsResultSet = Database::search("SELECT * FROM `patients_details` WHERE `patients_id` = '" . $patient_id . "'");

                    $patientDetailsCount = $patientDetailsResultSet->num_rows;

                    if ($patientDetailsCount > 0) {
                        while ($patientDetailsResult = $patientDetailsResultSet->fetch_assoc()) {
                    ?>

                            <tr onclick="showPopup('details-popup')">
                                <td><?php echo $patientDetailsResult["id"]; ?></td>
                                <td><?php echo $patientDetailsResult["symptoms_date"]; ?></td>
                                <td><?php echo $patientDetailsResult["age"]; ?></td>

                                <?php

                                if ($patientDetailsResult["Prescriptions"] == "") {
                                ?>

                                    <td><button class="status-btn pending">pending</button></td>

                                <?php
                                } else {
                                ?>
                                    <td><button class="status-btn checked">Checked</button></td>

                                <?php
                                }

                                ?>

                            </tr>
                            <!-- <tr onclick="showPopup('details-popup')">
                                <td>2</td>
                                <td>2024-06-02 11:00 AM</td>
                                <td>30</td>
                                <td><button class="status-btn checked">Checked</button></td>
                            </tr> -->




                            <!-- Popup Container for Details -->

                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <div id="details-popup" class="popup-container">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup('details-popup')">&times;</span>
                <h2>Record</h2>
                <div class="details-columns">
                    <div class="details-column">
                        <h3>Symptoms</h3>
                        <div class="text-container">
                            <!-- <p class="symptoms-text"><?php echo $patientDetailsResult["symptoms"]; ?></p> -->
                            <p class="prescriptions-text">Nullam dictum felis eu pede mollis pretium.</p>
                            <p class="prescriptions-text">Nullam dictum felis eu pede mollis pretium.</p>
                            <p class="prescriptions-text">Nullam dictum felis eu pede mollis pretium.</p>
                            <p class="prescriptions-text">Nullam dictum felis eu pede mollis pretium.</p>

                        </div>
                    </div>
                    <div class="details-column">
                        <h3>Prescriptions</h3>
                        <div class="text-container">
                            <p class="prescriptions-text">Nullam dictum felis eu pede mollis pretium.</p>
                            <p class="prescriptions-text">Nullam dictum felis eu pede mollis pretium.</p>s
                            <!-- <p class="prescriptions-text"><?php echo $patientDetailsResult["Prescriptions"]; ?></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup Container for Adding Symptoms -->
        <div id="add-symptoms-popup" class="popup-container">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup('add-symptoms-popup')">&times;</span>
                <h2>Add New Symptoms</h2>
                <form id="addSymptomsForm">
                    <div class="form-group">
                        <!-- <label for="symptoms">Symptoms:</label> -->
                        <textarea id="symptoms" name="symptoms" rows="4" required></textarea>
                    </div>
                    <button type="submit">Add Symptoms</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/profile-view.js"></script>
</body>

</html>