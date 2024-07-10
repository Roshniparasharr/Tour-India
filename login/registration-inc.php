<?php
// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $age = $_POST["age"];
    $number = $_POST["number"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $aadhar = $_POST["aadhar"];

    // Validate form inputs (you can add more validation as needed)
    if (empty($firstname) || empty($lastname) || empty($age) || empty($number) || empty($gender) || empty($address) || empty($email) || empty($username) || empty($password) || empty($aadhar)) {
        echo "All fields are required.";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Connect to database (replace with your connection details)
    $serverName = "localhost:3306";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "tourindia";

    $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }



    // Prepare and execute SQL statement to insert data into the login table
     // Check connection
     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to insert data into the login table
    $sql = "INSERT INTO login (firstname, lastname, age, number, gender, address, usersEmail, username, password, userAadhar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissssssi", $firstname, $lastname, $age, $number, $gender, $address, $email, $username, $password, $aadhar);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to registration page if form is not submitted
    header("Location: registration.php");
    exit();
}
?>