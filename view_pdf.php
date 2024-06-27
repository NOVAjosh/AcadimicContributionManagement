<?php
if (isset($_GET['pdf'])) {
    $pdfFilePath = 'Copyright/' . $_GET['pdf'];
    if (file_exists($pdfFilePath)) {
        header('Content-type: application/pdf');
        readfile($pdfFilePath);
    } else {
        echo "PDF file not found.";
    }
} else {
    echo "No PDF specified.";
}
?>
