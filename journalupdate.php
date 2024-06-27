<?php
// Establish database connection
session_start();
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die("ID parameter not provided.");
}
$id = $_GET['id'];
echo "ID: " . $id; // This will help you confirm if the ID is being correctly passed

// Retrieve data for the given ID
$sql = "SELECT * FROM journals WHERE id = '$id'";
$data = mysqli_query($conn, $sql);

// Check if data retrieval was successful
if (!$data) {
    die("Error retrieving data from the database: " . mysqli_error($conn));
}

// Check if any rows were returned
if (mysqli_num_rows($data) > 0) {
    $result = mysqli_fetch_assoc($data);
} else {
    die("No data found for the given ID.");
}

// Redirect to login page if not logged in
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}

// Handle form submission
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $sdrn = $_POST['sdrn'];
    $title = $_POST['title'];
    $authors = $_POST['authors'];
    $department = $_POST['department'];
    $journal = $_POST['journal'];
    $pub_date = $_POST['pub_date'];
    $issn = $_POST['issn'];
    $doi = $_POST['doi'];
    $impact_factor = $_POST['impact_factor'];
    
     // Check if a new file is uploaded
	 if (!empty($_FILES['file']['name'])) {
        // Define the target directory where files will be uploaded
        $target_dir = "Journals/";

        // Get the original file extension
        $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

       // Create a unique file name
       $unique_file_name = $sdrn . "_" . $title . "_Patent_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;
       $target_file = $target_dir . $unique_file_name;

        // Move uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            // File moved successfully
        } else {
            // Handle file upload error
            echo "File upload failed.";
            exit;
        }
        
    } else {
        // If no new file is uploaded, keep the existing file name
        $unique_file_name = $row['file'];
    }

    // Construct the UPDATE query
    $update_query = "UPDATE journals SET sdrn='$sdrn', title='$title', authors='$authors', department='$department', journal='$journal', pub_date='$pub_date', issn='$issn', doi='$doi', impact_factor='$impact_factor' WHERE id='$id'";

    if (mysqli_query($conn, $update_query)) {
        // Redirect to thank you page
        header('Location: thankyou.php');
        exit;
    } else {
        // Error updating data in the database
        $error = "Error updating data in the database: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Journal Update</title>
    <style>
        body {
    background-color: #A82626;
    color: #000000;
    font-family: Arial, sans-serif;
}

.form-box {
    width: 80%;
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
textarea,
select,
input[type="file"] {
    width: 96%;
    padding: 10px;
    border: 2px solid black;
    border-radius: 5px;
    background-color: #fff;
    color: #000000;
}

input[type="submit"] {
    display: block;
    margin: 20px auto 0;
    padding: 10px 20px;
    background-color: #d63031;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #e17055;
}

    </style>
</head>
<body>
    <div class="form-box">
        <h2>Journal Update</h2>
        <form action="journalupdate.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label for="sdrn">SDRN Number:</label>
                <input type="text" value="<?php echo $result['sdrn'];?>" id="sdrn" name="sdrn" required>
            </div>
                
            <div class="form-group">
                <label for="title">Title of Paper:</label>
                <input type="text" value="<?php echo $result['title']; ?>" id="title" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="authors">Author(s):</label>
                <input type="text" value="<?php echo $result['authors'];?>" id="authors" name="authors" required>
            </div>
            
            <div class="form-group">
                <label for="department">Department:</label>
                <select id="department" name="department" required>
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
            </div>
            
            <div class="form-group">
                <label for="journal">Name of Journal:</label>
                <input type="text" value="<?php echo $result['journal']; ?>" id="journal" name="journal" required>
            </div>
            
            <div class="form-group">
                <label for="pub_date">Date of Publication:</label>
                <input type="date" value="<?php echo $result['pub_date']; ?>" id="pub_date" name="pub_date" required>
            </div>
            
            <div class="form-group">
                <label for="issn">ISSN No:</label>
                <input type="text" value="<?php echo $result['issn']; ?>" id="issn" name="issn" required>
            </div>
            
            <div class="form-group">
                <label for="doi">DOI:</label>
                <input type="text" value="<?php echo $result['doi']; ?>" id="doi" name="doi" required>
            </div>
            
            <div class="form-group">
                <label for="impact_factor">Impact Factor:</label>
                <input type="text" value="<?php echo $result['impact_factor']; ?>" id="impact_factor" name="impact_factor" required>
            </div>

            <div class="form-group">
                <label for="file">Upload File:</label>
                <input type="file" id="file" name="file">
            </div>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
