<?php
session_start();

// Initialize variables to store user details
$userName = '';

// Check if the user is logged in
if(isset($_SESSION['email'])) {
    // Include your database connection code here
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

    // Fetch user details based on logged-in user's email
    $userEmail = $_SESSION['email'];
    $userDetailsQuery = "SELECT * FROM login WHERE usersEmail = '$userEmail'";
    $userDetailsResult = $conn->query($userDetailsQuery);

    if ($userDetailsResult->num_rows > 0) {
        $userDetails = $userDetailsResult->fetch_assoc();
        // Concatenate first name and last name to get full name
        $userName = $userDetails['firstname'] . ' ' . $userDetails['lastname'];
    }

    // Close the database connection
    $conn->close();
}

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
            background-color: #f8f8f8;
            color: #e78e28;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        .nav-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-menu li {
            display: inline-block;
            margin-right: 20px;
        }

        .nav-menu li:last-child {
            margin-right: 0;
        }

        .nav-menu li a {
            text-decoration: none;
            color: #e78e28;
            font-size: 18px;
            transition: color 0.3s;
        }

        .nav-menu li a:hover {
            color: #ffa500;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 20px;
        }

        .review-card {
            background-color: #192119;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            width: 450px; /* Adjusted width of each review card */
            color: #bcbcbc;
        }

        .review-card h3 {
            margin-top: 0;
            color: #e78e1e;
            font-weight: bold; /* Make reviewer name bold */
        }

        .review-card p {
            margin: 10px 0;
            line-height: 1.5; /* Improve line spacing for better readability */
        }

        .review-card .image-container {
            width: 100%;
            height: 200px; /* Fixed height for the image container */
            overflow: hidden;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .review-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .review-card .rating {
            color: #ffa500;
            font-weight: bold; /* Make rating bold */
        }

        .review-card .details {
            color: #888;
            font-weight: bold; /* Make details bold */
        }

        .form-container {
    display: none;
    position: fixed;
    z-index: 1;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 90%;
    max-width: 400px;
    background-color: #f8f8f8;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.form-content {
    margin-bottom: 20px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
}

.form-container input[type=text],
.form-container input[type=number],
.form-container textarea {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.form-container input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.form-container input[type=submit]:hover {
    background-color: #45a049;
}
.review-form{
    color: black;
}
.error {
    color: red;
}

        .add-review-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }

        .add-review-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">Reviews</div>
    <ul class="nav-menu">
        <li><button onclick="openForm()" class="add-review-btn">Add Review</button></li>
        <li><a href="../home.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</div>

<div class="container">
    <!-- Button to open the form -->
    
    <?php
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

    $sql = "SELECT 
        r.reviewer_name,
        r.review_content,
        r.rating,
        r.review_date
        FROM 
        reviews r";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error executing query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="review-card">';
            echo '<h3>Reviewer Name: ' . $row["reviewer_name"]. "</h3>";
            echo '<p><span class="details">Review Content:</span> ' . $row["review_content"]. "</p>";
            echo '<p><span class="details">Rating:</span> ' . $row["rating"]. "</p>";
            echo '<p><span class="details">Review Date:</span> ' . $row["review_date"]. "</p>";
            echo '</div>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <!-- Reviews will be displayed here -->
</div>

<!-- Form container -->
<div class="form-container" id="formContainer">
    <div class="form-content">
        <span class="close" onclick="closeForm()">&times;</span>
        <h2>Add a Review</h2>
        <form id="reviewForm" method="post">
            <label for="reviewer_name">Your Name:</label><br>
            <input type="text" id="reviewer_name" name="reviewer_name" value="<?php echo htmlspecialchars($userName); ?>" required><br>

            <label for="review_content">Review Content:</label><br>
            <textarea id="review_content" name="review_content" required></textarea><br>

            <label for="rating">Rating (1-5):</label><br>
            <input type="number" id="rating" name="rating" min="1" max="5" required><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</div>

<script>
    // Function to open the form
    function openForm() {
        document.getElementById("formContainer").style.display = "block";
    }

    // Function to close the form
    function closeForm() {
        document.getElementById("formContainer").style.display = "none";
    }

    // Function to handle form submission
    document.getElementById("reviewForm").addEventListener("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Refresh the page after successful submission
                window.location.reload();
            }
        };
        xhr.open("POST", "submit_review.php", true);
        xhr.send(formData);
    });
</script>

</body>
</html>








