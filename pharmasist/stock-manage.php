<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
        }

        .stock-header {
            margin-top: 50px;
        }

        table {
            width: 100%;
            /* margin: 20px 0; */
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: var(--base-color);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        } .print{
            width: 100%;
            text-align: end;
            padding-bottom: 10px;
        }
        .print button {
            background-color: #008040;
            padding: 8px;
            width:80px;
            border-radius: 10px;
            font-size: large;
            font-weight: 800;
            border: none;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="stock-header">Stock Management</h2>
        <div class="print"><button onclick="downloadStockTableAsExcel()">Print</button></div>
        <table id="stockTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Medicine Name</th> 
                    <th>purchase Date</th>
                    <th>purchase Quantity</th>
                    <th>Issued Quantity</th>
                    <th>Available Quantity</th>

                    <th>Daily Usage Rate</th>
                    <!-- <th>Weekly Usage (Quantity)</th> -->
                    <!-- <th>Stock Depletion Timeline</th> -->
                    <th>Available Stock Depletion Timeline</th>
                    <!-- <th>Remaining Quantity Valid Days</th> -->
                    <!-- <th>Current Stock to expire (days)</th> -->
                    <th>Expiration Date</th>
                    <th>Estimate Stock for 6 months (Quantity)</th>
                </tr>
            </thead>
            <tbody id="tbod">

                <?php
                require_once "../connection.php";


                $d = new DateTime();
                $d14 = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $d14->setTimezone($tz);
                // $date = $d->format('Y-m-d H:i:s');
                $date = $d->format('Y-m-d');

                $d->modify('-7 days');
                $date7daysAgo = $d->format('Y-m-d');

                $d14->modify('14 days');
                $date14days = $d14->format('Y-m-d');

                $mediResultSet = Database::search("SELECT * FROM `medicines` WHERE `exp`  > '" . $date14days . "' AND `quantity` > '0'");



                // $mediResultSet = Database::search("SELECT `medicines`.`quantity` AS `currQty`,`medicines`.`exp` AS `exp`,`medicines`.`brand` AS `brand`,`medicines`.`name` AS `mediName`,`medicines_recode`.`qty` AS `recQty`,`medicines_recode`.`date`  AS `reqDate`
                // FROM `medicines` FULL OUTER JOIN `medicines_recode` ON `medicines_recode`.`medicine_id` = `medicines`.`id`
                // WHERE `medicines`.`exp`  > '" . $date . "' AND `medicines`.`quantity` > '0'");


                if ($mediResultSet->num_rows > 0) {
                    // Fetch all results as an associative array



                    for ($i = 1; $i <= $mediResultSet->num_rows; $i++) {
                        $medicines = $mediResultSet->fetch_assoc();


                        $exdate = $medicines['exp'];

                        $earlier = new DateTime($date);
                        $later = new DateTime($exdate);

                        $abs_diff = $later->diff($earlier)->format("%a");


                        $issue_quentitiy = 0;
                        $isMediRecResultSet = Database::search("SELECT * FROM `medicines_recode` WHERE `date`  >= '" .  $medicines["purchase_date"] . "' AND `medicine_id` = '" . $medicines["id"] . "'");
                        $isrecNum = $isMediRecResultSet->num_rows;
                        if ($isrecNum > 0) {
                            $isRecMediData = $isMediRecResultSet->fetch_all(MYSQLI_ASSOC);



                            foreach ($isRecMediData as $isrecmedicine) {

                                $issue_quentitiy +=  $isrecmedicine["qty"];
                            }
                        }


                        $mediRecResultSet = Database::search("SELECT * FROM `medicines_recode` WHERE `date`  >= '" . $date7daysAgo . "' AND `medicine_id` = '" . $medicines["id"] . "'");
                        // $medicines["purchase_date"]

                        $recNum = $mediRecResultSet->num_rows;
                        $weeklyUsage = 0;
                        // $first_issue_date = $date;

                        // $total_usage =0;



                        if ($recNum > 0) {
                            $recMediData = $mediRecResultSet->fetch_all(MYSQLI_ASSOC);

                            // $total_issued_last_7_days = 0;

                            foreach ($recMediData as $recmedicine) {
                                // $recMediData = $mediRecResultSet->fetch_assoc();
                                $weeklyUsage +=  $recmedicine["qty"];

                                //         if($recNum < 7){

                                //             $days_elapsed = (strtotime($date) - strtotime($first_issue_date)) / (60 * 60 * 24);

                                //   }else{
                                //     $qtyCount = $recmedicine["qty"];
                                //     $weeklyUsage += $qtyCount;
                                //   }




                            }

                            // if( $total_issued_last_7_days < 7){


                            // }




                        }


                ?>

                        <tr class="data-row">
                            <td><?php echo $i ?></td>   <!--medicine no -->
                            <td><?php echo $medicines["name"] ?></td>   <!--medicine name -->
                            <td><?php echo $medicines["purchase_date"] ?></td>  <!--purchase date -->
                            <td><?php echo ($medicines["quantity"] + $issue_quentitiy) ?></td>  <!--purchase quantity -->
                            <td><?php echo $issue_quentitiy ?></td>  <!--issue quantity -->
                            <td><?php echo $medicines["quantity"] ?></td>  <!-- available quantity-->
                            <td></td>  <!--daily usuage rate-->
                            <td></td>  <!--availble stock depletion time line -->
                            <td><?php echo $exdate ?></td>  <!--expire date-->
                            <td></td>  <!--esitimate 6 moths stock-->


                        </tr>


                <?php
                    }
                }

                ?>


            </tbody>
        </table>
    </div>
</body>