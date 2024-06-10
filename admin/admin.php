<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Website</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../admin/admin.css">
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
                <li><a href="#" class="tab" data-target="dashboard.php">Dashboard</a></li>
                <li><a href="#" class="tab" data-target="doctor.php">Doctors</a></li>
                <li><a href="#" class="tab" data-target="pharmacist.php">Pharmacists</a></li>
                <li><a href="#" class="tab" data-target="mlt.php">MLTs</a></li>
                <li><a href="#" class="tab" data-target="reception.php">Reception</a></li>
            </ul>
        </aside>
        <div class="content" id="content">
        </div>
    </div>
    <script src="admin.js"></script>
    <script src=""></script>
</body>

</html>