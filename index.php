<?php
session_start();
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
                    <a href="#">profile</a>
                    <a style="color:  #ec5630;" href="logout.php"><b>logout</b></a>
                </div>
            </div>

        <?php
        } else {
        ?>
            <button id="loginBtn">Login</button>
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
                <div class="register-link">
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
            <h2>What We Do</h2>
            <div class="services">
                <div class="service-card">
                    <img src="assets/images/do-icon(2).png" alt="Cardiology Icon">
                    <h3>Cardiology</h3>
                    <p>We provide comprehensive heart care and prevention services.</p>
                </div>
                <div class="service-card">
                    <img src="assets/images/do-icon(2).png" alt="General Practice Icon">
                    <h3>General Practice</h3>
                    <p>Our general practitioners offer a wide range of primary care services.</p>
                </div>
                <div class="service-card">
                    <img src="assets/images/do-icon(2).png" alt="Neurology Icon">
                    <h3>Neurology</h3>
                    <p>Expert care for conditions affecting the brain and nervous system.</p>
                </div>
                <div class="service-card">
                    <img src="assets/images/do-icon(2).png" alt="Pediatrics Icon">
                    <h3>Pediatrics</h3>
                    <p>Comprehensive healthcare services for infants, children, and adolescents.</p>
                </div>
            </div>
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