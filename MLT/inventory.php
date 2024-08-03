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
            /* flex-wrap: wrap; */
            position: relative;
            gap: 20px;
            margin-bottom: 50px;
            padding-bottom: 50px;
        }

        .form-group {
            /* flex: 1; */
            min-width: 300px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--dark-gray);
        }

        .form-group input {
            width: 100%;
            max-width: 500px;
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

        .table-container {
            max-height: 400px;
            /* Sets the fixed height for the table */
            overflow-y: auto;
            /* Enables vertical scrolling */
            border: 1px solid #ddd;
            /* Adds a border around the table container */
        }

        table {
            /* display: block;
            width: 100%;
            max-width: 100%;
            min-width: max-content;
            border-collapse: collapse;
        max-height: 400px;
        overflow-y: auto; */

            width: 100%;
            /* Ensures the table takes up the full width of its container */
            border-collapse: collapse;
        }





        th,
        td {
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            text-align: left;
        }

        thead {
            position: sticky;
            /* Makes the header sticky for better visibility while scrolling */
            top: 0;
            /* Ensures the header stays at the top */
            background-color: #f9f9f9;
            /* Adds background color to the header for better distinction */
            z-index: 1;
        }

        thead th {

            background-color: var(--base-color);
            color: #FFFFFF;
        }

        tbody tr:hover {
            background-color: var(--medium-gray);
            color: white;
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
    </style>
</head>

<body>
    <div class="medicine-inventory">
        <h2>MLT Inventory</h2>
        <h3>Add Equipment</h3>
        <form id="medicineForm" class="medicine-form">
            <div class="form-group">
                <label for="medicineName">Name:</label>
                <input type="text" id="medicineName" name="medicineName" required>
            </div>
            <!-- <div class="form-group">
                <label for="medicineBrand">Brand:</label>
                <input type="text" id="medicineBrand" name="medicineBrand" required>
            </div> -->
            <div class="form-group">
                <label for="medicineQuantity">Quantity:</label>
                <input type="number" id="medicineQuantity" name="medicineQuantity" required>
            </div>

            <?php
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            // $date = $d->format('Y-m-d H:i:s');
            $date = $d->format('Y-m-d');
            ?>
            <div class="form-group">
                <label for="expirationDate">Expiration Date:</label>
                <input type="date" id="expirationDate" name="expirationDate" min="<?php echo $date ?>" >
            </div>

            <button class="medic-add-btn" type="submit">Submit</button>
        </form>

        <h3>Equipment List</h3>
        <input type="text" id="searchBar" placeholder="Search..." onkeyup="filterTableinventory()">
        <select id="statusFilter" onchange="filterTableinventory()">
            <option value="all">All</option>
            <!-- <option value="1">In Stock</option> -->
            <option value="0">Out of Stock</option>
            <option value="expired">Expired</option>
        </select>
        <div class="table-container">
            <table id="medicineTable">
                <thead>
                    <tr>
                    <th>Item No</th>
                        <th>Name</th>
                        <!-- <th>Brand</th> -->
                        <!-- <th>Purchase Quantity</th> -->
                        <th>Avaliable Quantity</th>
                        <th>Expire_date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Paracetamol</td>
                        <!-- <td>ABC Pharma</td> -->
                        <td>500</td>
                        <!-- <td>2024-12-01</td> -->
                    </tr>
                    <tr>
                        <td>Ibuprofen</td>
                        <!-- <td>XYZ Pharma</td> -->
                        <td>200</td>
                        <!-- <td>2025-06-15</td> -->
                    </tr>
                    <tr>
                        <td>Amoxicillin</td>
                        <!-- <td>HealthCare Inc.</td> -->
                        <td>250</td>
                        <!-- <td>2023-09-30</td> -->
                    </tr>
                    <tr>
                        <td>Aspirin</td>
                        <!-- <td>MediCare Ltd.</td> -->
                        <td>100</td>
                        <!-- <td>2024-03-22</td> -->
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


</body>