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
$sql = "SELECT * FROM books WHERE id = '$id'";
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
    $topic = $_POST['topic'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $book_type = $_POST['type'];
    $indexing = $_POST['indexing'];
    $issn_no = $_POST['issn_no'];
    $pub_date = $_POST['pub_date'];
    $weblink = $_POST['weblink'];
    $department = $_POST['department'];

    // Check if a new file is uploaded
    if (!empty($_FILES['file']['name'])) {
        // Define the target directory where files will be uploaded
        $target_dir = "Books/";

        // Get the original file extension
        $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // Create a unique file name
        // Create a unique file name
        $unique_file_name = $sdrn . "_" . $topic . "_Book_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;
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
        $unique_file_name = $result['file'];
    }

    // Construct the UPDATE query
    $update_query = "UPDATE books SET sdrn_no='$sdrn', topic='$topic', author='$author', publisher='$publisher', book_type='$book_type', indexing='$indexing', issn_no='$issn_no', pub_date='$pub_date', weblink='$weblink', department='$department', file='$unique_file_name' WHERE id='$id'";

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
    <title>Book Update</title>
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
        <h2>Book Update</h2>
        <form action="BookUpdate.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="sdrn_no">SDRN Number:</label>
                <input type="text" value="<?php echo $result['sdrn_no']; ?>" id="sdrn_no" name="sdrn_no" required>
            </div>

            <div class="form-group">
                <label for="topic">Book Title</label>
                <input type="text" value="<?php echo $result['topic']; ?>" id="topic" name="topic" required>
            </div>

            <div class="form-group">
                <label for="author">Author Name</label>
                <input type="text" value="<?php echo $result['author']; ?>" id="author" name="author" required>
            </div>

            <div class="form-group">
                <label for="publisher">Publisher</label>
                <input type="text" value="<?php echo $result['publisher']; ?>" id="publisher" name="publisher" required>
            </div>

            <div class="form-group">
                <label for="type">Book Type (Authored/Edited):</label>
                <select name="type" required>
                    <option value="authored" <?php if ($result['book_type'] === 'authored') echo 'selected'; ?>>Authored</option>
                    <option value="edited" <?php if ($result['book_type'] === 'edited') echo 'selected'; ?>>Edited</option>
                </select>
            </div>

            <div class="form-group">
                <label for="indexing">Indexing (Scopus/SCI):</label>
                <select name="indexing" required>
                    <option value="scopus" <?php if ($result['indexing'] === 'scopus') echo 'selected'; ?>>Scopus</option>
                    <option value="sci" <?php if ($result['indexing'] === 'sci') echo 'selected'; ?>>SCI</option>
                </select>
            </div>

            <div class="form-group">
                <label for="issn_no">ISSN No:</label>
                <input type="text" value="<?php echo $result['issn_no']; ?>" id="issn_no" name="issn_no">
            </div>

            <div class="form-group">
                <label for="pub_date">Date of Publishing:</label>
                <input type="date" value="<?php echo $result['pub_date']; ?>" id="pub_date" name="pub_date" required>
            </div>

            <div class="form-group">
                <label for="weblink">Web Link:</label>
                <input type="url" value="<?php echo $result['weblink']; ?>" id="weblink" name="weblink" required>
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <select id="department" name="department" required>
                    <option value="">-- Select an option --</option>
                    <option value="Computer Engineering" <?php if ($result['department'] === 'Computer Engineering') echo 'selected'; ?>>Computer Engineering</option>
                    <option value="Computer Sciences & Business Systems" <?php if ($result['department'] === 'Computer Sciences & Business Systems') echo 'selected'; ?>>Computer Sciences & Business Systems</option>
                    <option value="Information Technology" <?php if ($result['department'] === 'Information Technology') echo 'selected'; ?>>Information Technology</option>
                    <option value="Electronics & Computer Engineering" <?php if ($result['department'] === 'Electronics & Computer Engineering') echo 'selected'; ?>>Electronics & Computer Engineering</option>
                    <option value="Instrumentation Engineering" <?php if ($result['department'] === 'Instrumentation Engineering') echo 'selected'; ?>>Instrumentation Engineering</option>
                    <option value="Artificial Intelligence & Data Science" <?php if ($result['department'] === 'Artificial Intelligence & Data Science') echo 'selected'; ?>>Artificial Intelligence & Data Science</option>
                    <option value="Electronics Engineering" <?php if ($result['department'] === 'Electronics Engineering') echo 'selected'; ?>>Electronics Engineering</option>
                    <option value="Electronics & Telecommunication Engineering" <?php if ($result['department'] === 'Electronics & Telecommunication Engineering') echo 'selected'; ?>>Electronics & Telecommunication Engineering</option>
                    <option value="Electrical & Instrumentation Engineering" <?php if ($result['department'] === 'Electrical & Instrumentation Engineering') echo 'selected'; ?>>Electrical & Instrumentation Engineering</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">Proof of Publication:</label>
                <input type="file" id="file" name="file">
            </div>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
