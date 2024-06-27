<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php'; // Include PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department = $_POST["department"];
    $publicationType = $_POST["publication_type"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Initialize the WHERE clause
    $whereClause = "";

    // Check if department is selected
    if (!empty($department)) {
        $whereClause = "department = '" . $conn->real_escape_string($department) . "'";
    }

    // Add date range condition to the WHERE clause
    if (!empty($start_date) && !empty($end_date)) {
        $dateCondition = "pub_date BETWEEN '$start_date' AND '$end_date'";
        if (!empty($whereClause)) {
            $whereClause .= " AND " . $dateCondition;
        } else {
            $whereClause = $dateCondition;
        }
    }

    // Fetch data from the database based on the WHERE clause and publication type
    $query = "SELECT * FROM " . $conn->real_escape_string($publicationType);
    if (!empty($whereClause)) {
        $query .= " WHERE " . $whereClause;
    }

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Create a new PhpSpreadsheet instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Initialize column index
        $colIndex = 1;

        // Add column headers to the spreadsheet
        $columns = array_keys($result->fetch_assoc());
        $idColumnIndex = array_search('id', $columns);
        if ($idColumnIndex !== false) {
            unset($columns[$idColumnIndex]);
        }
        $sheet->setCellValueByColumnAndRow($colIndex, 1, 'Sr No');
        $colIndex++;
        foreach ($columns as $column) {
            $sheet->setCellValueByColumnAndRow($colIndex, 1, $column);
            $colIndex++;
        }

        // Reset the result set to the beginning
        $result->data_seek(0);

        // Initialize Sr No counter
        $srNo = 1;

        // Write fetched data rows with Sr No
        while ($row = $result->fetch_assoc()) {
            unset($row['id']);
            $colIndex = 1;

            // Add the Sr No to the spreadsheet
            $sheet->setCellValueByColumnAndRow($colIndex, $srNo + 1, $srNo);

            // Add other data columns
            foreach ($row as $value) {
                $sheet->setCellValueByColumnAndRow($colIndex, $srNo + 1, $value);
                $colIndex++;
            }

            $srNo++;
        }

        // Auto-adjust column widths
        foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create a Writer instance and save the spreadsheet to a file
        $writer = new Xlsx($spreadsheet);
        $filename = "Report.xlsx";
        $writer->save($filename);

        // Set appropriate headers to force download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Output the file
        readfile($filename);

        // Delete the temporary file
        unlink($filename);

        // Prevent further execution
        exit;
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Generation</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="profile">
                <img src="xyz.jpeg" alt="Profile Image">
                <span>Welcome, Pallavi !</span>
            </div>
        </div>
        <div class="content">
            <h1>Generate Report report 2 he ye</h1>
            <form class="report-form" action="Report.php" method="post">
                <label for="department">Select Department:</label>
                <select id="department" name="department">
                    <option value="">-- Select an option --</option>
                    <option value="Computer Engineering">Computer Engineering</option>
                    <option value="Computer Sciences & Business Systems">Computer Sciences & Business Systems</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Electronics & Computer Engineering">Electronics & Computer Engineering</option>
                    <option value="Instrumentation Engineering">Instrumentation Engineering</option>
                    <option value="Artificial Intelligence & Data Science">Artificial Intelligence & Data Science</option>
                    <option value="Electronics Engineering">Electronics Engineering</option>
                    <option value="Electronics & Telecommunication Engineering">Electronics & Telecommunication Engineering</option>
                    <option value="Electrical & Instrumentation Engineering">Electronics Engineering</option>
                </select>
                
                <label for="publication_type">Select Publication Type:</label>
                <select id="publication_type" name="publication_type">
                    <option value="books">Books</option>
                    <option value="book_chapters">Book Chapters</option>
                    <option value="conference">Conference</option>
                    <option value="copyright">Copyright</option>
                    <option value="journals">Journals</option>
                    <option value="papers">Papers</option>
                    <option value="patents">Patents</option>
                </select>
                
               <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>

    <input type="submit" value="Report">
</form>
        </div>
    </div>
</body>
</html>
