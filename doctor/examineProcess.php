<?php

require_once "../connection.php";

$pdi = $_GET["pdi"];

    $result = Database::search("SELECT * FROM  `patients_details` WHERE `id` = '" . $pdi . "' AND `Prescriptions` = '' ");
    $pnumRow = $result->num_rows;

         if ($pnumRow > 0) {

            echo "Please submit prescription!";
        }else {

            echo "success";
        }