<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['image'];
    $data = str_replace('data:image/jpeg;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode($data);

    // Generate a filename with the current date and time
    $filename = 'medical_report_' . date('Y-m-d_H-i-s') . '.jpg';
    $file = 'images/' . $filename;

    if (file_put_contents($file, $data)) {
        echo 'Image saved successfully as ' . $filename;
    } else {
        echo 'Failed to save image';
    }
} else {
    echo 'Invalid request';
}
