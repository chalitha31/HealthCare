<?php 

session_start();

// $Tname = $_GET["name"];


if(isset($_SESSION["name"])){

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Website</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../pharmasist/pharmasist.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <header>
        <div class="logo">Healthcare</div>
        <div class="header-time">
            <span id="liveTime"></span>
        </div>
        <div class="header-username"><?php echo $_SESSION["name"] ?></div>
        <!-- <button id="loginBtn">Login</button> -->
    </header>
    <div class="main-container">
        <aside class="sidebar">
            <ul>            
                <li><a href="#" class="tab" data-target="produce-list.php">produce medicine</a></li>
                <li><a href="#" class="tab" data-target="inventory.php">Inventory Management</a></li>
                <li><a href="#" class="tab" data-target="stock-manage.php">Stock Management</a></li>
                <li><a href="#" class="tab" data-target="outofstock.php">Out of Stock</a></li>
                <li><a href="#" class="tab" data-target="expireStock.php">Expire Stock</a></li>
                <li><a href="../employee-profile.php?name=registered_pharmacists" class="tabb">View Profile</a></li>
                <li><a href="../logoutEmployee.php" class="tabb" data-target="patients.php">Log Out</a></li>
            </ul>
        </aside>
        <div class="content" id="content">
            <div class="content-backdrop">
                <h1 class="backdrop-heading">Pharmasist Section</h1>
                <p class="backdrop-phrase">Facilitating seamless interactions with medical staff, our team ensures a
                    welcoming and hassle-free experience for all visitors.</p>
                <img src="../assets/images/phar2.png" alt="reception-png" class="bacdrop-patch">
            </div>
        </div>
    </div>
    <script src="pharmasist.js"></script>
    <script src="../assets/js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php 
}else{

header("Location: ../employee-profile.php?name=registered_pharmacists");

}

?>