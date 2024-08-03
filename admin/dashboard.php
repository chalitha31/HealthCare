<head>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--medium-gray);
        }

        .header h1 {
            color: var(--base-color);
        }

        .dash-sub-heading {
            margin-top: 50px;
            margin-bottom: 10px;
        }

        .dashboard-content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }


        .stat-box {
            flex: 1 1 calc(50% - 20px);
            background-color: #d0d2d5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-box h3 {
            margin-top: 0;
            margin-bottom: 5px;
            color: var(--dark-gray);
        }

        .stat-box p {
            font-size: 2em;
            color: var(--base-color);
        }

        .patients-dash .stat-box {
            background-color: var(--medium-gray);
        }

        .patients-dash h3 {
            color: white;
        }

        @media (max-width: 768px) {
            .stat-box {
                flex: 1 1 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="../assets/css/common.css">
</head>

<?php

require_once "../connection.php";

$docResultSet = Database::search("SELECT COUNT(*) AS total FROM `registered_doctor`");
$resResultSet = Database::search("SELECT COUNT(*) AS total FROM `registered_reception`");
$parmResultSet = Database::search("SELECT COUNT(*) AS total FROM `registered_pharmacists`");
$mltResultSet = Database::search("SELECT COUNT(*) AS total FROM `registered_mlt`");
$patientResultSet = Database::search("SELECT `register_date` AS `rdate` FROM `registered_patients`");
$patientDetailsResultSet = Database::search("SELECT `symptoms_date` AS `sdate` FROM `patients_details`");
// $dnumr = $docResultSet->num_rows;
// $rnumr = $resResultSet->num_rows;
// $pnumr = $parmResultSet->num_rows;
// $mnumr = $mltResultSet->num_rows;
$patientnumr = $patientResultSet->num_rows;
$patienDetailstnumr = $patientDetailsResultSet->num_rows;

$docResult = $docResultSet->fetch_assoc();
$resResult = $resResultSet->fetch_assoc();
$parmResult = $parmResultSet->fetch_assoc();
$mltResult = $mltResultSet->fetch_assoc();


$docCount = ($docResult["total"] - 1);
$resCount = $resResult["total"];
$parmCount = $parmResult["total"];
$mltCount = $mltResult["total"];
// $patientCount = $patientResult["total"];


$d = new DateTime();
$tz = new DateTimeZone("Asia/colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

// $d->modify('-7 days');
// $date7daysAgo = $d->format('Y-m-d');

$currntDate = new DateTime($date);

$dailyVisitsPatient = 0;
$lastWeekRegPatient = 0; // last week patient count
$monthVisit = 0;

if ($patientnumr > 0) {
    // last week registered patient count

    while ($patientResult = $patientResultSet->fetch_assoc()) {


        $patientRegDate = $patientResult["rdate"]; // patient register date
        $pConverDate = new DateTime($patientRegDate); // patient register date

        $interval = $currntDate->diff($pConverDate);  

        // if ($interval->h <= 24 &&  $interval->d == 0 && $interval->m == 0  && $interval->y == 0) {
        //     $dailyVisitsPatient += 1;
        // }

        if ($interval->h <= 24 &&  $interval->d <= 7 && $interval->m == 0  && $interval->y == 0) {
            $lastWeekRegPatient += 1;
        }

        // if ($interval->h <= 24 &&  $interval->d <= 30 && $interval->m == 0 && $interval->y == 0) {
        //     $monthVisit += 1;
        // }

    } 
     // last week registered patient count
}

if ($patienDetailstnumr > 0) {

    while ($patientDetailsResult = $patientDetailsResultSet->fetch_assoc()) {


        $patientDRegDate = $patientDetailsResult["sdate"];
        $pDConverDate = new DateTime($patientDRegDate);

        $Dinterval = $currntDate->diff($pDConverDate);

        if ($Dinterval->h <= 24 &&  $Dinterval->d == 0 && $Dinterval->m == 0  && $Dinterval->y == 0) {
            $dailyVisitsPatient += 1;
        }

        // if ($Dinterval->h <= 24 &&  $Dinterval->d <= 7 && $Dinterval->m == 0  && $Dinterval->y == 0) {
        //     $lastWeekRegPatient += 1;
        // }

        if ($Dinterval->h <= 24 &&  $Dinterval->d <= 30 && $Dinterval->m == 0 && $Dinterval->y == 0) {
            $monthVisit += 1;
        }
    }

    $dailyAvg = $monthVisit / 30;

    // if ($dailyAvg < 1) {
    //     $monthVisit = 0;
    // } else {

        $monthVisit=(($dailyAvg/$patienDetailstnumr)*100);
    // }

    // $monthVisit = $dailyAvg;

}
?>

<div class="container">
    <h2 class="content-title">Dashboard</h2>
    <div class="dashboard-content">
        <div class="stat-box">
            <h3>Doctors</h3>
            <p id="doctors-count"><?php echo $docCount ?></p>
        </div>
        <div class="stat-box">
            <h3>Pharmacists</h3>
            <p id="pharmacists-count"><?php echo $parmCount ?></p>
        </div>
        <div class="stat-box">
            <h3>MLTs</h3>
            <p id="mlts-count"><?php echo $mltCount ?></p>
        </div>
        <div class="stat-box">
            <h3>Receptionists</h3>
            <p id="receptionists-count"><?php echo $resCount ?></p>
        </div>
    </div>
    <h3 class="dash-sub-heading">Patients Status</h3>
    <div class="dashboard-content patients-dash">
        <div class="stat-box">
            <h3>Patients</h3>
            <p id="patients-count"><?php echo $patientnumr ?></p>
        </div>
        <div class="stat-box">
            <h3>Today Visits</h3>
            <p id="patients-count"><?php echo $dailyVisitsPatient ?></p>
        </div>
        <div class="stat-box">
            <h3>AVG Daily Visits Rate</h3>
            <p id="avg-new-patients-per-day"><?php echo round( $monthVisit,2 ) ?>%</p>
        </div>
        <div class="stat-box">
            <h3>New Patients Last Week</h3>
            <p id="new-patients-last-week"><?php echo $lastWeekRegPatient ?></p>
        </div>
    </div>
</div>