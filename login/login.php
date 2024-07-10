<?php
session_start();

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tourindia";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['Signin'])) {
    $email = $_POST['AdminName']; // Using email as username
    $password = $_POST['AdminPassword'];

    // Check if the user is an admin
    $adminQuery = "SELECT * FROM `admin_login` WHERE `Admin_Name` = '$email' AND `Admin_Password` = '$password'";
    $adminResult = mysqli_query($conn, $adminQuery);

    if (!$adminResult) {
        die("Error executing admin query: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($adminResult) == 1) {
        // Admin login successful
        $_SESSION['AdminLoginId'] = $email;
        header("location: admindashboard.php");
        exit();
    } else {
        // Check if the user is a regular user using email and password
        $userQuery = "SELECT * FROM `login` WHERE `usersEmail` = '$email' AND `password` = '$password'";
        $userResult = mysqli_query($conn, $userQuery);

        if (!$userResult) {
            die("Error executing user query: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($userResult) == 1) {
            // Regular user login successful
            // Store user's email in session
            $_SESSION['email'] = $email;
            header("location: loggedinhome.php");
            exit();
        } else {
            // Invalid credentials
            echo "Invalid email or password.";
        }
    }
}
?>


<!-- Remaining HTML code remains the same -->


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #192119;
            color: #bcbcbc;
            padding-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        div.login-form {
            width: 500px;
            background-color: #101511;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        div.login-form h2 {
            text-align: center;
            background-color: #e78e28;
            padding: 12px 0px;
            color: white;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        div.login-form form {
            padding: 30px 60px;
        }

        div.login-form form div.input-field {
            display: flex;
            margin: 10px 0px;
        }

        div.login-form form div.input-field i {
            color: #a47546;
            padding: 10px 14px;
            background-color: #f5f5f5;
            margin-right: 4px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        div.login-form form div.input-field input {
            background-color: #f5f5f5;
            padding: 10px;
            border: 1px solid #ccc;
            width: 100%;
            border-radius: 5px;
        }

        div.login-form form button {
            width: 100%;
            background-color: #e78e28;
            padding: 8px;
            border: none;
            font-size: 16px;
            color: white;
            margin: 15px 0;
            transition: background-color 0.4s;
            border-radius: 5px;
        }

        div.login-form form button:hover {
            background-color: #a47546;
        }

        div.login-form form div.extra {
            font-size: 14px;
            display: flex;
            justify-content: space-between;
        }

        div.login-form form div.extra a:first-child,
        div.login-form form div.extra a:last-child {
            color: #a47546;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4a4a4a;
            color: white;
            border-radius: 5px;
            margin: 20px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #a47546;
        }
    </style>
</head>
<body>

<div class="login-form">
    <a href="../home.php" class="back-button">Back to Home</a>
    <h2>Login</h2>
    <form method="POST">
        <div class="input-field">
            <i class="bi bi-person-circle"></i>
            <input type="text" placeholder="Username" name="AdminName" required>
        </div>
        <div class="input-field">
            <i class="bi bi-shield-lock"></i>
            <input type="password" placeholder="Password" name="AdminPassword" required>
        </div>
        
        <button type="submit" name="Signin">Sign In</button>

        <div class="extra">
            <a href="#">Forgot Password?</a>
            <a href="registration.php">Register Here</a>
        </div>
    </form>
</div>

</body>
</html>
