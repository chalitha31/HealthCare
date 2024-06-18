<?php 

require_once "../connection.php";

$pdi = $_GET["pdi"];
$testType = $_GET["testType"];

// echo $pdi . $testType; 

Database::iud("INSERT INTO `bloodtest`(`patientDetails_id`,`test_type`) VALUES('".$pdi."','".$testType."')");
echo "success";