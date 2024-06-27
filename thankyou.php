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
		<p>Great! Your file is Updated. Please refresh the dashboard page to see it.</p>
	</div>
</body>
</html>