<?php
// Check if the package_id parameter is provided
if (isset($_POST["package_id"])) {
    // Retrieve the package ID from the request
    $packageId = $_POST["package_id"];

    // Perform the deletion operation in the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tourindia";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to delete the package
    $sql = "DELETE FROM city_packages WHERE package_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $packageId);
    $stmt->execute();

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();

    // Redirect back to adminviewjourneys.php
    header("Location: adminviewjourneys.php");
    exit();
} else {
    // Handle missing parameter error
    echo "Package ID not provided";
}
?>
