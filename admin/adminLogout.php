<?php

session_start();

if (isset($_SESSION["name"])) {

    $_SESSION["name"] = null;
    $_SESSION["mobile"] = null;
    $_SESSION["email"] = null;

    session_destroy();

    header("location: http://localhost/HealthCare/index.php");
    exit();
}
