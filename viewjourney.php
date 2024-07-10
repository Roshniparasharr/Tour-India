<?php
session_start();

// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root";        // Change this to your database username
$password = "";            // Change this to your database password
$dbname = "tourindia";     // Change this to your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $city to an empty string
$city = '';

// Check if the 'city' parameter is in the URL
if(isset($_GET['city'])) {
    $city = $conn->real_escape_string($_GET['city']); // Prevent SQL Injection
}

// Check if the 'email' parameter is in the URL
if(isset($_GET['email'])) {
    $_SESSION['email'] = $_GET['email']; // Store the email in a session variable
}

// Query to fetch package details along with hotel information based on the selected city
$sql = "SELECT cp.*, h.*, h.description as hotel_description FROM city_packages cp
        LEFT JOIN hotels h ON cp.hotelid = h.hotelid
        WHERE cp.city = '$city'";

$result = $conn->query($sql);
?>

<!-- Remaining HTML code remains the same -->

<!DOCTYPE html>
<html>
<head>
  
    <style>
    /* Global Styles */
body {
    background-color: #101511;
    color: #d8d8d8;;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin: 0;
    padding: 0;

}

h1 {
    color: #e78e28;
    text-align: center;
    margin-top: 20px;
}

/* City Card Styles */
.city-card {
    display: flex;
    flex-direction: row;
    background-color: #101511;
    /* border: 1px solid #e84393; */
    border-radius: 10px;
    margin: 20px;
    padding: 20px;
    box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2);
}

.city-images {
    flex: 1; /* Take up one-third of the card width */
}

.city-images img {
    max-width: 100%;
    height: auto;
    display: block;
    border-radius: 10px;
    margin-bottom: 10px;
    border: 1px solid #e78e28;
}

.city-details {
    flex: 2; /* Take up two-thirds of the card width */
    padding: 0 20px;
}

.city-details p {
    margin: 10px 0;
    font-size: 15px;
}

/* View Hotels Button Styles */
.view-hotels-button {
    flex: 0.6;
    display: flex;
    align-items: end;
    flex-direction: column-reverse;
    flex-wrap: wrap;
    align-content: space-between;
}

.view-button {
    background-color: #e78e28; /* Pink background for the button */
    color: #fff; /* White text color */
    padding: 10px 20px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    border-radius: 10px;
}

.view-button:hover {
    background-color: #ff6384; /* Lighter pink on hover */
}

/* Navbar Styles */
.navbar {
    background-color: #192119;
    overflow: hidden;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Add box shadow */
    padding: 15px 0; /* Increase vertical padding to increase the height */
}

.logo {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    float: left;
    padding: 10px 20px;
    font-size: 35px;
    color: #e78e28;
}
/* Content Container Styles */
.content-container {
    background-color: #192119;
    
    border-radius: 5px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    margin: 20px auto; /* Center the container */
    padding: 40px;
    width: 60%; /* Adjust the width as needed */
}/* Footer Styles */
footer {
    position: absolute;
    bottom: 0;
    background-color:white;
    text-align: center;
    padding: 15px 0; /* Increase footer height */
    font-size: 16px;
    width: 100%; /* Full-width footer */
    box-shadow: 0px -4px 8px rgba(0, 0, 0, 0.2); /* Shadow at the top of footer */
    transition: background-color 0.3s, color 0.3s; /* Smooth hover transition */
}

footer:hover {
    color:#e84393; /* White text color on hover */
}


    /* Add CSS styles for the hover effect */
    .amenities-container {
        position: relative;
        display: inline-block;
    }

    .amenities-list {
        position: absolute;
        top: 0;
        left: 100%; /* Position to the right of the hover position */
        width: 300px; /* Adjust width as needed */
        background-color: #192119;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: none; /* Initially hidden */
    }

    .amenities-container:hover .amenities-list {
        display: block; /* Show on hover */
    }
</style>

    <title>View Journey - <?php echo $city; ?></title>
</head>
<body> 
    <div class="navbar">
        <span class="logo">TourIndia</span>
    </div>
    <div class="content-container">
        <h1>View Journey - <?php echo $city; ?></h1>
        
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='city-card'>";
                echo "<div class='city-images'>";
                echo "<img src='" . $row['image_path'] . "' alt='" . $row['city'] . "'>";
                echo "</div>";
                echo "<div class='city-details'>";
                echo "<p><strong>City:</strong> " . $row['city'] . "</p>";
                echo "<p><strong>Region:</strong> " . $row['region'] . "</p>";
                echo "<p><strong>Days:</strong> " . $row['days'] . "</p>";
                echo "<p><strong>Package Name:</strong> " . $row['package_name'] . "</p>";
                echo "<p><strong>Package Description:</strong> " . $row['package_description'] . "</p>";
                echo "<p><strong>Package Price:</strong> Rs " . $row['package_price'] . "</p>";
                echo "<p><strong>Hotel:</strong> " . $row['hotel_name'] . "</p>";
                echo "<p><strong>Hotel Description:</strong> " . $row['hotel_description'] . "</p>";
                echo "<p><strong>Hotel Rating:</strong> " . ($row['ratings'] ?? 'N/A') . "</p>";

                // Add amenities with hover effect
                echo "<div class='amenities-container'>";
                echo "<p><strong>Amenities</strong></p>";
                echo "<div class='amenities-list'>"; // Initially hidden
                $amenities = explode("\r\n", $row['amenities']);
                foreach ($amenities as $index => $amenity) {
                    echo "<p>" . ($index + 1) . ". {$amenity}</p>"; // Increment index by 1
                }
                echo "</div>";
                echo "</div>";

                echo "</div>";
                echo "<div class='view-hotels-button'>";
                
               echo "<a href='bookingform.php?package_id=" . $row['package_id'] . "&package_name=" . urlencode($row['package_name']) . "' class='view-button'>Book Now</a>";
echo "</div>";
 echo "</div>";
            }
        } else {
            echo "No packages found for this city.";
        }
        ?>

        <?php
        $conn->close();
        ?>
    </div>
</body>
</html>
