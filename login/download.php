<?php
if (isset($_GET['file'])) {
    $fileName = basename($_GET['file']); // Ensure safe filename extraction
    $filePath = "uploads/" . $fileName; // Locate file in "uploads/" directory

    if (file_exists($filePath)) {
        // Force download headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "Error: File not found!";
    }
} else {
    echo "Invalid request!";
}
?>
