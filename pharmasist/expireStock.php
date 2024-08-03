<head>
    <style>
        .medicine-inventory {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }

        .medicine-inventory h2,
        .medicine-inventory h3 {
            color: var(--base-color);
            margin-bottom: 20px;
        }

        .medicine-inventory h2 {
            margin-bottom: 30px;
        }

        .medicine-form {
            display: flex;
            flex-wrap: wrap;
            position: relative;
            gap: 20px;
            margin-bottom: 50px;
            padding-bottom: 50px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--dark-gray);
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--medium-gray);
            border-radius: 5px;
            font-size: 1em;
            color: var(--dark-gray);
            background-color: #FFFFFF;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: var(--base-color);
            outline: none;
        }

        button[type="submit"] {
            position: absolute;
            bottom: 0%;
            padding: 10px 15px;
            background-color: var(--base-color);
            border: none;
            border-radius: 5px;
            color: #FFFFFF;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: var(--second-base-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            text-align: left;
        }

        thead th {
            background-color: var(--base-color);
            color: #FFFFFF;
        }

        tbody tr:hover {
            background-color: var(--medium-gray);
            color: white;
        }
    </style>
</head>

<body>
    <div class="medicine-inventory">


        <h3>Expire Medicine List</h3>
        <strong style="color: red;">(Special attention : </strong><span>Medicine with 14 days to expiry is considered expired item.)</span>
        <table id="medicineTable">
            <thead>
                <tr>
                    <th>Medicine Name</th>
                    <th>Medicine Brand</th>
                    <th>purchase Date</th>
                    <th>purchase Quantity</th>
                    <th>Expire Quantity</th>
                    <th>Expiration Date</th>
                    <!-- <th>Estimate Stock for 6 months (Quantity)</th>  -->
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

                $d->modify('14 days');
                $date14days = $d->format('Y-m-d');

                // $mediResultSet = Database::search("SELECT * FROM `medicines` WHERE `exp`  > '" . $date . "' AND `quantity` > '0'");
                $mediResultSet = Database::search("SELECT * FROM `medicines` WHERE `exp` <= '" . $date14days . "' ");

                if ($mediResultSet->num_rows > 0) {
                    // Fetch all results as an associative array
                    $medicines = $mediResultSet->fetch_all(MYSQLI_ASSOC);

                    foreach ($medicines as $medicine) {

                        $mediRecResultSet = Database::search("SELECT * FROM `medicines_recode` WHERE  `medicine_id` = '" . $medicine["id"] . "'");

                        $recNum = $mediRecResultSet->num_rows;
                        $Usage = 0;

                        // estimate 6 month

                        $pDate = $medicine['purchase_date'];
                        $expDate = $medicine['exp'];

                        $pd1 = new DateTime($pDate);
                        $ed1 = new DateTime($expDate);

                        // Calculate the difference
                        $daysDifference = $pd1->diff($ed1);

                        // 14 days expire
                        $totalDays = (($daysDifference->days) - 14);
                        // $sixMonthEstimate = "-";
                        // estimate 6 month

                        if ($recNum > 0) {
                            $recMediData = $mediRecResultSet->fetch_all(MYSQLI_ASSOC);

                            foreach ($recMediData as $recmedicine) {
                                // $recMediData = $mediRecResultSet->fetch_assoc();
                                $qtyCount = $recmedicine["qty"];
                                $Usage += $qtyCount;
                            }

                            // $sixMonthEstimate =(int) (($Usage / $totalDays) * 184);
                        }

                ?>
                        <tr class="dataRow">
                            <td class="name"><?php echo $medicine['name'] ?></td>
                            <td class="brand"><?php echo $medicine['brand'] ?></td>
                            <td><?php echo $medicine["purchase_date"] ?></td>
                            <td class="quantity"><?php echo ($Usage + $medicine['quantity']) ?></td>
                            <td class="quantity"><?php echo $medicine['quantity'] ?></td>
                            <td class="exp"><?php echo $medicine['exp'] ?></td>
                        
                        </tr>

                <?php
                    }
                }
                ?>


            </tbody>

        </table>
    </div>


</body>