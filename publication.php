<?php
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

if(!isset($_SESSION['name'])){
   header("Location: login.php");
}

// handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieve form data
	$sdrn = $_POST['sdrn'];
    $category = $_POST['category'];
	$department = $_POST['department'];
    $title = $_POST['title'];
    $journal = $_POST['journal'];
    $year = $_POST['year'];
    $author = $_POST['author'];
    $url = $_POST['url'];
    $doi = $_POST['doi'];
    $volume = $_POST['volume'];
    $page = $_POST['page'];
    $editor = $_POST['editor'];
    $publisher = $_POST['publisher'];

    // insert data into database
    $query = "INSERT INTO publications (sdrn,category,department, title, journal, year, author, url, doi, volume, page, editor, publisher) VALUES ('$sdrn','$category', '$department','$title', '$journal', '$year', '$author', '$url', '$doi', '$volume', '$page', '$editor', '$publisher')";
    mysqli_query($conn, $query);

    // redirect to thank you page
    header('Location: thank-you.php');
    exit;
}

// close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Publication Form</title>
	<link rel="stylesheet" href="publication.css">
</head>
<body>
	<div class="container">
		<h2>Publication Form</h2>
		<form action="publication.php" method="post">
		<div class="form-group">
				<label for="sdrn">SDRN Number:</label>
				<input type="text" id="sdrn" name="sdrn" required>
			</div>
			<label for="category">Work/Type:</label>
			<select id="category" name="category">
				<option value="Conference paper">Conference paper</option>
				<option value="Short survey">Short survey</option>
				<option value="Article">Article</option>
			</select>
			<label for="department">Deptartment:</label>
			<select id="department" name="department">
				<option value="Computer Engineering">Computer Engineering</option>
				<option value="Computer Science and Business Systems">Computer Science and Business Systems</option>
				<option value="Information Technology">Information Technology</option>
				<option value="Electronics &amp; Computer Engineering">Electronics &amp; Computer Engineering</option>
			</select>
			<label for="title">Title/Chapter:</label>
			<input type="text" id="title" name="title" required="">
			<label for="journal">Journal/Book title:</label>
			<input type="text" id="journal" name="journal" required="">
			<label for="year">Year:</label>
			<input type="number" id="year" name="year" required="">
			<label for="author">Author:</label>
			<input type="text" id="author" name="author" required="">
			<label for="url">URL:</label>
				<input type="text" id="url" name="url">
			<label for="doi">DOI:</label>
				<input type="text" id="doi" name="doi">
			<label for="volume">Volume:</label>
				<input type="text" id="volume" name="volume">
			<label for="page">Page No:</label>
				<input type="text" id="page" name="page">
			<label for="editor">Editor:</label>
				<input type="text" id="editor" name="editor">
			<label for="publisher">Publisher:</label>
				<input type="text" id="publisher" name="publisher">
			<input type="submit" value="Submit">
		</form>
	</div>
</body>
</html>

