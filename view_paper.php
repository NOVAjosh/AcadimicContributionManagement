<?php
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
$conn = new mysqli($servername, $username, $password, $dbname);

// Get the paper ID from the query parameter
if (isset($_GET['id'])) {
    $paperId = $_GET['id'];

    // Execute a SELECT query to retrieve the paper details
    $sql = "SELECT * FROM papers WHERE id = $paperId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $paper = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Paper Details</title>
    
</head>
<body>
    <h1>Paper Details</h1>
    <h2><?php echo $paper['title']; ?></h2>
    <p><strong>Author:</strong> <?php echo $paper['author']; ?></p>
    <p><strong>Email:</strong> <?php echo $paper['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $paper['phone']; ?></p>
    <p><strong>Abstract:</strong> <?php echo $paper['abstract']; ?></p>
    <p><strong>Area:</strong> <?php echo $paper['area']; ?></p>
    <p><strong>Department:</strong> <?php echo $paper['department']; ?></p>
    <p><strong>File:</strong> <a href="papers/<?php echo $paper['file']; ?>" target="_blank">Download File</a></p>
</body>
</html>

<?php
    } else {
        echo "<p>No paper found with the provided ID.</p>";
    }
} else {
    echo "<p>Invalid request. Paper ID not provided.</p>";
}
?>
