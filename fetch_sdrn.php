<?php
// fetch_sdrn.php
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['name'])){
    $name = $conn->real_escape_string($_GET['name']);
    
    $query = "SELECT sdrn_no FROM users WHERE name = '$name'"; // Modify table name accordingly
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['sdrn_no'];
    } else {
        echo "SDRN not found";
    }
}

$conn->close();
?>
