<?php
session_start();

require_once "../connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Website</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../pharmasist/pharmasist.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<style>
    .main-container {
        background-color: #fff;
        /* padding: 20px; */
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .health-issues {
        margin-bottom: 20px;
        border: 1px solid var(--medium-gray);
        min-width: max-content;
        max-width: 30%;
        margin-left: 20px;
        height: 400px;
        padding: 10px;
        border-radius: 10px;
    }


    h3 {
        color: var(--base-color);
        margin-bottom: 10px;
    }

    .health-issues p {
        margin: 5px 0;
        white-space: pre-wrap;
        color: var(--dark-gray);
    }

    .health-issues textarea {
        /* margin: 10px 0; */
        /* width: 500px; */
        border: none;
        background: none;
        /* height: 350px; */
        font-size: 18px;
        white-space: pre-wrap;
        /* white-space: pre-wrap; */
        color: var(--dark-gray);
    }

    #searchBar {
        width: 50%;
        /* margin-top: 50px; */
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

    #dataTable {
        width: 100%;
        margin-bottom: 50px;
    }


    #selectedTable {
        margin-bottom: 30px;
    }

    #selectedTable input {
        padding: 8px 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    #dataTable thead {
        display: table;
        width: calc(100% - 1em);
        /* Adjust the width to account for scroll bar */
    }

    #dataTable thead tr {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
    }

    #selectedTable thead tr {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
    }

    tbody {
        display: block;
        max-height: 300px;
        /* Set the desired height for the scrollable area */
        overflow-y: auto;
        /* Enable vertical scrolling */
    }

    th,
    td {
        padding: 12px 15px;
        border: 1px solid var(--medium-gray);
        border: none;
        text-align: left;
    }

    th {
        background-color: var(--base-color);
        color: white;
    }

    tbody tr {
        cursor: pointer;
        display: table;
        width: 100%;
        table-layout: fixed;
    }


    tbody tr:nth-child(even) {
        background-color: #e6e6e6;
    }

    tbody tr:hover {
        background-color: var(--medium-gray);
        color: white;
    }


    #produceButton {
        /* position: absolute; */
        /* left: 0%; */
        padding: 10px 15px;
        background-color: var(--base-color);
        border: none;
        border-radius: 5px;
        color: #FFFFFF;
        font-size: 1em;
        cursor: pointer;
        display: none;
        transition: background-color 0.3s;
    }

    #produceButton:hover {
        background-color: var(--second-base-color);
    }

    .tab:nth-child(2) {
        background-color: var(--base-color);
    }

    .remove-btn {
        padding: 10px 15px;
        background-color: var(--base-color);
        border: none;
        border-radius: 5px;
        color: #FFFFFF;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .remove-btn:hover {
        background-color: var(--error-color);
    }

    .maindiv {
        display: flex;
        flex-direction: row;
        margin-bottom: 15px;

    }


    .left,
    .right {
        flex: 1;
        padding: 20px;
        box-sizing: border-box;
        overflow-x: auto;
        /* Scroll if content overflows */
    }

    .left {
        background-color: #f0f0f0;
    }

    .right {
        flex: 2;
        /* background-color: #d0d0d0; */
    }

    .left .content-title {
        margin: 0 0 20px 0;
    }

    /* Media query for screens smaller than 768px */
    @media (max-width: 1730px) {
        .maindiv {
            flex-direction: column;
            height: auto;
            /* Adjust height for stacking */
        }

        .left,
        .right {
            height: 50vh;
            /* Adjust height for stacking */
        }
    }

    .no-med-needed {
        padding: 10px 15px;
        background-color: var(--error-color);
        border: none;
        border-radius: 5px;
        color: #FFFFFF;
        font-size: 1em;
        cursor: pointer;
        margin-bottom: 50px;
        margin-left: auto;
        transition: background-color 0.3s;
    }

    .no-med-needed:hover {
        background-color: var(--error-color);
    }
</style>



