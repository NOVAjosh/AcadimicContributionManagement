

<?php
session_start(); // Start the session
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a SQL statement to check if the admin exists in the database
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    if ($stmt) { // Check if the prepared statement is valid
        $stmt->bind_param("s", $email); // Bind the parameter
        $stmt->execute();

        $result = $stmt->get_result();

        // Check if the admin exists in the database
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if the password matches
            if ($password == $row['password']) {
                // Password is correct, store the name in a session variable
                $_SESSION['name'] = $row['name'];

                // Redirect the admin to the dashboard page
                header("Location: admindashboard.php");
                exit();
            } else {
                // Password is incorrect, show an error message
                echo "Incorrect password";
            }
        } else {
            // Admin not found, show an error message
            echo "Admin not found";
        }

        $stmt->close(); // Close the prepared statement
    } else {
        // Handle the case where the prepared statement is invalid
        echo "An error occurred with the prepared statement.";
    }
} 

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin-Login</title>
	<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #A82626; /* Updated background color */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.login-box {
    width: 300px;
    padding: 40px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.login-box:hover {
    transform: scale(1.02);
}

.login-box h2 {
    margin: 0 0 20px;
    color: #A82626; /* Updated heading color */
    font-size: 24px;
}

.user-box {
    position: relative;
    margin-bottom: 20px;
}

.user-box input {
    width: 100%;
    padding: 10px 0;
    font-size: 16px;
    color: #A82626; /* Updated input text color */
    border: none;
    border-bottom: 1px solid #A82626; /* Updated input border color */
    background: transparent;
    outline: none;
    transition: border-color 0.3s;
}

.user-box label {
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px 0;
    font-size: 16px;
    color: #888;
    pointer-events: none;
    transition: 0.5s;
    transform-origin: left bottom;
}

.user-box input:focus ~ label,
.user-box input:valid ~ label {
    top: -20px;
    font-size: 12px;
    
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #A82626; /* Updated button background color */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #850000; /* Updated button background color on hover */
}


    

</style>
</head>
<body>
	<div class="login-box">
		<h2 style="color:black;">Admin-Login</h2>
		<form action="adminlogin.php" method="post">
			<div class="user-box">
				<input type="text" name="email" required="">
				<label>Email</label>
			</div>
			<div class="user-box">
				<input type="password" name="password" required="">
				<label>Password</label>
			</div>
			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>

