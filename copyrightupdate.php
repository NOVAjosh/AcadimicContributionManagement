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

// Retrieve data for the given ID
$sql = "SELECT * FROM copyright WHERE id = '$id'";
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
    $sdrn = $_POST['sdrn_no'];
    $department = $_POST['Dept'];
    $title = $_POST['title'];
    $pub_date = $_POST['pub_date'];

    // Check if a new copyright material file is uploaded
    if (!empty($_FILES['copyright_material']['name'])) {
        // Define the target directory where files will be uploaded
        $target_dir = "Copyright/";

        // Get the original file extension
        $file_extension = pathinfo($_FILES['copyright_material']['name'], PATHINFO_EXTENSION);

        // Create a unique file name for copyright material
        $unique_file_name_material = $sdrn . "_" . $title . "_CopyrightMaterial_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;
        $target_file_material = $target_dir . $unique_file_name_material;

        // Move uploaded copyright material file to the target directory
        if (move_uploaded_file($_FILES['copyright_material']['tmp_name'], $target_file_material)) {
            // File moved successfully
        } else {
            // Handle copyright material file upload error
            echo "Copyright Material file upload failed.";
            exit;
        }
    } else {
        // If no new copyright material file is uploaded, keep the existing file name
        $unique_file_name_material = $result['copyright_material'];
    }

    // Check if a new copyright certificate file is uploaded
    if (!empty($_FILES['copyright_certificate']['name'])) {
        // Define the target directory where files will be uploaded
        $target_dir = "copyright/";

        // Get the original file extension
        $file_extension = pathinfo($_FILES['copyright_certificate']['name'], PATHINFO_EXTENSION);

        // Create a unique file name for copyright certificate
        $unique_file_name_certificate = $sdrn . "_" . $title . "_CopyrightCertificate_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;
        $target_file_certificate = $target_dir . $unique_file_name_certificate;

        // Move uploaded copyright certificate file to the target directory
        if (move_uploaded_file($_FILES['copyright_certificate']['tmp_name'], $target_file_certificate)) {
            // File moved successfully
        } else {
            // Handle copyright certificate file upload error
            echo "Copyright Certificate file upload failed.";
            exit;
        }
    } else {
        // If no new copyright certificate file is uploaded, keep the existing file name
        $unique_file_name_certificate = $result['copyright_certificate'];
    }

    // Construct the UPDATE query
    $update_query = "UPDATE copyright SET sdrn_no='$sdrn', department='$department', title='$title', pub_date='$pub_date', copyright_material='$unique_file_name_material', copyright_certificate='$unique_file_name_certificate' WHERE id='$id'";

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
    <title>Copyright Update</title>
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
    <h2>Copyright Update</h2>
    <form action="copyrightupdate.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="sdrn_no">SDRN Number:</label>
            <input type="text" value="<?php echo $result['sdrn_no']; ?>" id="sdrn_no" name="sdrn_no" required>
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
            <input type="text" value="<?php echo $result['title']; ?>" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="pub_date">Registration Date:</label>
            <input type="date" value="<?php echo $result['pub_date']; ?>" id="pub_date" name="pub_date" required>
        </div>

        <div class="form-group">
            <label for="copyright_material">Copyright Material:</label>
            <input type="file" id="copyright_material" name="copyright_material">
        </div>

        <div class="form-group">
            <label for="copyright_certificate">Copyright Certificate:</label>
            <input type="file" id="copyright_certificate" name="copyright_certificate">
        </div>

        <input type="submit" value="Update">
    </form>
</div>
</body>
</html>
