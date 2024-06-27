<?php
session_start();
 
// if(isset($_SESSION["fname"])){

//     $Tname = $_GET["name"];
// }
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Website</title>
    <link rel="stylesheet" href="assets/css/common.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/header.css">
</head>

<body>
    <header>
        <div class="logo">Healthcare</div>
        <?php
        if (isset($_SESSION["fname"])) {
        ?>

            <!-- echo $_SESSION["fname"]; -->

            <div class="dropdown">
                <button class="dropbtn">Hi, <?php echo $_SESSION["fname"]; ?></button>
                <div class="dropdown-content">
                    <a href="user-profile.php">profile</a>
                    <a style="color:  #ec5630;" href="logout.php"><b>logout</b></a>
                </div>
            </div>

        <?php
        } else {
        ?>
            <button onclick="loginbutton();" id="loginBtn">Login</button>
        <?php
        }

        ?>
        <!-- <button id="loginBtn">Login</button> -->
        <!-- <button id="logoutBtn">Logout</button>       -->



    </header>

    <div id="loginForm" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Login</h2>
            <div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="submit-btn" onclick="login()">Login</button>
                <div style="visibility: hidden; pointer-events: none;" class="register-link">
                    <p>Don't have an account? <a href="signup.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>


    <main>
        <div class="intro">
            <div class="intro-content">
                <h1>Healthcare</h1>
                <p>Your health is our top priority. Explore our services and connect with top professionals.</p>
            </div>
            <img src="assets/images/background.png" alt="Healthcare Image" class="intro-image">
        </div>


        <div class="what-we-do">
            <h1>- What We Do -</h1>
            <div class="cards-container">
                <div class="card">
                    <div class="img-cont">
                        <img src="assets/images/reseptionist.png" alt="doctor-image">
                    </div>
                    <div class="description">
                        <h2>Welcoming Reception</h2>
                        <p>Our friendly and efficient reception team is here to provide you with a warm welcome and assist you with all your needs. We ensure a seamless check-in and check-out process, making your visit as pleasant as possible.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="img-cont">
                        <img src="assets/images/doctors-patch.png" alt="doctor-image">
                    </div>
                    <div class="description">
                        <h2>Expert Doctors</h2>
                        <p>Our highly qualified and experienced doctors are dedicated to providing top-notch medical care. From routine check-ups to specialized treatments, we are here to ensure your health and well-being.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="img-cont">
                        <img src="assets/images/phar2.png" alt="doctor-image">
                    </div>
                    <div class="description">
                        <h2>Comprehensive Pharmacy</h2>
                        <p>Our in-house pharmacy is stocked with a wide range of medications and health products. Our pharmacists are available to provide you with expert advice and ensure you get the right prescriptions and guidance.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="img-cont">
                        <img src="assets/images/mlt.png" alt="doctor-image">
                    </div>
                    <div class="description">
                        <h2>Advanced Laboratory Services</h2>
                        <p>Our state-of-the-art Medical Laboratory Technologist (MLT) facilities offer accurate and timely diagnostic services. We provide a comprehensive range of tests to assist in the effective diagnosis and management of your health.</p>
                    </div>
                </div>
            </div>
        </div>iv>
        </div>


        <section class="popular-doctors">
            <h2>Leading Doctors</h2>
            <div class="doctor-card">
                <img src="assets/images/Doctors/doc (1).png" alt="Doctor Image">
                <h3>Dr. John Doe</h3>
                <p>Cardiologist</p>
            </div>
            <div class="doctor-card">
                <img src="assets/images/Doctors/doc (2).png" alt="Doctor Image">
                <h3>Dr. Jane Smith</h3>
                <p>Dermatologist</p>
            </div>
            <div class="doctor-card">
                <img src="assets/images/Doctors/doc (3).png" alt="Doctor Image">
                <h3>Dr. Mark Johnson</h3>
                <p>Neurologist</p>
            </div>
            <div class="doctor-card">
                <img src="assets/images/Doctors/doc (4).png" alt="Doctor Image">
                <h3>Dr. Emily Davis</h3>
                <p>Pediatrician</p>
            </div>
        </section>

        <div class="about-section">
            <h2>About Us</h2>
            <p>Welcome to our healthcare website. Our mission is to provide comprehensive healthcare services with a focus on quality and patient satisfaction. We have a team of dedicated professionals who are here to meet your medical needs and ensure you receive the best care possible.</p>
            <p>Our services include general health consultations, specialist referrals, laboratory tests, and more. We are committed to maintaining a high standard of care and staying up-to-date with the latest advancements in medical science.</p>
            <p>Thank you for choosing our healthcare services. We look forward to serving you and your family.</p>
        </div>

    </main>

    <footer>
        <p>&copy; 2024 Healthcare. All rights reserved.</p>
      
    </footer>

    <script src="assets/js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>