<?php
// establish database connection
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

if (!isset($_SESSION['name'])) {
   header("Location: login.php");
   exit;
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
        echo "You can only upload files for your own SDRN.";
        exit;
    }

    $title = $_POST['title'];
    $author = $_POST['author'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $abstract = $_POST['abstract'];
    $area = $_POST['area'];
    $department = $_POST['department'];
    $file_name = $_FILES['file']['name'];
    $pub_date = $_POST['pub_date'];

    // Define the target directory where files will be uploaded
   
$target_dir = "papers/";

// Get the original file extension
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

// Create a unique file name
$unique_file_name = $user_sdrn . "_" . $title . "_Researchpaper_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;
$target_file = $target_dir . $unique_file_name;

// move uploaded file to uploads directory
move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

// insert data into the database using prepared statement
$query = "INSERT INTO papers (sdrn, title, author, email, phone, abstract, area, department, file, pub_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssssss", $user_sdrn, $title, $author, $email, $phone, $abstract, $area, $department, $unique_file_name, $pub_date);
$stmt->execute();
$stmt->close();

    // redirect to thank you page
    header('Location: thank-you.php');
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Research Paper Submission</title>
	<link rel="stylesheet" href="research.css">
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
		<h2>Research Paper Submission</h2>
		<form action="Researchpaper.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="sdrn">SDRN Number:</label>
				<input type="text" id="sdrn" name="sdrn" required>
			</div>
			<div class="form-group">
				<label for="title">Paper Title:</label>
				<input type="text" id="title" name="title" required>
			</div>
			<div class="form-group">
				<label for="author">Author:</label>
				<input type="text" id="author" name="author" required>
			</div>
			<div class="form-group">
				<label for="pub_date">Registration Date:</label>
				<input type="date" id="pub_date" name="pub_date" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" id="email" name="email" required>
			</div>
			<div class="form-group">
				<label for="phone">Phone Number:</label>
				<input type="tel" id="phone" name="phone" required>
			</div>
			<div class="form-group">
				<label for="abstract">Abstract:</label>
				<textarea id="abstract" name="abstract" required></textarea>
			</div>
			<div class="form-group">
				<label for="area">Research Paper Area:</label>
				<select id="area" name="area" required>
					<option value="">-- Select an option --</option>
					<option value="Artificial Intelligence">Artificial Intelligence</option>
					<option value="Data Science">Data Science</option>
					<option value="Software Engineering">Software Engineering</option>
					<!-- Add more options here -->
				</select>
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
				<label for="file">Attach Research Paper:</label>
				<input type="file" id="file" name="file" required>
			</div>
			<input type="submit" value="Submit">
		</form>
	</div>
</body>
</html>
