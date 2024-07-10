<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourindia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$reviewer_name = $_POST['reviewer_name'];
$review_content = $_POST['review_content'];
$rating = $_POST['rating'];

// Prepare SQL statement
$sql = "INSERT INTO reviews (reviewer_name, review_content, rating) VALUES (?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $reviewer_name, $review_content, $rating);

// Execute the statement
if ($stmt->execute()) {
    echo "Review submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
