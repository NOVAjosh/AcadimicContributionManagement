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
$sql = "SELECT * FROM patents WHERE id = '$id'";
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
    $patent_title = $_POST['patent-title'];
    $inventors = $_POST['inventors'];
    $assignee = $_POST['assignee'];
    $app_no = $_POST['app-no'];
    $department = $_POST['department'];
    $filing_date = $_POST['filing-date'];
    $pub_date = $_POST['pub-date'];
    $status = $_POST['status'];

	 // Check if a new file is uploaded
	 if (!empty($_FILES['file']['name'])) {
        // Define the target directory where files will be uploaded
        $target_dir = "Patents/";

        // Get the original file extension
        $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

       // Create a unique file name
       $unique_file_name = $sdrn . "_" . $patent_title . "_Patent_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;
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
    $update_query = "UPDATE patents SET sdrn='$sdrn', patent_title='$patent_title', inventors='$inventors', assignee='$assignee', app_no='$app_no', department='$department', filing_date='$filing_date', pub_date='$pub_date', status='$status' WHERE id='$id'";

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
	<title>Patent Update</title>
	<link rel="stylesheet" href="patent.css">
</head>
<body>
	<div class="form-box">
		<h2>Patent Update</h2>
		<form action="patentupdate.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
				<label for="sdrn">SDRN Number:</label>
				<input type="text"  value="<?php echo $result['sdrn'];?>" id="sdrn" name="sdrn" required>
			</div>
				
			<div class="form-group">
    <label for="patent-title">Title of Patent:</label>
    <input type="text" value="<?php echo $result['patent_title']; ?>" id="patent-title" name="patent-title" required>
</div>
			<div class="form-group">
				<label for="inventors">Inventor(s):</label>
				<input type="text" value="<?php echo $result['inventors'];?>" id="inventors" name="inventors" required>
			</div>
			
			<div class="form-group">
				<label for="assignee">Assignee:</label>
				<select id="assignee" name="assignee" required>
					<option value="">-- Select an option --</option>
					<option value="India">India</option>
					<option value="Overseas">Overseas</option>
					
				</select>
			</div>
			<div class="form-group">
    <label for="app-no">Application Number:</label>
    <input type="text" value="<?php echo $result['app_no']; ?>" id="app-no" name="app-no" required>
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
    <label for="filing-date">Filing Date:</label>
    <input type="date" value="<?php echo $result['filing_date']; ?>" id="filing-date" name="filing-date" required>
</div>
<div class="form-group">
    <label for="pub-date">Publication Date:</label>
    <input type="date" value="<?php echo $result['pub_date']; ?>" id="pub-date" name="pub-date" required>
</div>
			<div class="form-group">
				<label for="status">Status:</label>
				<select id="status" name="status" required>
					<option value="">-- Select an option --</option>
					<option value="Filed">Filed</option>
					<option value="Published">Published</option>
					<option value="Granted">Granted</option>
				</select>
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
