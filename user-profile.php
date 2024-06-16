<?php
session_start();
require_once "connection.php";

if (isset($_SESSION["fname"])) {

    $resultSet  = Database::search("SELECT * FROM `user`  WHERE `fname` = '" . $_SESSION["fname"] . "' AND `email` = '" . $_SESSION["email"] . "'");
    $numRow = $resultSet->num_rows;
    // echo "<script>console.log('SELECT * FROM  $Tname  WHERE `id_num` = '" . $_SESSION["idnum"] . "' AND `email` = '" . $_SESSION["email"] . "'')</script>";
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

            <style>
                .profile-details .form-group {
                    flex: 1;
                    min-width: 400px;
                    max-width: max-content;
                }
            </style>

        </head>

        <body>



            <header class="header">
                <div class="logo">Healthcare</div>
                <div class="header-username"><?php if (isset($_SESSION["fname"])) {
                                                    echo $_SESSION["fname"];
                                                }
                                                ?></div>
            </header>
            <div class="container">
                <div class="profile-details">
                    <div class="detail-heading">
                        <h2>Your Details</h2>
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>




                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input class="profile-inputs" type="text" id="fname" name="name" value="<?php echo $userData["fname"] ?>" disabled required>
                            <!-- <span>John Doe</span> -->
                        </div>

                        <div class="form-group">
                            <label>Last Name:</label>
                            <input class="profile-inputs" type="text" id="lname" name="age" value="<?php echo $userData["lname"] ?>" disabled required>
                            <!-- <span>30</span> -->
                        </div>

                        <div class="form-group">
                            <label>Email (optional):</label>
                            <input class="profile-inputs" type="email" id="email" name="email" value="<?php echo $userData["email"] ?>" disabled>
                            <!-- <span>john.doe@example.com</span> -->
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
                       
                    </div>
                </div>
                <!-- <hr> -->



            </div>

            <div class="change-password-container">
                <h3>Change Password</h3>
                <div id="changePasswordForm">
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

                    <button onclick="changePassword('user')" type="submit">Confirm</button>
                </div>
            </div>


            <script src="assets/js/user-profile.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </body>


        </html>

<?php
    } else {
        // header('Location: index.php');
        echo "mo row";
    }
} else {
    // header('Location: index.php');
    echo "mo fnmae";
}

?>