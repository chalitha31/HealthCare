<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Instantiate and use the dompdf class
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Load HTML content
$html = file_get_contents('reception/medical-report.php');
// $html = '<html><body>';
// $html = '<img src="./MLT/images/vldl_medical_report_36_kumarsanga_2024-06-24_18-45-20.jpg"  style="width:100%;">';
// $html .= '</body></html>';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("Medical_Report.pdf", array("Attachment" => 0));
?>
