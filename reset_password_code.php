<?php
include('dbconn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Load Composer's autoloader
require 'C:\Users\ROHIT\OneDrive\Desktop\Hosted\durga\vendor\autoload.php';

if (isset($_POST["password_reset_link"])) {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $validator = bin2hex($token);
    
    // Define the URL properly
    $url = "http://localhost/durga/create-new-password.php?selector=" . $selector . "&validator=" . $validator;
    $expires = date("U") + 1800;

    require 'dbconn.php';

    $userEmail = $_POST["email"];

    // Delete any existing reset requests for the same email
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    // Insert the new reset request into the database
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES(?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL Error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $validator, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Configure PHPMailer for sending emails
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'researchX.rait@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'ssjoyyoihuwwwpzi'; // Replace with your Gmail password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('researchX.rait@gmail.com', 'ResearchX'); // Replace with your name and email address

        $mail->isHTML(true);
        $mail->Subject = "Password Reset Request";
        $mail->Body = '<p>We received a password reset request. Click on the link to reset your password: <a href="' . $url . '">' . $url . '</a></p>';
        $mail->addAddress($userEmail);
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header("Location: reset-password.php?reset=success");
} else {
    header("Location: index.php");
}
?>
