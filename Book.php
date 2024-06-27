<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $submitted_sdrn = isset($_POST['sdrn_no']) ? intval($_POST['sdrn_no']) : 0;

    

    $topic = isset($_POST['topic']) ? $conn->real_escape_string($_POST['topic']) : '';
    $author = isset($_POST['author']) ? $conn->real_escape_string($_POST['author']) : '';
    $publisher = isset($_POST['publisher']) ? $conn->real_escape_string($_POST['publisher']) : '';
    $book_type = isset($_POST['type']) ? $conn->real_escape_string($_POST['type']) : '';
    $indexing = isset($_POST['indexing']) ? $conn->real_escape_string($_POST['indexing']) : '';
    $issn_no = isset($_POST['issn_no']) ? $conn->real_escape_string($_POST['issn_no']) : '';
    $pub_date = isset($_POST['pub_date']) ? $conn->real_escape_string($_POST['pub_date']) : '';
    $weblink = isset($_POST['weblink']) ? $conn->real_escape_string($_POST['weblink']) : '';
    $department = isset($_POST['department']) ? $conn->real_escape_string($_POST['department']) : '';
    $file = isset($_FILES['file']) ? $_FILES['file'] : '';

	if (isset($_FILES['file'])) {
		$file_name = $_FILES['file']['name'];
		$file_tmp_name = $_FILES['file']['tmp_name'];
		$file_size = $_FILES['file']['size'];
		$file_type = $_FILES['file']['type'];
		$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
	
		if ($file_ext !== 'pdf') {
			echo "Error: Only PDF files are allowed.";
			exit();
		}
	
		$upload_dir = "Books/";
	
		// Generate new file name with SDRN_Book_Month_Year format
		$new_file_name = $submitted_sdrn . "_" . $topic . "_Book_" . date("m_Y", strtotime($pub_date)) . "." . $file_ext;
		$upload_path = $upload_dir . $new_file_name;
	
		if (move_uploaded_file($file_tmp_name, $upload_path)) {
			// File uploaded successfully
		} else {
			echo "Error: File upload failed.";
			exit();
		}
	} else {
		$new_file_name = null;
	}

    $sql = "INSERT INTO books (sdrn_no, topic, author, publisher, book_type, indexing, issn_no, pub_date, weblink, department, file)
            VALUES ('$submitted_sdrn', '$topic', '$author', '$publisher', '$book_type', '$indexing', '$issn_no', '$pub_date', '$weblink', '$department', '$new_file_name')";

    if ($conn->query($sql) === TRUE) {
        header('Location: thank-you.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
	<title>Book Form</title>
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
		<h2>Book Submission</h2>
    <form action="Book.php" method="post" enctype="multipart/form-data">

	
<div class="form-group">
    <label for="sdrn">SDRN Number:</label>
    <input type="text" id="sdrn" name="sdrn_no" required>
</div>

			
			<div class="form-group">
				<label for="topic">Book Title</label>
				<input type="text" id="topic" name="topic" required>
			</div>

			<div class="form-group">
				<label for="author">Author Name</label>
				<input type="text" id="author" name="author" required>
			</div>
			
			<div class="form-group">
				<label for="name">Publisher</label>
				<input type="text"  name="publisher" required>
			</div>
			
			<div class="form-group">
			<label for="type">Book Type (Authored/Edited):</label>
        	<select name="type" required>
            <option value="authored">Authored</option>
            <option value="edited">Edited</option>
        	</select><br>
			</div>


			<div class="form-group">
			<label for="indexing">Indexing (Scopus/SCI):</label>
        	<select name="indexing" required>
            <option value="scopus">Scopus</option>
            <option value="sci">SCI</option>
        	</select><br>
			</div>

			<div class="form-group">
				<label for="issn_no">ISSN No:</label>
				<input type="text" id="issn_no" name="issn_no">
			</div>
			
			<div class="form-group">
			<label for="pub_date">Date of Publishing:</label>
        	<input type="date" name="pub_date" required><br>
			</div>

            <div class="form-group">
			<label for="weblink">Web Link:</label>
        	<input type="url" name="weblink" required><br>
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
   		 	<label for="file">Proof of Publication</label>
    		<input type="file" id="file" name="file">
			</div>
			<input type="submit" value="Submit">
		</form>
	</div>
    </body>
    </html>