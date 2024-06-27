<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted_sdrn = $_POST['sdrn_no'];

    // Check if the submitted SDRN matches the user's SDRN
    if ($submitted_sdrn !== $user_sdrn) {
        echo "You can only submit book chapters for your own SDRN.";
        exit;
    }

    $chapter_name = $_POST['chapter_name'];
    $author = $_POST['author'];
    $book = $_POST['book'];
    $publisher = $_POST['publisher'];
    $isbn = $_POST['isbn'];
    $doi = $_POST['doi'];
    $pub_date = $_POST['pub_date'];
    $Indexing = $_POST['Indexing'];
    $department = $_POST['department'];
    $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    // Generate the unique file name
    $unique_file_name = $submitted_sdrn . "_" . $chapter_name . "_BookChapter_" . date("m_Y", strtotime($pub_date)) . "." . $file_extension;

    $target_dir = 'book_chapters/';
    $target_file = $target_dir . $unique_file_name;
    move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

    $sql = "INSERT INTO book_chapters (sdrn_no, chapter_name, author, book, publisher, isbn, doi, pub_date, Indexing, department, file) VALUES ('$submitted_sdrn', '$chapter_name', '$author', '$book', '$publisher', '$isbn', '$doi', '$pub_date', '$Indexing', '$department', '$unique_file_name')";

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
    <title>BookChapter Form</title>
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
        <h2>BookChapter Submission</h2>
    <form action="BookChapter.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="sdrn">SDRN Number:</label>
                <input type="text" id="sdrn" name="sdrn_no">
            </div>
            <div class="form-group">
                <label for="chapter-name">Chapter Title:</label>
                <input type="text" id="chapter-name" name="chapter_name">
            </div>
            <div class="form-group">
                <label for="author">Name of Author:</label>
                <input type="text" id="author" name="author">
            </div>
            <div class="form-group">
                <label for="book">Name of Book:</label>
                <input type="text" id="book" name="book">
            </div>
            <div class="form-group">
                <label for="publisher">Name of Publisher:</label>
                <input type="text" id="publisher" name="publisher">
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
                <label for="isbn">ISBN NO:</label>
                <input type="text" id="isbn" name="isbn">
            </div>
            <div class="form-group">
                <label for="doi">DOI:</label>
                <input type="text" id="doi" name="doi">
            </div>
            <div class="form-group">
                <label for="pub_date">Date of Publication:</label>
                <input type="date" id="pub_date" name="pub_date">
            </div>
            <div class="form-group">
                <label for="Indexing">Indexing (Scopus/SCI):</label>
                <select name="Indexing" required>
                    <option value="scopus">Scopus</option>
                    <option value="sci">SCI</option>
                </select>
            </div>
            <div class="form-group">
    <label for="published-copy">Published copy of chapter:</label>
    <input type="file" id="published-copy" name="file">
</div>


<input type="submit" value="Submit">

</form>
</div>
</body>
</html>

