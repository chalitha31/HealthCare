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
        white-space:pre-wrap;
        color: var(--dark-gray);
    }
    .health-issues textarea {
        /* margin: 10px 0; */
        /* width: 500px; */
        border: none;
        background: none;
        /* height: 350px; */
        font-size: 18px;
        white-space:pre-wrap;
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
        margin-bottom: 50px;
    }

    #selectedTable {
        margin-bottom: 30px;
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

    th {
        background-color: var(--base-color);
        color: white;
    }

    tbody tr {
        cursor: pointer;
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

    .maindiv{
        display: flex;
    flex-direction: row;
    margin-bottom: 15px;

    }


.left, .right {
    flex: 1;
    padding: 20px;
    box-sizing: border-box;
    overflow-x: auto; /* Scroll if content overflows */
}

.left {
    background-color: #f0f0f0;
}

.right {
    flex: 2;
    background-color: #d0d0d0;
}

/* Media query for screens smaller than 768px */
@media (max-width: 1730px) {
    .maindiv {
        flex-direction: column;
        height: auto; /* Adjust height for stacking */
    }

    .left, .right {
        height: 50vh; /* Adjust height for stacking */
    }
}


</style>

<body>
    <header>
        <div class="logo">Healthcare</div>
        <div class="header-username">UserName</div>
        <!-- <button id="loginBtn">Login</button> -->
    </header>
    <div class="main-container">
        <div class="content" id="content">
        <!-- style="display: flex;height: 500px; margin: 20px;" -->
            <div  class="maindiv">

                <div  class="left ">
                    <h2 class="content-title">Produce medicine</h2>
                    <div class="health-issues">
                        <h3>Patient Name Prescription</h3>
                        <!-- <p>Paracetamol 30</p>
                        <p>Ibuprofen 30</p>
                        <p>Amoxicillin 20</p>
                        <p>Aspirin 40</p> -->
                        <p>
                       </p>

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
                                <th>Quantity (mg)</th>
                                <th>Expiration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="dataRow" onclick="addToNewTable(this)">
                                <td class="name">Paracetamol</td>
                                <td class="brand">ABC Pharma</td>
                                <td class="quantity">500</td>
                                <td class="exp">2024-12-01</td>
                            </tr>
                            <tr class="dataRow" onclick="addToNewTable(this)">
                                <td class="name">Ibuprofen</td>
                                <td class="brand">XYZ Pharma</td>
                                <td class="quantity">200</td>
                                <td class="exp">2025-06-15</td>
                            </tr>
                            <tr class="dataRow" onclick="addToNewTable(this)">
                                <td class="name">Amoxicillin</td>
                                <td class="brand">HealthCare Inc.</td>
                                <td class="quantity">250</td>
                                <td class="exp">2023-09-30</td>
                            </tr>
                            <tr class="dataRow" onclick="addToNewTable(this)">
                                <td class="name">Aspirin</td>
                                <td class="brand">MediCare Ltd.</td>
                                <td class="quantity">100</td>
                                <td class="exp">2024-03-22</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <h3>Selected Medicines</h3>
            <table id="selectedTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Quantity (mg)</th>
                        <th>Expiration Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic content will be inserted here -->
                </tbody>
            </table>

            <button id="produceButton">Produce</button>
        </div>
    </div>
    <script src="produce.js"></script>
</body>

</html>