<?php
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";

$conn = new mysqli($servername, $username, $password, $dbname);

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

// handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieve form data
    $submitted_sdrn = $_POST['sdrn_no'];

    // Check if the submitted SDRN matches the user's SDRN
    if ($submitted_sdrn !== $user_sdrn) {
        echo "You can only submit copyright materials for your own SDRN.";
        exit;
    }

    $department = $_POST['Dept']; // Changed from 'department'
    $title = $_POST['title'];
    $pub_date = $_POST['pub_date'];
    $file_extension_material = pathinfo($_FILES['copyright_material']['name'], PATHINFO_EXTENSION);
    $file_extension_certificate = pathinfo($_FILES['copyright_certificate']['name'], PATHINFO_EXTENSION);

    // Generate unique file names
    $unique_file_name_material = $submitted_sdrn . "_" . $title . "_CopyrightMaterial_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension_material;
    $unique_file_name_certificate = $submitted_sdrn . "_" . $title . "_CopyrightCertificate_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension_certificate;

    // Define target directories
    $target_dir = 'copyright/';
    $target_file_material = $target_dir . $unique_file_name_material;
    $target_file_certificate = $target_dir . $unique_file_name_certificate;

    if (move_uploaded_file($_FILES['copyright_material']['tmp_name'], $target_file_material) &&
        move_uploaded_file($_FILES['copyright_certificate']['tmp_name'], $target_file_certificate)) {

        // insert data into database
        $query = "INSERT INTO `copyright` (`sdrn_no`, `department`, `title`, `pub_date`, `copyright_material`, `copyright_certificate`) VALUES ('$submitted_sdrn', '$department', '$title', '$pub_date', '$unique_file_name_material', '$unique_file_name_certificate')";
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

// close database connection
mysqli_close($conn);
?>



<!DOCTYPE html>
<html>
<head>
	<title>Copyright Submission</title>
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
            // Retrieve the user's SDRN from PHP
            <?php
                echo "var userSdrn = '" . $user_sdrn . "';";
            ?>

            // Retrieve the submitted SDRN from the form
            var submittedSdrn = document.getElementById("sdrn_no").value;

            // Check if the submitted SDRN matches the user's SDRN
            if (submittedSdrn !== userSdrn) {
                // Display a popup error message
                alert("The SDRN you entered is not associated with your account.");
                e.preventDefault(); // Prevent form submission
            }
        });
    });
</script>

</head>
<body>
	<div class="form-box">
		<h2>Copyright Submission</h2>
		<form action="#" method="post" enctype="multipart/form-data">
		<div class="form-group">
				<label for="sdrn_no">SDRN Number:</label>
				<input type="text" id="sdrn_no" name="sdrn_no" required>
			</div>
			<div class="form-group">
				<label for="Dept">Department:</label>
				<select id="Dept" name="Dept" required>
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
				<label for="title">Title of Copyright:</label>
				<input type="text" id="title" name="title" required>
			</div>

			
			<div class="form-group">
				<label for="pub_date">Registration Date:</label>
				<input type="date" id="pub_date" name="pub_date" required>
			</div>
			
			<div class="form-group">
				<label for="copyright_material">Copyright Material:</label>
				<input type="file" id="copyright_material" name="copyright_material" required>
			</div>
			
			<div class="form-group">
    <label for="copyright_certificate">Copyright Certificate:</label>
    <input type="file" id="copyright_certificate" name="copyright_certificate">
</div>

			<input type="submit" value="submit">
		</form>
	</div>
</body>
</html>
