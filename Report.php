<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'C:\Users\ROHIT\OneDrive\Desktop\Hosted\durga\vendor\autoload.php'; // Include PhpSpreadsheet

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

        // Define the order of columns, with 'id' at the beginning
        $columns = ['id'];
        $idColumnIndex = array_search('id', $columns);
        if ($idColumnIndex !== false) {
            unset($columns[$idColumnIndex]);
        }
        $columns = array_merge($columns, array_keys($result->fetch_assoc()));

        // Set the headers in the spreadsheet
        foreach ($columns as $column) {
            $sheet->setCellValueByColumnAndRow($colIndex, 1, $column);
            $colIndex++;
        }

        // Reset the result set to the beginning
        $result->data_seek(0);

        // Initialize Sr No counter
        $srNo = 1;

        // Calculate the total number of rows (excluding headers)
        $totalRows = $result->num_rows;

        // Write fetched data rows with Sr No
        while ($row = $result->fetch_assoc()) {
            $colIndex = 1;

            // Add the Sr No to the spreadsheet
            $sheet->setCellValueByColumnAndRow($colIndex, $srNo + 1, $srNo);

            // Add other data columns
            foreach ($columns as $key => $column) {
                if ($column === 'id') {
                    // Use $srNo as the id
                    $sheet->setCellValueByColumnAndRow($colIndex, $srNo + 1, $srNo);
                } else {
                    // Check if the column name is 'file'
                    if ($column === 'file') {
                        // Create a hyperlink formula to the file
                        $file_path = "C:\\xampp\\htdocs\\Durga\\" . $publicationType . "\\" . $row['file'];
                        $link_formula = '=HYPERLINK("' . $file_path . '", "Open File")';
                        $sheet->getCellByColumnAndRow($colIndex, $srNo + 1)->setValue($link_formula);
                    } else {
                        $sheet->setCellValueByColumnAndRow($colIndex, $srNo + 1, $row[$column]);
                    }
                }
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
    <style>
        /* Your provided CSS styles here */
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #A82626;
            color: #fff;
            padding: 20px;
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .profile img {
            border-radius: 50%;
            margin-right: 10px;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .nav {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            background-color: #eee;
            border-bottom: 1px solid #ccc;
        }

        .nav a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .nav a:hover {
            background-color: #ccc;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .logout-form {
            display: flex;
            align-items: center;
        }

        .logout-form input[type="submit"] {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .logout-form input[type="submit"]:hover {
            background-color: #d32f2f;
        }

        /* Additional styles for the report generation form */
        .report-form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .report-form label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .report-form select {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .report-form input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .report-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
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
            <h1>Generate Report</h1>
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
