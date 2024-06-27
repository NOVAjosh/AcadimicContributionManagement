<?php
// establish database connection
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

if(!isset($_SESSION['name'])){
   header("Location: login.php");
   exit; // Add an exit to stop further script execution
}

// Get the SDRN of the logged-in user
$name = $_SESSION['name'];
$sql = "SELECT sdrn FROM users WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$user_sdrn = $row['sdrn'];
$stmt->close();

// handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieve form data
    $submitted_sdrn = $_POST['sdrn'];

    // Check if the submitted SDRN matches the user's SDRN
    if ($submitted_sdrn !== $user_sdrn) {
        echo "You can only submit patents for your own SDRN.";
        exit;
    }

    $patent_title = $_POST['patent-title'];
    $inventors = $_POST['inventors'];
    $assignee = $_POST['assignee'];
    $app_no = $_POST['app-no'];
    $department = $_POST['department'];
    $filing_date = $_POST['filing-date'];
    $pub_date = $_POST['pub-date'];
    $status = $_POST['status'];
    $file_name = $_FILES['file']['name'];

    // check if file was uploaded successfully
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Define the target directory where files will be uploaded
        $target_dir = 'Patents/';

        // Get the original file extension
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        // Create a unique file name
        $unique_file_name = $submitted_sdrn . "_" . $patent_title . "_Patent_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;
        $target_file = $target_dir . $unique_file_name;

        // move uploaded file to uploads directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            // insert data into database
            $query = "INSERT INTO patents (sdrn, patent_title, inventors, assignee, app_no, department, filing_date, pub_date, status, file) VALUES ('$submitted_sdrn', '$patent_title', '$inventors', '$assignee', '$app_no', '$department', '$filing_date', '$pub_date', '$status', '$unique_file_name')";
            if (mysqli_query($conn, $query)) {
                // redirect to thank you page
                header('Location: thank-you.php');
                exit;
            } else {
                // error inserting data into database
                $error = "Error inserting data into database: " . mysqli_error($conn);
            }
        } else {
            // error moving file
            $error = "Error moving uploaded file to directory";
        }
    } 
}

// close database connection
mysqli_close($conn);
?>




<!DOCTYPE html>
<html>
<head>
	<title>Patent Submission</title>
	<link rel="stylesheet" href="patent.css">
	<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("form").addEventListener("submit", function (e) {
                e.preventDefault(); // Prevent the form from submitting initially
                
                // Retrieve the user's SDRN from PHP
                <?php
                    echo "var userSdrn = '" . $user_sdrn . "';";
                ?>

                // Retrieve the submitted SDRN from the form
                var submittedSdrn = document.getElementById("sdrn").value;

                // Check if the submitted SDRN matches the user's SDRN
                if (submittedSdrn !== userSdrn) {
                    // Display a popup error message
                    alert("The SDRN you entered is not associated with your account.");
                } else {
                    // If SDRN matches, submit the form
                    e.target.submit();
                }
            });
        });
    </script>
</head>
<body>
	<div class="form-box">
		<h2>Patent Submission</h2>
		<form action="#" method="post" enctype="multipart/form-data">
		<div class="form-group">
				<label for="sdrn">SDRN Number:</label>
				<input type="text" id="sdrn" name="sdrn" required>
			</div>
			<div class="form-group">
				<label for="patent-title">Title of Patent:</label>
				<input type="text" id="patent-title" name="patent-title" required>
			</div>
			<div class="form-group">
				<label for="inventors">Inventor(s):</label>
				<input type="text" id="inventors" name="inventors" required>
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
				<input type="text" id="app-no" name="app-no" required>
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
				<input type="date" id="filing-date" name="filing-date" required>
			</div>
			<div class="form-group">
				<label for="pub-date">Publication Date:</label>
				<input type="date" id="pub-date" name="pub-date" required>
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
