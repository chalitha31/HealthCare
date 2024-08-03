<?php require_once "../connection.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            max-width: 500px;
            margin: 5px auto;
            margin-bottom: 5px;
            padding: 10px 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4CAF50;
            margin-top: 0px;
            text-align: center;
        }

        .section {
            margin-bottom: 10px;
        }

        h3 {
            color: #333;
            /* text-align: center; */
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
            margin-bottom: 10px;
            font-size: 15px;
        }

        p {
            margin: 5px 0;
            font-size: 12px;
        }

        p strong {
            color: #000;
        }

        .signature-block {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 0px;
        }


        .scissors-hr-container {
            display: flex;
            align-items: center;
        }

        hr {
            border: 2px dotted black;
            width: 500px;
            margin: 0 0 0 10px;
            /* Adjust the margin as needed */
        }



        .bill {
            width: 300px;
            padding: 20px;
            margin: 5px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }

        .bill h1 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .bill-info {
            text-align: left;
            margin-bottom: 20px;
        }

        .bill-info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: left;
            margin-bottom: 20px;
        }

        .note {
            font-size: 0.9em;
            color: #666;
        }

        .patient-info {
            /* margin-bottom: 20px; */
            font-size: 1em;
            color: var(--dark-gray);
            display: flex;
            justify-content: space-between;
            /* background-color: rgb(241, 241, 241); */
            /* padding: 10px; */
        }
        .patient-info p {
            margin: 2px 0;
        }

    </style>
</head>

<body>

    <?php

    // $pdi = $_GET["pdi"];
$pdi = 31;
    $currentDate = new DateTime();

    $formattedDate = $currentDate->format('F j, Y');

    $patiientResultSet = Database::search("SELECT  `registered_patients`.`name` AS `name`,`patients_details`.`age` AS `age`,`patients_details`.`medical_report` AS `medical_report`
        FROM `patients_details` 
        INNER JOIN  `registered_patients` ON `registered_patients`.`p_id` = `patients_details`.`patients_id`
        WHERE `patients_details`.`medical_report` != '' AND  `patients_details`.`medical_report` != 'no' AND  `patients_details`.`medical_report` != 'yes' AND `patients_details`.`id` = '" . $pdi . "'  ORDER BY `patients_details`.`id` DESC LIMIT 1");

    $numRows = $patiientResultSet->num_rows;

    if ($numRows >= 0) {

        $pDetails = $patiientResultSet->fetch_assoc();
    ?>


        <div class="bill">
            <h1>Hospital Medical Laboratory</h1>
            <div class="bill-info">
                <p><strong>Patient Name:</strong> <?php echo $pDetails["name"] ?></p>
                <p><strong>Date:</strong> <?php echo $formattedDate ?></p>
                <p><strong>Bill Number:</strong> <?php echo (rand(1000, 99999)); ?></p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fee for the medical test</td>
                        <td>Rs : 100.00</td>
                    </tr>
                </tbody>
            </table>
            <div class="total">
                <p><strong>Total:</strong> Rs : 100.00</p>
            </div>
            <p class="note">Thank you for your visit. Please come again!</p>
        </div>

        <div class="scissors-hr-container">
        <img src="http://localhost/HealthCare/assets/images/s.jpg" alt="Scissors Image" style="height: 20px;">
            <hr>
        </div>

        <div class="container">
            <h2>Medical Report</h2>
            <div style="justify-content: center;" class="patient-info">
                    <div>
                        <h1 style="color: #0080c0;">Primary Medical Care Unit Minuwangamuwa</h1>
                        <p style="text-align: center;">130,Main street, Minuwangamuwa</p>
                        <h2 style="color: #b70000; text-align: center;">MEDICAL LABORATORY REPORT</h2>
                    </div>
                   
                </div>
              
            <div class="section">
                <h3>Patient Information</h3>
                <p><strong>Name:</strong> <?php echo $pDetails["name"] ?></p>
                <p><strong>Age:</strong> <?php echo $pDetails["age"] ?></p>
                <!-- <p><strong>Gender:</strong> Male</p> -->
                <p><strong>Date of Examination:</strong> <?php echo $formattedDate ?></p>
            </div>

            <div class="section">
                <h3>Diagnosis</h3>
                <!-- <p>Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet consectetur, adipisicing elit. At distinctio voluptatibus, expedita quibusdam, aliquid quasi dolores quos sit, eius cum quidem culpa voluptatum non illo. Beatae deleniti perferendis doloremque inventore, labore impedit error magni, magnam maxime a, obcaecati illo? Excepturi numquam exercitationem itaque voluptatibus ullam. A voluptas ipsum neque minima suscipit beatae explicabo cum quisquam, eius ullam blanditiis, enim magni inventore officia consequuntur obcaecati similique sequi quidem facilis eum dolores maiores alias perferendis laboriosam. Doloribus, voluptatibus modi sunt impedit animi assumenda! Iure eligendi doloremque impedit dolorem cumque maiores harum quidem mollitia deleniti iusto libero numquam, voluptatem soluta adipisci deserunt est? consectetur adipiscing elit. Nulla faucibus lorem vel turpis sollicitudin consequat.</p> -->
                <p><?php echo $pDetails["medical_report"] ?>.</p>
            </div>


            <div class="signature-block">
                <p>...........................</p>
                <p>Signature</p>
            </div>
        </div>

    <?php } ?>

</body>

</html>