<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Website</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../reception/reception.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <header>
        <div class="logo">Healthcare</div>
        <div class="header-username">UserName</div>
        <!-- <button id="loginBtn">Login</button> -->
    </header>
    <div class="main-container">
        <aside class="sidebar">
            <ul>
                <li><a href="#" class="tab" data-target="registration.php">Patient Registration</a></li>
                <li><a href="#" class="tab" data-target="patients.php">Patients</a></li>
                <li><a href="#" class="tab">DNDs</a></li>
                <li><a href="#" class="tab">CDs</a></li>
                <li><a href="#" class="tab">Articles</a></li>
                <li><a href="#" class="tab">Messages</a></li>
            </ul>
        </aside>
        <div class="content" id="content">
            <div class="content-backdrop">
                <h1 class="backdrop-heading">Reception Section</h1>
                <p class="backdrop-phrase">Facilitating seamless interactions with medical staff, our team ensures a welcoming and hassle-free experience for all visitors.</p>
                <img src="../assets/images/reseptionist.png" alt="reception-png" class="bacdrop-patch">
            </div>
        </div>
    </div>
    <script src="reception.js"></script>
    <script src=""></script>
</body>

</html>