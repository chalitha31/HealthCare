<?php
require '../vendor/autoload.php';
$input = file_get_contents('php://input');
$data = json_decode($input, true);
header('Content-Type: application/json');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;



if ($data === null) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
    exit;
}


$tableData = $data['tableData'];
$headerData = $data['tableHeadData'];
$headerName = $data['name'];

// print_r($tableData);

// if (ob_get_length()) ob_end_clean();


$countHead = count($headerData);

$enNum;
$dataR;
$titleR;
switch ($countHead) {

case 1:
    $enNum = 'A3:A3';
    $dataR = 'A4:A';
    $titleR = 'A1:A1';
    break;
case 2:
    $enNum = 'A3:B3';
    $dataR = 'A4:B';
    $titleR = 'A1:B1';
    break;
case 3:
    $enNum = 'A3:C3';
    $dataR = 'A4:C';
    $titleR = 'A1:C1';
    break;

case 4:
    $enNum = 'A3:D3';
    $dataR = 'A4:D';
    $titleR = 'A1:D1';
    break;

case 5:
    $enNum = 'A3:E3';
    $dataR = 'A4:E';
    $titleR = 'A1:E1';
    break;

case 6:
    $enNum = 'A3:F3';
    $dataR = 'A4:F';
    $titleR = 'A1:F1';
    break;

case 7:
    $enNum = 'A3:G3';
    $dataR = 'A4:G';
    $titleR = 'A1:G1';
    break;

case 8:
    $enNum = 'A3:H3';
    $dataR = 'A4:H';
    $titleR = 'A1:H1';
    break;

case 9:
    $enNum = 'A3:I3';
    $dataR = 'A4:I';
    $titleR = 'A1:I1';
    break;

case 10:
    $enNum = 'A3:J3';
    $dataR = 'A4:J';
    $titleR = 'A1:J1';
    break;

}

// Initialize Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set title in merged cells
$title = $headerName;
// $sheet->mergeCells('A1:G1');
$sheet->mergeCells($titleR);
$sheet->setCellValue('A1', $title);

// Style the title
// $titleRange = 'A1:G1';
$titleRange = $titleR;
$sheet->getStyle($titleRange)->applyFromArray([
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'color' => ['rgb' => 'ADD8E6'] // Light blue background
    ],
    'font' => [
        'bold' => true,
        'size' => 16, // Larger font size
        'color' => ['rgb' => '000000'] // Black text
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
]);

// Set row heights for title and add space before the table
$sheet->getRowDimension(1)->setRowHeight(30); // Title row height
$sheet->getRowDimension(2)->setRowHeight(10); // Space row height
$sheet->getRowDimension(3)->setRowHeight(20); // header row height

// Set column widths
$sheet->getColumnDimension('A')->setWidth(20);
$sheet->getColumnDimension('B')->setWidth(30);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(30);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(40);
$sheet->getColumnDimension('H')->setWidth(40);
$sheet->getColumnDimension('I')->setWidth(30);
$sheet->getColumnDimension('J')->setWidth(40);

// Set column headers
// $headers = ['Medicine ID', 'Medicine Name', 'Medicine Brand','purchase Date', 'Out of Stock Date', 'Total Usage Quantity','Estimate Stock for 6 months'];
$sheet->fromArray($headerData, NULL, 'A3');



// Style the header row
// $headerRange = 'A3:G3';
$headerRange = $enNum;
$sheet->getStyle($headerRange)->applyFromArray([
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'color' => ['rgb' => 'FFFF00'] // Yellow background
    ],
    'font' => [
        'bold' => true,
        'color' => ['rgb' => '000000'] // Black text
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'] // Black border
        ]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
]);

// Add data from your HTML table
// $data = [
//     ['1', 'Paracetamol', 'Brand A', '2023-01-01', '2023-07-01', '100', '600'],
//     ['2', 'Ibuprofen', 'Brand B', '2023-02-01', '2023-07-01', '150', '900'],
//     // Add more rows as needed
// ];


$rowNumber =4; // Starting row number for data
foreach ($tableData as $row) {
    $sheet->fromArray($row, NULL, 'A' . $rowNumber);
    $sheet->getRowDimension($rowNumber)->setRowHeight(18);
    $rowNumber++;
}

// Apply cell styling for data
$dataRange = $dataR . ($rowNumber - 1);
$sheet->getStyle($dataRange)->applyFromArray([
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'] // Black border
        ]
    ],
]);

// Write the file
$writer = new Xlsx($spreadsheet);
$fileName = 'OutOFStock_Medicines.xlsx';

// $writer->save($fileName);

// Optional: Force download the file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>
