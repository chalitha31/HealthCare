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

        #searchBar {
            width: 30%;
            min-width: 200px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid var(--medium-gray);
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        #searchBar:focus {
            border-color: var(--base-color);
        }
    </style>
</head>

<body>
    <div class="medicine-inventory">
        <h2>Medicine Inventory</h2>
        <h3>Add Medicine</h3>
        <form id="medicineForm" class="medicine-form">
            <div class="form-group">
                <label for="medicineName">Name:</label>
                <input type="text" id="medicineName" name="medicineName" required>
            </div>
            <div class="form-group">
                <label for="medicineBrand">Brand:</label>
                <input type="text" id="medicineBrand" name="medicineBrand" required>
            </div>
            <div class="form-group">
                <label for="medicineQuantity">Quantity </label>
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
                <input type="date" id="expirationDate" name="expirationDate" min="<?php echo $date ?>" required>
            </div>
            <button class="medic-add-btn" type="submit">Submit</button>
        </form>

        <h3>Medicine List</h3>
        <input type="text" id="searchBar" placeholder="Search..." onkeyup="filterTable()">
        <table id="medicineTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <!-- <th>Quantity</th> 
                    <th>Expiration Date</th> -->
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>


</body>