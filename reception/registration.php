<head>
    <style>
        .registration-form {
            display: flex;
            flex-direction: column;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            column-gap: 50px;
            justify-content: space-between;
        }

        .form-group {
            flex: 1;
            min-width: 45%;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-top: 10px;
            margin-bottom: 5px;
            color: var(--dark-gray);
        }

        .registration-form input,
        .registration-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--medium-gray);
            border-radius: 5px;
            font-size: 1em;
            color: var(--dark-gray);
            background-color: #FFFFFF;
            transition: border-color 0.3s;
        }

        .registration-form input:focus,
        .registration-form textarea:focus {
            border-color: var(--base-color);
            outline: none;
        }

        .registration-form button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: var(--base-color);
            border: none;
            border-radius: 5px;
            color: #FFFFFF;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            align-self: flex-start;
        }

        .registration-form button:hover {
            background-color: var(--second-base-color);
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .form-group {
                min-width: 100%;
            }
        }

    </style>
</head>
<h2 class="content-title">Patient Registration</h2>
<div class="registration-form">
    <div class="form-row">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="nic">NIC:</label>
            <input type="text" id="nic" name="nic" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
        </div>
        <div class="form-group">
            <label for="email">Email (optional):</label>
            <input type="email" id="email" name="email">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" required>
        </div>
    </div>
    <div class="form-group">
        <label for="symptoms">Symptoms:</label>
        <textarea id="symptoms" name="symptoms" rows="4" required></textarea>
    </div>
    <button type="submit" onclick="registerPatient()">Register</button>
</div>