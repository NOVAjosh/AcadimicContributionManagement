<?php
session_start();

if(!isset($_SESSION['name'])){
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Thank You!</title>
	<link rel="stylesheet" href="thank-you.css">
</head>
<body>
	<div class="container">
		<h1>Thank You!</h1>
		<p>Your file has been uploaded successfully.</p>
		<a href="dashboard.php">Go back to dashboard</a>
	</div>
</body>
</html>