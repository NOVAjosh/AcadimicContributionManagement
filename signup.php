<?php
include "dbconn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data if the form is submitted
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $sdrn = isset($_POST['sdrn']) ? $_POST['sdrn'] : '';

    // Escape the data to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $sdrn = mysqli_real_escape_string($conn, $sdrn);

    // Check if there is an existing user with the same details (except password)
    $checkSql = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone' OR sdrn = '$sdrn'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo '<script>alert("User with similar details already exists. Signup denied.");</script>';
    } else {
        // SQL query to insert data into the status table
        $statusSql = "INSERT INTO status (sdrn, name, email, phone, password, status_approval) 
                      VALUES ('$sdrn', '$name', '$email', '$phone', '$password', 'Pending')";

        if (mysqli_query($conn, $statusSql)) {
            // Redirect to index.php
            echo '<script>alert("Sign up is pending. Wait for Admin to accept the request."); window.location.href = "index.php";</script>';
            exit;
        } else {
            echo "Error: " . $statusSql . "<br>" . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
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
		<h2>Sign Up</h2>
		<form action="signup.php" method="POST">
        <div class="user-box">
				<input type="tel" name="sdrn" required>
				<label>SDRN NO</label>
			</div>
			<div class="user-box">
				<input type="text" name="name" required>
				<label>Name</label>
			</div>
			<div class="user-box">
				<input type="email" name="email" required>
				<label>Email Id</label>
			</div>
			<div class="user-box">
				<input type="tel" name="phone" required>
				<label>Phone No</label>
			</div>
			<div class="user-box">
				<input type="password" name="password" required>
				<label>Password</label>
			</div>
			<input type="submit" value="Sign Up">
		</form>
	</div>
</body>
</html>
