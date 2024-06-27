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

// handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieve form data
    $submitted_sdrn = $_POST['sdrn'];

    // Check if the submitted SDRN matches the user's SDRN
    if ($submitted_sdrn !== $user_sdrn) {
        echo "You can only submit conference details for your own SDRN.";
        exit;
    }

    $topic = $_POST['topic'];
    $issn = $_POST['issn'];
    $pub_date = $_POST['pub_date'];
    $doi = $_POST['doi'];
    $indexing = $_POST['indexing'];
    $url = $_POST['url'];
    $file = $_FILES['file'];
    $department = $_POST['department'];

    // check if file is uploaded
    if ($file['error'] == UPLOAD_ERR_OK) {
        // set upload directory
        $uploadDir = 'conference/';

        // get file name and extension
        $fileName = basename($file['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // generate new file name with SDRN_Conference_Month_Year format
        $newFileName = $submitted_sdrn . "_" . $topic . "_ConferencePaper_" . date("m_Y", strtotime($pub_date)) . "." . $fileExt;

        // move file to upload directory
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $newFileName)) {
            // insert data into database
            $query = "INSERT INTO conference (sdrn, topic, issn, pub_date, doi, indexing, url, file, department) VALUES ('$submitted_sdrn', '$topic', '$issn', '$pub_date', '$doi', '$indexing', '$url', '$newFileName', '$department')";
            mysqli_query($conn, $query);

            // redirect to thank you page
            header('Location: thank-you.php');
            exit;
        }
    }
}

// close database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Conference Paper Form</title>
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
		<h2>ConfrencePaper Submission</h2>
    <form action="Conference.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="sdrn">SDRN Number:</label>
				<input type="text" id="sdrn" name="sdrn" required>
			</div>
			
			<div class="form-group">
                <label for="department">Department:</label>
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
            </div>

			<div class="form-group">
				<label for="topic">Topic:</label>
				<input type="text" id="topic" name="topic" required>
			</div>

			<div class="form-group">
				<label for="pub_date">Date of Publication:</label>
				<input type="date" id="pub_date" name="pub_date" required>
			</div>

			<div class="form-group">
				<label for="issn">ISSN No:</label>
				<input type="text" id="issn" name="issn" required>
			</div>

			<div class="form-group">
				<label for="doi">DOI:</label>
				<input type="text" id="doi" name="doi" required>
			</div>

			<div class="form-group">
			<label for="indexing">Indexing (Scopus/SCI):</label>
        	<select name="indexing" required>
            <option value="scopus">Scopus</option>
            <option value="sci">SCI</option>
        	</select><br>
			</div>

			<div class="form-group">
				<label for="url">Link to publication:</label>
				<input type="url" id="url" name="url" required>
			</div>
			
			<div class="form-group">
                <label for="file">File:</label>
                 <input type="file" id="file" name="file" required>
             </div>



			<input type="submit" value="Submit">
		</form>
	</div>
</body>
</html>
