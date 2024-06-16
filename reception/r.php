<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/common.css">

    
<style>

.symptoms-table-container {
    margin-top: 80px;
    padding: 20px;
}

.symptoms-table-container h2 {
    color: var(--base-color);
    margin-bottom: 20px;
}

#symptoms{
    resize: vertical;
}

.add-symptoms-btn {
    margin-bottom: 20px;
    padding: 10px 15px;
    background-color: var(--base-color);
    border: none;
    border-radius: 5px;
    color: #FFFFFF;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-symptoms-btn:hover {
    background-color: var(--second-base-color);
}

table {
    width: 100%;
    border-collapse: collapse;
}

#symptomsTable th,
#symptomsTable td{
    text-align: center;
}

th, td {
    padding: 12px 15px;
    border: 1px solid var(--medium-gray);
    text-align: left;
}

tbody tr {
    cursor: pointer;
}

tbody tr:hover {
    background-color: var(--medium-gray);
    color: white;
}

.status-btn {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    font-size: 0.9em;
    cursor: pointer;
}

.status-btn.pending {
    background-color: var(--base-color);
    color: white;
}

.status-btn.checked {
    background-color: var(--medium-gray);
    color: white;
}

</style>
</head>


<body>
    
<div class="symptoms-table-container">
            <!-- <button onclick="showPopup('add-symptoms-popup')" class="add-symptoms-btn">Add New Symptoms</button> -->
            <h2>Patient Records</h2>
            <table id="symptomsTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Symptoms Added Date and Time</th>
                        <th>Age</th>
                        <th>Doctor Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="showPopup('details-popup')">
                        <td>1</td>
                        <td>2024-06-01 10:00 AM</td>
                        <td>30</td>
                        <td><button class="status-btn pending">Pending</button></td>
                    </tr>
                    <tr onclick="showPopup('details-popup')">
                        <td>2</td>
                        <td>2024-06-02 11:00 AM</td>
                        <td>30</td>
                        <td><button class="status-btn checked">Checked</button></td>
                    </tr>
                </tbody>
            </table>
        </div>


</body>
</html>