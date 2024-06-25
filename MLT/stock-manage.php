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
                    <th>Name</th>
                    <th>Current Stock</th>
                    <th>Weekly Usage</th>
                    <th>Current Stock Availability (in days)</th>
                    <th>Estimate Stock for 6 months</th>
                </tr>
            </thead>
            <tbody>
                <tr class="data-row">
                    <td>1</td>
                    <td>Paracetamol</td>
                    <td>150</td>
                    <td>25</td>
                    <td>0</td>
                    <td>650</td>
                </tr>
                <tr class="data-row">
                    <td>2</td>
                    <td>Ibuprofen</td>
                    <td>220</td>
                    <td>30</td>
                    <td>51</td>
                    <td>780</td>
                </tr>
                <tr class="data-row">
                    <td>3</td>
                    <td>Amoxicillin</td>
                    <td>180</td>
                    <td>20</td>
                    <td>63</td>
                    <td>520</td>
                </tr>
                <tr class="data-row">
                    <td>4</td>
                    <td>Cetirizine</td>
                    <td>90</td>
                    <td>10</td>
                    <td>63</td>
                    <td>260</td>
                </tr>
                <tr class="data-row">
                    <td>5</td>
                    <td>Omeprazole</td>
                    <td>300</td>
                    <td>35</td>
                    <td>60</td>
                    <td>910</td>
                </tr>
                <tr class="data-row">
                    <td>6</td>
                    <td>Metformin</td>
                    <td>120</td>
                    <td>15</td>
                    <td>56</td>
                    <td>390</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>