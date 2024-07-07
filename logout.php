<?php

session_start();

if (isset($_SESSION["fname"])) {

    $_SESSION["fname"] = null;
    $_SESSION["lname"] = null;
    $_SESSION["email"] = null;

    session_destroy();
   
    header("location: index.php");
    exit();
}