<body>
    <?php


    $pdi = $_GET["pid"];

    $res = Database::search("SELECT * FROM `patients_details` INNER JOIN `registered_patients` ON `registered_patients`.`p_id` =`patients_details`.`patients_id` WHERE `id` = '$pdi'");
    $pdata = $res->fetch_assoc();

    ?>
    <header>
        <div class="logo">Healthcare</div>
        <div class="header-username"><?php if (isset($_SESSION["name"])) {
                                            echo $_SESSION["name"];
                                        } ?></div>
        <!-- <button id="loginBtn">Login</button> -->
    </header>
    <div class="main-container">
        <div class="content" id="content">
            <!-- style="display: flex;height: 500px; margin: 20px;" -->
            <div class="maindiv">

                <div class="left ">
                    <h2 class="content-title">Issue medicine</h2>
                    <div class="health-issues">
                        <h3><?php echo $pdata["name"] ?> Prescription</h3>
                        <!-- <p>Paracetamol 30</p>
                        <p>Ibuprofen 30</p>
                        <p>Amoxicillin 20</p>
                        <p>Aspirin 40</p> -->
                        <p style="white-space:pre-wrap;"><?php echo $pdata["Prescriptions"] ?></p>

                    </div>

                </div>

                <div class="right ">
                    <h2 class="content-title">Available medicines</h2>
                    <input type="text" id="searchBar" placeholder="Search Medicine..." onkeyup="filterTable()">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th>Expiration Date</th>
                            </tr>
                        </thead>
                        <tbody class="dataBody">
                            <?php

                            $d = new DateTime();
                            $tz = new DateTimeZone("Asia/Colombo");
                            $d->setTimezone($tz);
                            // $date = $d->format('Y-m-d H:i:s');
                            $date = $d->format('Y-m-d');

                            $mediResultSet = Database::search("SELECT * FROM `medicines` WHERE `exp`  > '" . $date . "' AND `quantity` > '0'");
                            if ($mediResultSet->num_rows > 0) {
                                // Fetch all results as an associative array
                                $medicines = $mediResultSet->fetch_all(MYSQLI_ASSOC);

                                foreach ($medicines as $medicine) {
                            ?>
                                    <tr class="dataRow" onclick="addToNewTable(this)">
                                        <td class="name"><?php echo $medicine['name'] ?></td>
                                        <td class="brand"><?php echo $medicine['brand'] ?></td>
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

            </div>
            <button onclick="cancelMedicine(<?php echo $pdi ?>)" class="no-med-needed">No medication needed</button>
            <h3>Selected Medicines</h3>
            <table id="selectedTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Quantity </th>
                        <th>Expiration Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="issumeditable">
                </tbody>
            </table>

            <button onclick="issueMedi(<?php echo $pdi ?>);" id="produceButton">Issue</button>
        </div>
    </div>
    <script src="produce.js"></script>
    <!-- <script src="pharmasist/produce.js"></script> -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tableContainer = document.querySelector('#dataTable');

            tableContainer.addEventListener('wheel', (event) => {
                if (tableContainer.scrollHeight > tableContainer.clientHeight) {
                    const deltaY = event.deltaY;

                    if (
                        (deltaY > 0 && tableContainer.scrollTop + tableContainer.clientHeight >= tableContainer.scrollHeight) ||
                        (deltaY < 0 && tableContainer.scrollTop <= 0)
                    ) {
                        event.preventDefault();
                    }
                }
            });
        });

        function issueMedi(pdi) {
            // alert(document.getElementById("dataTable").rows[1].cells.item(3).innerHTML);
            // alert((document.getElementById("dataTable").rows.length) -1);

            let tableBody = document.querySelector('.issumeditable');
            let tableRows = Array.from(tableBody.querySelectorAll('tr'));
            // console.log(tableRows);



            let patientMediData = [];

            for (let i = 0; i < tableRows.length; i++) {
                let row = tableRows[i];
                let tds = Array.from(row.querySelectorAll('td'));
                let mname = tds[0].textContent;
                let mbrand = tds[1].textContent;
                let mexdate = tds[3].textContent;
                let minput = tds[2].querySelector('input');
                let mqty = minput ? minput.value : null;

                if (mqty == 0 || mqty == null) {

                    alert('Please Enter ' + mname + ' Quantity (mg)');
                    patientMediData = [];
                    break;
                } else {

                    let medicientrow = {
                        mname: mname,
                        mbrand: mbrand,
                        mqty: mqty,
                        mexdate: mexdate,
                        // pdi: pdi
                    };
                    patientMediData.push(medicientrow);
                }
            }
            if (patientMediData.length > 0) {
                // alert('Data stored successfully!');
                // console.log(patientMediData); // You can see the array in the browser console

                let AldataMedic = {
                    pdi: pdi,
                    medicines: patientMediData
                };

                fetch('patientMedicineProcess.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(AldataMedic)
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data == "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Your work has been saved",
                                background: "#fff",
                                text: "Medicines release is successful!",
                                showConfirmButton: true,
                                customClass: {
                                    popup: 'swal2-dark'
                                }

                                // timer: 2000
                            }).then(() => {
                                // alert(data);
                                window.location = "pharmasist.php"
                                // window.location = "index.php";
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                // color: "#22252c",
                                background: "#fff",
                                // text: "Something went wrong!",
                                text: data,
                                customClass: {
                                    popup: 'swal2-dark'
                                }

                                // footer: '<a href="#">Why do I have this issue?</a>'
                            });
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        alert('An error occurred');
                    });


            }

        }

        function cancelMedicine(pdi) {

            let tableBody = document.querySelector('.issumeditable');
            let tableRows = Array.from(tableBody.querySelectorAll('tr'));

            if (tableRows.length == 0) {

                Swal.fire({
                    title: "Are you sure?",
                    text: "Are you sure the medication doesn't need to be dispensed?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes !"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('medicationCancelProcess.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    pdi: pdi
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Success:', data);


                                if (data.status === 'success') {
                                    console.log('Success:', data.message);
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Your work has been saved",
                                        background: "#fff",
                                        text: data.message,
                                        showConfirmButton: true,
                                        customClass: {
                                            popup: 'swal2-dark'
                                        }

                                        // timer: 2000
                                    }).then(() => {
                                        window.location = "pharmasist.php"
                                    });

                                    // alert(data.message);
                                } else {
                                    alert('Error: ' + data.message);
                                }

                                // alert('Data processed successfully');
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                                alert('An error occurred');
                            });
                    }
                });
            }
        }
    </script>
    <script src="../assets/js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>