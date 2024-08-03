<?php 

session_start();

$Tname = $_GET["name"];


if(isset($_SESSION["name"])){

?>

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
        <div class="header-username"><?php echo $_SESSION["name"] ?></div>
        <!-- <button id="loginBtn">Login</button> -->
    </header>
    <div class="main-container">
        <aside class="sidebar">
            <ul>
                <li><a href="#" class="tab" data-target="registration.php">Patient Registration</a></li>
                <li><a href="#" class="tab" data-target="patients.php">Patients Details</a></li>
                <li><a href="../employee-profile.php?name=<?php echo $Tname ?>" class="tabb">View Profile</a></li>
                <li ><a style="background-color: #ff4848;" href="../logoutEmployee.php" class="tabb">Log Out</a></li>
                <li><a href="#" class="tab" data-target="home-tab.php" style="visibility: hidden; pointer-events:none;">Home</a></li>
            </ul>
        </aside>
        <div class="content" id="content">

        </div>
    </div>
    <script src="reception.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php 

}else{

    header("Location: ../employee-profile.php?name=".$Tname);

}

?>