<?php
session_start(); // Start the session

include "dbconn.php";

if (isset($_POST['sdrn']) && isset($_POST['password'])) {
    $sdrn = $_POST['sdrn'];
    $password = $_POST['password'];

    // Prepare a SQL statement to check if the user exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE sdrn = ?");
    $stmt->bind_param("s", $sdrn); // Bind the parameter
    $stmt->execute();

    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the entered password against the stored hashed password
       if($password === $row['password']) {
            // Password is correct, store the name in a session variable
            $_SESSION['name'] = $row['name'];

            // Redirect the user to the dashboard page
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect, show an error message
            echo "<script>alert('Incorrect password')</script>";
        }
    } else {
        // User not found, show an error message
        echo "<script>alert('User not found')</script>";
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close(); // Close the database connection
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

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
        <h2 style="color:black;">User Login</h2>
        <form action="login.php" method="post">
            <div class="user-box">
                <input type="text" name="sdrn" required="">
                <label>SDRN Number</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required = "" >
                <label>Password</label>
            </div>
            <input type="submit" value="Submit">
            <p>
            <?php
    if(isset($_GET["reset"])){
        if($_GET["reset"] == "success"){
            echo '<p class="signupsuccess">Password changed successfully</p>' ;
        }
    }


?>
                <a href="reset-password.php">Forgot Password</a>
            </p>
        </form>
    </div>
</body>
</html>
