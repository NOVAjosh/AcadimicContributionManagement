<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
     <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        #video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        #video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            loop: no;
        }
        #buttons-container {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            position: absolute;
            top: 60%;
            left: 30%;
            transform: translate(-100%, -50%);
            padding: 50px;
            text-align: center;
            width: 283px;
            height: 240px;
            display: none;
            z-index: 1000;
            animation: buttons-appear 6s;
        }
        #buttons-container button {
            margin: 10px 0;
            padding: 10px 20px;
            font-size: 18px;
            border: 2px solid #A82626;
            background-color: transparent;
            cursor: pointer;
            display: block;
        }
        #buttons-container a {
            color: white;
            text-decoration: none;
        }
        #video-container:hover #buttons-container {
            display: block;
        }
        @keyframes buttons-appear {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        #video-container:not(:hover) #buttons-container {
            display: block;
        }
        /* This line adds the text "Research Management Website" to the top bar */
        .top-bar {
            background-color: black;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
            /* This line makes the "Research Management Website" text appear after 6 seconds */
            animation: top-bar-appear 6s;
            /* This line moves the top bar to the top of the screen */
            transform: translate(0, 0);
        }
        /* This line creates a hyperlink for the button "Admin Login" */
        #buttons-container button:first-child a {
            color: white;
            text-decoration: none;
        }
        /* This line creates a hyperlink for the button "Login" */
        #buttons-container button:nth-child(2) a {
            color: white;
            text-decoration: none;
        }
        /* This line creates a hyperlink for the button "Signup" */
        #buttons-container button:last-child a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div id="video-container">
        <video autoplay muted id="video">
            <source src="index.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div id="buttons-container">
            <button><a href="adminlogin.php">Admin Login</a></button>
            <button><a href="login.php">Login</a></button>
            <button><a href="signup.php">Signup</a></button>
        </div>
    </div>
    <div class="top-bar">
        <strong>Research Management</strong>
    </div>
</body>
</html>
