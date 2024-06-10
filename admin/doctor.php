<head>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        table {
            width: 80%;
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

        #dataTable {
            max-height: 500px;
            overflow-y: auto;
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

        .email-form-container {
            margin-top: 80px;
            max-width: 500px;
        }

        .email-form-container h3 {
            color: var(--base-color);
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form .form-group {
            margin-bottom: 15px;
        }

        form label {
            margin-bottom: 5px;
            color: var(--dark-gray);
        }

        form input,
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--medium-gray);
            border-radius: 5px;
            font-size: 1em;
            color: var(--dark-gray);
            background-color: #FFFFFF;
            transition: border-color 0.3s;
        }

        form input:focus,
        form textarea:focus {
            border-color: var(--base-color);
            outline: none;
        }

        form button {
            padding: 10px 15px;
            background-color: var(--base-color);
            border: none;
            border-radius: 5px;
            color: #FFFFFF;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: var(--second-base-color);
        }
    </style>

    <script>


    </script>
</head>
<h2 class="content-title">Doctors Section</h2>
<input type="text" id="searchBar" placeholder="Search..." onkeyup="filterTable()">
<table id="dataTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <tr onclick="window.location.href='../employee-profile.php'">
            <td>1</td>
            <td>John Doe</td>
        </tr>
        <tr onclick="window.location.href='../employee-profile.php'">
            <td>2</td>
            <td>Jane Smith</td>
        </tr>
        <tr onclick="window.location.href='../employee-profile.php'">
            <td>3</td>
            <td>Michael Johnson</td>
        </tr>
    </tbody>
</table>
<div class="email-form-container">
    <h3>Add new Doctor</h3>
    <form method="post" action="sendLoginDetails.php" id="emailForm">
    <input type="hidden" name="source" value="doctor">
        <div class="form-group">
            <label for="nic">Nic/Passport no :</label>
            <input type="text" id="nic" name="nic" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit">Send</button>
    </form>
</div>