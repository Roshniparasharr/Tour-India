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

// Query to fetch review details
$sql = "SELECT 
r.reviewer_name,
r.review_content,
r.rating,
r.review_date
FROM 
reviews r";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reviews</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #192119;
    color: #bcbcbc;
    padding-top: 20px;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    padding: 20px;
}

.review-card {
    background-color: #101511;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    padding: 20px;
    margin: 10px;
    width: 300px; /* Adjust the width of each review card */
}

.review-card h3 {
    margin-top: 0;
    color: #e78e1e;
}

.review-card p {
    margin: 10px 0;
    color: #bcbcbc;
}

.review-card .rating {
    color: #ffa500;
}

.review-card .details {
    color: #888;
}

.back-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #cd9258;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin: 20px;
    font-weight: bold;
    transition: background-color 0.3s;
    text-align: center;
}

.back-button:hover {
    background-color: #b67b52;
}
</style>
</head>
<body>

<a href="./home.php" class="back-button">Back to Home</a>

<div class="container">
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="review-card">';
            echo '<h3>Reviewer Name: ' . $row["reviewer_name"]. "</h3>";
            echo '<p>Review Content: ' . $row["review_content"]. "</p>";
            echo '<p class="rating">Rating: ' . $row["rating"]. "</p>";
            
            echo '<p class="details">Review Date: ' . $row["review_date"]. "</p>";
            echo '</div>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
