<?php
session_start(); // Start the session
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_SESSION['name']; // Retrieve the name from the session variable


// Logout button
if(isset($_POST['logout'])) {
	session_unset();
	session_destroy();
	header("Location: index.php");
}

?>
<?php
    // Database connection parameters
    $servername = "sql105.infinityfree.com";
    $username = "if0_35273413";
    $password = "uBNMpIV1LS";
    $dbname = "if0_35273413_durga";

    // Create a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define an array of table names
    $tables = ['books', 'book_chapters', 'copyright', 'journals', 'papers', 'patents']; // Replace with your actual table names

    // Initialize an associative array to store department counts
    $departmentCounts = [];

    // Loop through the tables and count the entries for each department
    foreach ($tables as $table) {
        // Execute a query to count the entries in the table by department
        $countSql = "SELECT department, COUNT(*) as count FROM $table GROUP BY department";
        $countResult = $conn->query($countSql);

        if ($countResult->num_rows > 0) {
            while ($row = $countResult->fetch_assoc()) {
                $department = $row['department'];
                $count = (int)$row['count'];

                // Add the department count to the associative array
                if (isset($departmentCounts[$department])) {
                    $departmentCounts[$department] += $count;
                } else {
                    $departmentCounts[$department] = $count;
                }
            }
        }
    }

    // Close the database connection
    $conn->close();

    // Prepare data for the pie chart
    $departmentLabels = array_keys($departmentCounts);
    $departmentData = array_values($departmentCounts);
    ?>
    <?php
    // Database connection parameters
    $servername = "sql105.infinityfree.com";
    $username = "if0_35273413";
    $password = "uBNMpIV1LS";
    $dbname = "if0_35273413_durga";

    // Create a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define an array of table names
    $tables = ['books', 'book_chapters', 'copyright', 'journals', 'papers', 'patents']; // Replace with your actual table names

    // Initialize an array to store the total count for each table
    $tableCounts = array();

    // Loop through the tables and count the entries
    foreach ($tables as $table) {
        // Execute a query to count the entries in the table
        $countSql = "SELECT COUNT(*) as count FROM $table";
        $countResult = $conn->query($countSql);

        if ($countResult->num_rows > 0) {
            $countRow = $countResult->fetch_assoc();
            $count = $countRow['count'];
            $tableCounts[$table] = $count;
        }
    }

    // Close the database connection
    $conn->close();

    // Prepare data for the chart
    $tableNames = array_keys($tableCounts);
    $countValues = array_values($tableCounts);



    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
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
            background-color: #CD8181;
            background: linear-gradient(0deg,rgba(0,0,0,.25),#000);
            border-bottom: 1px solid #ccc;
        }

        .nav a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .nav a:hover {
            background-color: #A82626;
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
            background: linear-gradient(0deg,rgba(0,0,0,.25),grey);
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

        /* Chart styles */
        .charts-container {
            display: flex;
            justify-content: space-between;
        }

        .chart {
            width: 48%;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .chart canvas {
            height: 300px; /* Fixed height for the canvas */
        }

        @media (max-width: 768px) {
            .chart {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="profile">
            <img src="xyz.jpeg" alt="Profile photo">
            <span>Welcome, <?php echo $name; ?> !</span>
        </div>
        <!-- Logout button -->
        <form class="logout-form" method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>

    <div class="nav">
        <a href="Report.php">Report Generation</a>
        <a href="manage_signup_requests.php">Manage Signup Requests</a>
    </div>
    <div>
    	<?php
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the total number of users
$sqlUsers = "SELECT COUNT(*) AS totalUsers FROM users";
$resultUsers = $conn->query($sqlUsers);

// Query to get the total number of entries across all forms
$sqlTotalEntries = "SELECT SUM(totalCount) AS totalEntries FROM (";
$tables = ['books', 'book_chapters', 'conference', 'copyright', 'journals', 'papers', 'patents'];

foreach ($tables as $table) {
    $sqlTotalEntries .= "SELECT COUNT(*) AS totalCount FROM $table UNION ALL ";
}

$sqlTotalEntries = rtrim($sqlTotalEntries, "UNION ALL ");
$sqlTotalEntries .= ") AS entries";
$resultTotalEntries = $conn->query($sqlTotalEntries);

// Query to get the form with the maximum number of entries
$sqlMaxEntriesForm = "SELECT form, MAX(totalCount) AS maxEntries FROM (";
foreach ($tables as $table) {
    $sqlMaxEntriesForm .= "SELECT '$table' AS form, COUNT(*) AS totalCount FROM $table UNION ALL ";
}
$sqlMaxEntriesForm = rtrim($sqlMaxEntriesForm, "UNION ALL ");
$sqlMaxEntriesForm .= ") AS maxEntriesTable";
$resultMaxEntriesForm = $conn->query($sqlMaxEntriesForm);

// Fetch the results
$totalUsers = $resultUsers->fetch_assoc()['totalUsers'];
$totalEntries = $resultTotalEntries->fetch_assoc()['totalEntries'];
$maxEntriesForm = $resultMaxEntriesForm->fetch_assoc();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>KPIs</title>
    <style>
        table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}
thead {
  background-color:  #CD8181;
  font-weight: bold;
}
th, td {
  text-align: center;
  padding: 8px;
  border: 1px solid #ddd;
}
th:first-child, td:first-child {
  width: 33%;

}
th:nth-child(2), td:nth-child(2) {
  width: 33%;

}
th:last-child, td:last-child {
  width: 33%;
}

p {
  margin-bottom: 20px;
}

    </style>
</head>
<body>
    
    <table>
        <tr>
            <th> Users</th>
            <th> Contributions</th>
            <th>Top Contribution </th>
        </tr>
        <tr>
            <td><?php echo $totalUsers; ?></td>
            <td><?php echo $totalEntries; ?></td>
            <td><?php echo $maxEntriesForm['form'] . " (" . $maxEntriesForm['maxEntries'] . " entries)"; ?></td>
        </tr>
    </table>
</body>
</html>


    </div>

    <div class="content">
        <!-- Charts container -->
        <div class="charts-container">
            <!-- Pie Chart -->
            <div class="chart">
                <h2>Contribution Per Department</h2>
                <div style="height: 300px; overflow: hidden;">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="chart">
                <h2>Total Counts</h2>
                <div style="height: 300px; overflow: hidden;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var departmentLabels = <?php echo json_encode($departmentLabels); ?>;
    var departmentData = <?php echo json_encode($departmentData); ?>;

    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: departmentLabels,
            datasets: [{
                data: departmentData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(0, 128, 128, 0.8)',
                    'rgba(255, 69, 0, 0.8)',
                    'rgba(70, 130, 180, 0.8)'
                    // Add more colors as needed
                ],
                borderColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(0, 128, 128, 0.8)',
                    'rgba(255, 69, 0, 0.8)',
                    'rgba(70, 130, 180, 0.8)'
                    // Add more colors as needed
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    var tableNames = <?php echo json_encode($tableNames); ?>;
    var countValues = <?php echo json_encode($countValues); ?>;
    
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: tableNames,
            datasets: [{
                label: 'Total Counts',
                data: countValues,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>

