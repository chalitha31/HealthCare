<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }


        .stock-header {
            margin-top: 50px;
            margin-bottom: 10px;
            color: var(--base-color);
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

        /* tr:nth-child(even) {
            background-color: #f2f2f2;
        } */

        #searchBar {
            width: 50%;
            /* margin-top: 50px; */
            min-width: 200px;
            padding: 10px;
            /* margin-bottom: 20px; */
            border: 1px solid var(--medium-gray);
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        #searchBar:focus {
            border-color: var(--base-color);
        }


        #stmediTable tr:hover {
            background-color: var(--medium-gray);
            color: white;

        }

        /* update model */

        /* The Modal (background) */

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1000;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            border-radius: 10px;
            padding-bottom: 30px;
        }

        /* The Close Button */

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modelHead {
            text-align: center;
            color: rgb(56, 170, 132);
            margin-bottom: 50px;
        }

        .eqipmentDetails {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .outofstock {
            background-color: rgb(204, 72, 11);
            color: white;
            padding: 9px;
            border-radius: 2px;
            border: none;
            margin-left: 17px;
            cursor: pointer;
            /* padding: 10px; */
        }

        .updateQuantitiy {
            /* margin-left: 20px;
            margin-top: 20px; */
            margin: 20px 0 10px 20px;
        }

        .updateQuantitiy input {
            width: 30%;
            height: 30px;
            /* margin-left: 50px; */
            margin-right: 17px;
            padding: 10px;
        }

        .updateQuantitiy strong {
            margin-left: 50px;
        }

        /* update model */

        .status-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 0.9em;
            cursor: pointer;
            background-color: #0BB81A;
        }

        .expire,
        .outofStoc {
            background-color: rgba(236, 224, 74, 0.301);
            border: #e79e4e solid 2px;
            cursor: not-allowed;
        }

        .expire {
            background-color: rgba(242, 35, 35, 0.301);
        }

        select {
            width: 150px;
            font-size: 18px;
            font-weight: 700;
            height: 40px;
            margin-left: 10px;
            /* padding: 10px; */
            padding-left: 10px;
            border-radius: 5px;
            border: 1px solid var(--medium-gray);

        }
        .print{
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
        <input type="text" id="searchBar" placeholder="Search items..." onkeyup="filterTable()">
        <select id="statusFilter" onchange="filterTable()">
            <option value="all">All</option>
            <!-- <option value="1">In Stock</option> -->
            <option value="0">Out of Stock</option>
            <option value="expired">Expired</option>
        </select>
        <div class="print"><button onclick="downloadStockTableAsExcel()">Print</button></div>
        <table id="medicineTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Purchase Date</th>
                    <th>Purchase Quantity</th>
                    <th>Avalable Quantity</th>
                    <th>Expire Date</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody id="stmediTable">
                <?php
                require_once "../connection.php";


                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                // $date = $d->format('Y-m-d H:i:s');
                $date = $d->format('Y-m-d');


                $i = 1;
                $equResultSet = Database::search("SELECT id,name, quantity, purchase_date,avalable_quantity,expire_date FROM mlt_equipments WHERE `view` = '1' ");
                while ($row = $equResultSet->fetch_assoc()) {

                ?>

                    <tr class="<?php if (($row["avalable_quantity"] == 0 && $row["expire_date"] > $date) || ($row["avalable_quantity"] == 0 && $row["expire_date"] == null)) {
                                    echo 'outofStoc';
                                } else if ($row["expire_date"] <= $date && $row["expire_date"] != null) {
                                    echo 'expire';
                                } ?>">
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["name"] ?></td>
                        <td><?php echo $row["purchase_date"] ?></td>
                        <td><?php echo $row["quantity"] ?></td>
                        <td><?php echo $row["avalable_quantity"] ?></td>
                        <td><?php if ($row["expire_date"] == "" || $row["expire_date"] == null) {
                                echo "no";
                            } else {
                                echo $row["expire_date"];
                            } ?></td>
                        <td style="color: red; font-weight: 900;text-align: center;"><?php if (($row["avalable_quantity"] == 0 && $row["expire_date"] > $date) || ($row["avalable_quantity"] == 0 && $row["expire_date"] == null)) {
                                                                                            echo 'Out Of Stock';
                                                                                        } else if ($row["expire_date"] <= $date && $row["expire_date"] != null) {
                                                                                            echo 'Expired';
                                                                                        } else{
                                                                                            echo '<span style="color: Black;">-</span>';
                                                                                        }?></td>


                        <?php
                        if ($row["avalable_quantity"] == 0 ||  ($row["expire_date"] <= $date && $row["expire_date"] != null)) {
                        ?>
                            <td style="text-align: center;"><button style="background-color: #AF310D ; color: #ddd;" onclick="updateEquiDetails('<?php echo $row['id'] ?>','remove');" class="status-btn ">Remove</button></td>
                        <?php
                        } else  {
                        ?>
                            <td style="text-align: center;"><button onclick="showUpdateModel('<?php echo $row['id'] ?>');" class="status-btn ">update</button></td>

                        <?php
                        }
                        ?>
                    </tr>
 

                    <!-- The Modal -->
                    <div id="myModal-<?php echo $row['id'] ?>" class="modal">

                        <div class="modal-content">
                            <span onclick="closeModel(<?php echo $row['id'] ?>)" class="close">&times;</span>
                            <h2 class="modelHead">Update equipments Details</h2>
                            <div class="eqipmentDetails">
                                <div style="max-width: 340px; " class="">
                                    <strong class="">Name : </strong>
                                    <span id="eqName" style="word-wrap:break-word;" class=""><?php echo $row["name"] ?></span>
                                </div>
                                <div class="">
                                    <strong class="">Purchase Quantitiy : </strong>
                                    <span id="eqPqty" class=""><?php echo $row["quantity"] ?> </span>
                                </div>
                                <div class="">
                                    <strong class="">Avalabile Quantitiy : </strong>
                                    <span id="eqAqty" class=""><?php echo $row["avalable_quantity"] ?> </span>
                                </div>

                            </div>

                            <br />
                            <hr>

                            <div class="updateQuantitiy">
                                <h3>Update Quantitiy : </h3>
                                <br />
                                <strong>Today used quantity : </strong>
                                <input type="number" min="0" id="editQty-<?php echo $row['id'] ?>" />
                                <button onclick="updateEquiDetails('<?php echo $row['id'] ?>','update')" style="background-color: rgb(13, 141, 45);" class="outofstock">Update</button>
                                <!-- <button onclick="updateEquiDetails('<?php echo $row['id'] ?>')" class="outofstock">Out Of Stock</button> -->
                            </div>

                        </div>

                    </div>
                    <!-- The Modal -->

                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</body>