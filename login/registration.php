<?php
$errors = []; // Initialize an empty array to store errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $age = $_POST["age"];
    $number = $_POST["number"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $aadhar = $_POST["aadhar"];

    // Validate form inputs
    if (empty($firstname) || empty($lastname) || empty($age) || empty($number) || empty($gender) || empty($address) || empty($email) || empty($password) || empty($aadhar)) {
        $errors[] = "All fields are required.";
    }

    // Validation for age: Check if age is numeric and greater than zero
    if (!is_numeric($age) || $age <= 0) {
        $errors[] = "Age must be a valid number greater than zero.";
    }

    // Validation for gender: Check if gender is one of the specified options
    $allowed_genders = ["Male", "Female", "Other"];
    if (!in_array($gender, $allowed_genders)) {
        $errors[] = "Please select a valid gender.";
    }

    // Validation for address: Check if address is not empty
    if (empty($address)) {
        $errors[] = "Address is required.";
    }

    // Validation for email: Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Validation for password: Check if password meets certain criteria (e.g., minimum length, containing uppercase, lowercase, number, special character)
    if (strlen($password) < 8 || !preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*]).{8,}$/", $password)) {
        $errors[] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    // Validation for Aadhar number: Check if Aadhar number is exactly 12 digits long and contains only digits
    if (!preg_match("/^\d{12}$/", $aadhar)) {
        $errors[] = "Aadhar number must be exactly 12 digits long and contain only numbers.";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Connect to database
        $serverName = "localhost:3306";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "tourindia";

        $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and execute SQL statement to insert data into the login table
        $sql = "INSERT INTO login (firstname, lastname, age, number, gender, address, usersEmail, password, userAadhar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssissssss", $firstname, $lastname, $age, $number, $gender, $address, $email, $hashed_password, $aadhar);

        if ($stmt->execute()) {
            // Display success message using JavaScript
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #192119;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background-color: #101511;
            color: #f5f5f5;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Added box-shadow */
            width: 500px; /* Increased width */
            margin-top: 50px; /* Added top margin */
            margin-bottom: 50px; /* Added bottom margin */
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #e78e28;
        }

        .form-control {
            margin: 20px;
        }

        label {
            font-weight: 200;
            font-size: medium;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="tel"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #000000;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #37473b;
            color: #ffffff;
        }

        select {
            height: 40px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .buttons button {
            width: 48%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            background-color: #a47546;
            color: #fff;
        }

        .buttons button:hover {
            background-color: #d88627;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #4a4a4a;
        }

        .login-link a {
            color: lightskyblue;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration</h2>
        <form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validateForm()">
            <div class="form-control">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
                <span id="firstnameError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="form-control">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
                <span id="lastnameError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="form-control">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Age" required>
                <span id="ageError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="form-control">
                <label for="number">Mobile Number:</label>
                <input type="tel" id="number" name="number" placeholder="Mobile Number" required>
                <span id="mobileError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="form-control">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <span id="genderError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="form-control">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Address" required>
                <span id="addressError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="form-control">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="abc@gmail.com" required>
                <span id="emailError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="form-control">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span id="passwordError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="form-control">
                <label for="aadhar">Aadhar Number:</label>
                <input type="text" id="aadhar" name="aadhar" placeholder="Aadhar Number" required>
                <span id="aadharError" class="error"></span> <!-- Added error span -->
            </div>
            <div class="buttons">
                <button type="reset">Reset</button>
                <button type="submit" name="submit">Submit</button>
            </div>
            <div class="login-link">
                <span>Already have an account? <a href="login.php">Login</a></span>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            var isValid = true;

            // Reset error messages
            var errorElements = document.getElementsByClassName("error");
            for (var i = 0; i < errorElements.length; i++) {
                errorElements[i].textContent = "";
            }

            // Validate first name
            var firstnameInput = document.getElementById("firstname").value;
            var firstnameError = document.getElementById("firstnameError");
            var nameRegex = /^[a-zA-Z]*$/;
            if (!nameRegex.test(firstnameInput)) {
                firstnameError.textContent = "First name should contain only alphabets.";
                isValid = false;
            }

            // Validate last name
            var lastnameInput = document.getElementById("lastname").value;
            var lastnameError = document.getElementById("lastnameError");
            if (!nameRegex.test(lastnameInput)) {
                lastnameError.textContent = "Last name should contain only alphabets.";
                isValid = false;
            }

            // Validate age
            var ageInput = document.getElementById("age").value;
            var ageError = document.getElementById("ageError");
            if (isNaN(ageInput) || ageInput <= 0) {
                ageError.textContent = "Age must be a valid number greater than zero.";
                isValid = false;
            }

            // Validate mobile number
            var mobileInput = document.getElementById("number").value;
            var mobileError = document.getElementById("mobileError");
            var mobileRegex = /^[6-9]\d{9}$/;
            if (!mobileRegex.test(mobileInput)) {
                mobileError.textContent = "Mobile number must start with 6, 7, 8, or 9 and must be 10 digits long.";
                isValid = false;
            }

            // Validate gender
            var genderInput = document.getElementById("gender").value;
            var genderError = document.getElementById("genderError");
            if (genderInput === "") {
                genderError.textContent = "Please select a gender.";
                isValid = false;
            }

            // Validate address
            var addressInput = document.getElementById("address").value;
            var addressError = document.getElementById("addressError");
            if (addressInput.trim() === "") {
                addressError.textContent = "Address is required.";
                isValid = false;
            }

            // Validate email
            var emailInput = document.getElementById("email").value;
            var emailError = document.getElementById("emailError");
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput)) {
                emailError.textContent = "Please enter a valid email address.";
                isValid = false;
            }

            // Validate password
            var passwordInput = document.getElementById("password").value;
            var passwordError = document.getElementById("passwordError");
            var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*]).{8,}$/;
            if (!passwordRegex.test(passwordInput)) {
                passwordError.textContent = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
                isValid = false;
            }

            // Validate Aadhar number
            var aadharInput = document.getElementById("aadhar").value;
            var aadharError = document.getElementById("aadharError");
            var aadharRegex = /^\d{12}$/;
            if (!aadharRegex.test(aadharInput)) {
                aadharError.textContent = "Aadhar number must be exactly 12 digits long and contain only numbers.";
                isValid = false;
            }

            // Prevent form submission if there are errors
            if (!isValid) {
                alert("Please fix the errors in the form.");
            }
            return isValid;
        }
    </script>
</body>
</html>
