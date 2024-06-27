<?php
// Establish database connection
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

// Check if the research paper ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: researchpapers.php");
    exit;
}

$research_paper_id = $_GET['id'];

// Retrieve the existing research paper data
$sql = "SELECT * FROM papers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $research_paper_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Check if the research paper exists and belongs to the logged-in user
if (!$row || $row['sdrn'] !== $user_sdrn) {
    header("Location: researchpapers.php");
    exit;
}

// Handle research paper update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $abstract = $_POST['abstract'];
    $area = $_POST['area'];
    $department = $_POST['department'];
    $pub_date = $_POST['pub_date'];

    // Check if a new file is uploaded
    if (!empty($_FILES['file']['name'])) {
        // Define the target directory where files will be uploaded
        $target_dir = "papers/";

        // Get the original file extension
        $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // Create a unique file name
        $unique_file_name = $user_sdrn . "_" . $title . "_Researchpaper_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;
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

    // Update data in the database using prepared statement
    $query = "UPDATE papers SET title=?, author=?, email=?, phone=?, abstract=?, area=?, department=?, file=?, pub_date=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssi", $title, $author, $email, $phone, $abstract, $area, $department, $unique_file_name, $pub_date, $research_paper_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to the research papers page after update
    header('Location: thankyou.php');
    exit;
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Research Paper Update</title>
    <link rel="stylesheet" href="research.css">
</head>
<body>
    <div class="form-box">
        <h2>Update Research Paper</h2>
        <form action="Researchpaperupdate.php?id=<?php echo $research_paper_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Paper Title:</label>
                <input type="text" id="title" name="title" required value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required value="<?php echo $row['author']; ?>">
            </div>
            <div class="form-group">
                <label for="pub_date">Registration Date:</label>
                <input type="date" id="pub_date" name="pub_date" required value="<?php echo $row['pub_date']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required value="<?php echo $row['phone']; ?>">
            </div>
            <div class="form-group">
                <label for="abstract">Abstract:</label>
                <textarea id="abstract" name="abstract" required><?php echo $row['abstract']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="area">Research Paper Area:</label>
                <select id="area" name="area" required>
                    <option value="">-- Select an option --</option>
                    <option value="Artificial Intelligence" <?php if ($row['area'] == 'Artificial Intelligence') echo 'selected'; ?>>Artificial Intelligence</option>
                    <option value="Data Science" <?php if ($row['area'] == 'Data Science') echo 'selected'; ?>>Data Science</option>
                    <option value="Software Engineering" <?php if ($row['area'] == 'Software Engineering') echo 'selected'; ?>>Software Engineering</option>
                    <!-- Add more options here -->
                </select>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <select id="department" name="department" required>
                    <option value="">-- Select an option --</option>
                    <option value="Computer Engineering" <?php if ($row['department'] == 'Computer Engineering') echo 'selected'; ?>>Computer Engineering</option>
                    <option value="Computer Sciences & Business Systems" <?php if ($row['department'] == 'Computer Sciences & Business Systems') echo 'selected'; ?>>Computer Sciences & Business Systems</option>
                    <option value="Information Technology" <?php if ($row['department'] == 'Information Technology') echo 'selected'; ?>>Information Technology</option>
                    <!-- Add more options here -->
                </select>
            </div>
            <div class="form-group">
                <label for="file">Attach Research Paper:</label>
                <input type="file" id="file" name="file">
            </div>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
