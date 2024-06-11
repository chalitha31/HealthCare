<?php
session_start();
require_once "connection.php";

$Tname = $_GET["name"];

$resultSet  = Database::search("SELECT * FROM  $Tname  WHERE `id_num` = '" . $_SESSION["idnum"] . "' AND `email` = '" . $_SESSION["email"] . "'");
$numRow = $resultSet->num_rows;
echo "<script>console.log('SELECT * FROM  $Tname  WHERE `id_num` = '" . $_SESSION["idnum"] . "' AND `email` = '" . $_SESSION["email"] . "'')</script>";
if ($numRow > 0) {
    $userData = $resultSet->fetch_assoc();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile View</title>
        <link rel="stylesheet" href="assets/css/common.css">
        <link rel="stylesheet" href="assets/css/header.css">
        <link rel="stylesheet" href="assets/css/employee-profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>



        <header class="header">
            <div class="logo">Healthcare</div>
            <div class="header-username"><?php if (isset($_SESSION["name"])) {
                                                echo $_SESSION["name"];
                                            }
                                            ?></div>
        </header>
        <div class="container">
            <div class="profile-details">
                <div class="detail-heading">
                    <h2>Your Details</h2>
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>

                <div class="image-upload-container">
                    <label for="imageInput" class="image-lable" style="display: none;"><i class="fa-solid fa-cloud-arrow-up"></i></label>
                    <input type="file" id="imageInput" accept="image/*" style="display: none;">
                    <div class="image-preview" id="imagePreview">
                        <?php
                        if (isset($_SESSION["name"])) {
                        ?>
                            <img id="imageDisplay" src="assets/images/Employe_profile/<?php echo $userData["image"] ?>" alt="Employee Image">
                            <!-- <input type="hidden" id="currentImage" name="currentImage" value="<?php echo $userData["image"] ?>" /> -->
                        <?php
                        } else {
                        ?>
                            <img id="imageDisplay" src="" alt="Employee Image" style="display: none;">
                            <span id="imagePlaceholder">No image selected</span>

                        <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="profile-inputs" type="text" id="name" name="name" value="<?php echo $userData["name"] ?>" disabled required>
                        <!-- <span>John Doe</span> -->
                    </div>
                    <div class="form-group">
                        <label>NIC:</label>
                        <input class="profile-inputs" type="text" id="nic" name="nic" value="<?php echo $userData["id_num"] ?>" disabled required>
                        <!-- <span>123456789V</span> -->
                    </div>
                    <div class="form-group">
                        <label>Email (optional):</label>
                        <input class="profile-inputs" type="email" id="email" name="email" value="<?php echo $userData["email"] ?>" disabled>
                        <!-- <span>john.doe@example.com</span> -->
                    </div>
                    <div class="form-group">
                        <label>Age:</label>
                        <input class="profile-inputs" type="number" id="age" name="age" value="<?php echo $userData["age"] ?>" disabled required>
                        <!-- <span>30</span> -->
                    </div>

                    <div class="form-group">
                        <label>Address:</label>
                        <input class="profile-inputs" type="text" id="address" name="address" value="<?php echo $userData["address"] ?>" disabled required>
                        <!-- <span>123 Main Street</span> -->
                    </div>
                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input class="profile-inputs" type="text" id="contact" name="contact" value="<?php echo $userData["mobile"] ?>" disabled required>
                        <!-- <span>+123456789</span> -->
                    </div>
                </div>
                <div style="display: flex; width: 100%;" class="">
                    <div style="display: flex;  width: 53%;  justify-content: end;" class="">
                        <button class="save-details">Save</button>
                    </div>
                    <input type="hidden" id="Tname" value="<?php echo $Tname ?>" />
                    <!-- <div style=" display: flex;  width: 47%; justify-content: end;" class="">
                    <button id="blockButton" class="blockButton">Block</button>
                </div> -->
                </div>
            </div>
            <!-- <hr> -->



        </div>

        <div class="change-password-container">
            <h3>Change Password</h3>
            <form id="changePasswordForm">
                <div class="form-group">
                    <label for="currentPassword">Current Password:</label>
                    <input type="password" id="currentPassword" name="currentPassword" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmnewPassword">Confirm New Password:</label>
                    <input type="password" id="confirmnewPassword" name="confirmnewPassword" required>

                </div>
                <div class="form-group">
                    <div style="width: 100%;max-width: 500px;text-align: end;" class="">
                        <a href="#">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit">Confirm</button>
            </form>
        </div>

        <!-- Confirmation Popup -->
        <!-- <div id="confirmationPopup" class="popup-container">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('confirmationPopup')">&times;</span>
            <h2>Confirm Change</h2>
            <p>Are you sure you want to change your password?</p>
            <button id="proceedBtn" class="proceed-btn">Proceed</button>
            <button class="cancel-btn" onclick="closePopup('confirmationPopup')">Cancel</button>
        </div>
    </div>

    <div class="block-employee-container">
        <h3>Block/Unblock Employee</h3>
        <button id="blockBtn" class="block-btn">Block</button>
        <button id="unblockBtn" class="unblock-btn" disabled>Unblock</button>
    </div> -->

        <!-- Confirmation Popup -->
        <!-- <div id="confirmationBlockPopup" class="popup-container">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('confirmationPopup')">&times;</span>
            <h2>Confirm Action</h2>
            <p id="confirmationMessage">Are you sure you want to proceed?</p>
            <button id="proceedBtnBlock" class="proceed-btn">Proceed</button>
            <button class="cancel-btn" onclick="closePopup('confirmationPopup')">Cancel</button>
        </div>
    </div> -->

        <script src="assets/js/employee-profile.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body> 


    </html>

<?php
} else {
    // header('Location: index.php');
}

?>