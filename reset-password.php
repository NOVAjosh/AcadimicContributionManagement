<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Reset Password</title>
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
		<h2>Reset Password</h2>
		<form action="reset_password_code.php" method="POST">
        
			
			<div class="user-box">
				<input type="email" name="email" required>
				<label>Email Id</label>
			</div>
			
			<input type="submit" name="password_reset_link" value="Password Reset Link">
		</form>

        <?php
    if(isset($_GET["reset"])){
        if($_GET["reset"] == "success"){
            echo '<p class="signupsuccess">Check your email</p>' ;
        }
    }


?>
	</div>
</body>
</html>
