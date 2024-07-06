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
            background-color: #fba353;
        }

        .outofStoc {
            background-color: rgba(221, 154, 54, 0.301);
            border: #e79e4e solid 2px;
           
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="stock-header">Stock Management</h2>
        <input type="text" id="searchBar" placeholder="Search Medicine..." onkeyup="filterTable()">
        <table id="medicineTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Purchase Quantity</th>
                    <th>Purchase Date</th>
                    <th>Avalable Quantity</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody id="stmediTable">
                <?php
                require_once "../connection.php";

                $i = 1;
                $equResultSet = Database::search("SELECT id,name, quantity, purchase_date,avalable_quantity FROM mlt_equipments");
                while ($row = $equResultSet->fetch_assoc()) {

                ?>

                    <tr class="<?php if ($row["avalable_quantity"] == 0) {
                                    echo 'outofStoc';
                                } ?>">
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["name"] ?></td>
                        <td><?php echo $row["quantity"] ?></td>
                        <td><?php echo $row["purchase_date"] ?></td>
                        <td><?php echo $row["avalable_quantity"] ?></td>
                        <td style="color: red; font-weight: 900;text-align: center;"><?php if ($row["avalable_quantity"] == 0) {
                                                                        echo 'Out Of Stock';
                                                                    } ?></td>
                        <td style="text-align: center;"><button onclick="showUpdateModel(<?php echo $row['id'] ?>);" class="status-btn" <?php if ($row["avalable_quantity"] == 0) {
                                                                        echo 'disabled';
                                                                    } ?> >update</button></td>
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
                                <button onclick="updateEquiDetails('<?php echo $row['id'] ?>')" style="background-color: rgb(13, 141, 45);" class="outofstock">Update</button>
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