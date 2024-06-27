<?php
 require "dbconn.php";
if (isset($_POST["reset_password"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: create-new-password.php?newpwd=empty");
        exit();
    } else if ($password !== $passwordRepeat) {
        header("Location: create-new-password.php?newpwd=nomatch");
        exit();
    }

    $currentDate = date("U");

   

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL Error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            echo "Invalid or expired token";
            exit(); // Exit to stop further script execution
        } else {
            // Use email directly from the "pwdReset" table
            $tokenEmail = $row['pwdResetEmail'];

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt2 = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt2, $sql)) {
                echo "There was an error";
                exit();
            } else {
                mysqli_stmt_bind_param($stmt2, "s", $tokenEmail);
                mysqli_stmt_execute($stmt2);

                $result2 = mysqli_stmt_get_result($stmt2);
                if (!$row2 = mysqli_fetch_assoc($result2)) {
                    echo "<script>alert('Error Occurred')</script>";
                    exit();
                } else {
                    $sql = "UPDATE users SET password = ? WHERE email = ?";
                    $stmt3 = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt3, $sql)) {
                        echo "There was an error";
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt3, "ss", $password, $tokenEmail);
                        mysqli_stmt_execute($stmt3);

                        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
                        $stmt4 = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt4, $sql)) {
                            echo "There was an error";
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt4, "s", $email);
                            mysqli_stmt_execute($stmt4);
                            header("Location: login.php?reset=success");
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: index.php");
}
?>
