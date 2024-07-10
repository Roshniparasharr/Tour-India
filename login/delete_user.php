<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tourindia";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user ID is set
if (isset($_POST['usersid'])) {
    $usersid = $_POST['usersid'];

    // Prepare a delete statement
    $sql = "DELETE FROM login WHERE usersid = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $usersid);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to the page displaying user data after deletion
            header("Location: adminviewusers.php");
            exit();
        } else {
            echo "Error executing delete statement: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing delete statement: " . $conn->error;
    }
} else {
    echo "User ID not provided.";
}

// Close connection
$conn->close();
?>
