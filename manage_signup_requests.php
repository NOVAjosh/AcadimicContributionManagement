<?php
include('dbconn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\Users\ROHIT\OneDrive\Desktop\Hosted\durga\vendor\autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['logout'])) {
        // Clear session data and destroy session
        session_start();
        session_destroy();
        header("Location: index.php"); // Redirect to the login page after logout
        exit;
    }

    // Perform the action based on the button clicked
    if (isset($_POST['action']) && isset($_POST['id'])) {
        $action = $_POST['action'];
        $id = $_POST['id'];

        if ($action === "accept") {
            // Get data from the status table based on the provided ID
            $query = "SELECT * FROM status WHERE id = $id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $user_email = $row['email'];

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'researchX.rait@gmail.com'; // Replace with your Gmail address
                $mail->Password = 'ssjoyyoihuwwwpzi'; // Replace with your Gmail password
                $mail->SMTPSecure = 'tls'; // Use 'tls' instead of 'ssl'
                $mail->Port = 587;

                $mail->setFrom('researchX.rait@gmail.com', 'ResearchX'); // Replace with your name and email address

                $mail->isHTML(true);
                $mail->Subject = "Authentication";
                $mail->Body = '<p>Your account has been verified for login.</p>';
                $mail->addAddress($user_email);
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            $insertQuery = "INSERT INTO users (name, email, phone, password, sdrn) 
            VALUES ('{$row['name']}', '{$row['email']}', '{$row['phone']}', '{$row['password']}', '{$row['sdrn']}')";


            if (mysqli_query($conn, $insertQuery)) {
                // Delete the record from the status table
                $deleteQuery = "DELETE FROM status WHERE id = $id";
                mysqli_query($conn, $deleteQuery);
                header("Location: admindashboard.php");
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } elseif ($action === "deny") {
            // Delete the record from the status table
            $deleteQuery = "DELETE FROM status WHERE id = $id";
            if (mysqli_query($conn, $deleteQuery)) {
                header("Location: admindashboard.php");
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Signup Requests</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<div class="container">
		<div class="header">
			<div class="profile">
				<img src="xyz.jpeg" alt="Profile photo">
				<span>Welcome</span>
			</div>
			<!-- Logout button -->
			<form class="logout-form" method="post">
    <input type="submit" name="logout" value="Logout">
</form>


		</div>
        <div class="content">
            <h2>Manage Signup Requests</h2>
            <table>
                <thead>
				<tr>
    <th>Name</th>
    <th>Email</th>
    <th>SDRN Number</th>
    <th>Action</th>
</tr>

                </thead>
                <tbody>
                    <?php
                    // Check if the form was submitted
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        $action = isset($_POST['action']) ? $_POST['action'] : '';
                        $id = isset($_POST['id']) ? $_POST['id'] : '';

                        // Perform the action based on the button clicked
                        if ($action === "accept") {
                            // Get data from the status table based on the provided ID
                            $query = "SELECT * FROM status WHERE id = $id";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);

                            // Insert the data into the users table
							$insertQuery = "INSERT INTO users (name, email, phone, password, sdrn) 
							VALUES ('{$row['name']}', '{$row['email']}', '{$row['phone']}', '{$row['password']}', '{$row['sdrn']}')";

                            if (mysqli_query($conn, $insertQuery)) {
                                // Delete the record from the status table
                                $deleteQuery = "DELETE FROM status WHERE id = $id";
                                mysqli_query($conn, $deleteQuery);
                                echo '<script>alert("User has been accepted and added to the users table."); window.location.href = "admindashboard.php";</script>';
                                
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                        } elseif ($action === "deny") {
                            // Delete the record from the status table
                            $deleteQuery = "DELETE FROM status WHERE id = $id";
                            if (mysqli_query($conn, $deleteQuery)) {
                                echo '<script>alert("User request has been denied."); window.location.href = "admindashboard.php";</script>';
                                exit;
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                        }
                    }

                    // Fetch signup requests from the status table
                    $query = "SELECT * FROM status";
                    $result = mysqli_query($conn, $query);

					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr>';
						echo '<td>' . $row['name'] . '</td>';
						echo '<td>' . $row['email'] . '</td>';
						echo '<td>' . $row['sdrn'] . '</td>';  // Display the SDRN number
						echo '<td>';
						echo '<form method="post">';
						echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
						echo '<button type="submit" name="action" value="accept" class="accept-button">Accept</button>';
						echo '<button type="submit" name="action" value="deny" class="deny-button">Deny</button>';
						echo '</form>';
						echo '</td>';
						echo '</tr>';
					}
					
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
