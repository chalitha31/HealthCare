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
            margin: 20px 0;
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
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="stock-header">Stock Management</h2>
        <table id="stockTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Medicine Name</th>
                    <th>Current Stock (mg)</th>
                    <th>Weekly Usage</th>
                    <th>Current Stock Availability (days)</th>
                    <th>Current Stock to expire (days)</th>
                    <th>Estimate Stock for 6 months (mg)</th>
                </tr>
            </thead>
            <tbody>

                <?php
                require_once "../connection.php";


                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                // $date = $d->format('Y-m-d H:i:s');
                $date = $d->format('Y-m-d');

                $d->modify('-7 days');
                $date7daysAgo = $d->format('Y-m-d');

                $mediResultSet = Database::search("SELECT * FROM `medicines` WHERE `exp`  > '" . $date . "' AND `quantity` > '0'");



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


                        $mediRecResultSet = Database::search("SELECT * FROM `medicines_recode` WHERE `date`  >= '" . $date7daysAgo . "' AND `medicine_id` = '" . $medicines["id"] . "'");

                        $recNum = $mediRecResultSet->num_rows;
                        $weeklyUsage = 0;

                        if ($recNum > 0) {
                            $recMediData = $mediRecResultSet->fetch_all(MYSQLI_ASSOC);

                            foreach ($recMediData as $recmedicine) {
                                // $recMediData = $mediRecResultSet->fetch_assoc();
                                $qtyCount = $recmedicine["qty"];
                                $weeklyUsage += $qtyCount;

                                // if($recNum == 0){

                                // }else if($recNum == 1){

                                // }else if($recNum == 2){

                                // }else if($recNum == 3){

                                // }else if($recNum == 4){

                                // }else if($recNum == 5){

                                // }else if($recNum == 6){

                                // }else{

                                // }
                            }
                        }

                ?>

                        <tr class="data-row">
                            <td><?php echo $i ?></td>
                            <td><?php echo $medicines["name"] ?></td>
                            <td><?php echo $medicines["quantity"] ?></td>
                            <td><?php echo $weeklyUsage ?></td>
                            <td></td>
                            <td><?php echo $abs_diff ?></td>
                            <td></td>
                          

                        </tr>


                <?php
                    }
                }

                ?>

             
            </tbody>
        </table>
    </div>
</body>