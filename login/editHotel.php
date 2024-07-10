<?php
// Establish database connection
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

// Initialize $hotel array with empty values
$hotel = array(
    'hotelid' => '',
    'hotel_name' => '',
    'city' => '',
    'amenities' => '',
    'ratings' => '',
    'description' => ''
);

// Function to fetch hotel data by hotel ID
function fetchHotelById($conn, $hotelid) {
    $sql = "SELECT * FROM hotels WHERE hotelid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $hotelid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $hotel = $result->fetch_assoc();
        $stmt->close();
        return $hotel;
    } else {
        echo "No hotel found with ID: $hotelid";
        $stmt->close();
        return null;
    }
}

// Function to update hotel details
function updateHotel($conn, $hotelid, $hotel_name, $city, $amenities, $ratings, $description) {
    $sql = "UPDATE hotels SET hotel_name = ?, city = ?, amenities = ?, ratings = ?, description = ? WHERE hotelid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $hotel_name, $city, $amenities, $ratings, $description, $hotelid);
    $stmt->execute();
    $stmt->close();
}

// Fetch hotel data if hotelid is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['hotelid'])) {
    $hotelid = $_GET['hotelid'];
    $hotel = fetchHotelById($conn, $hotelid);
    if (!$hotel) {
        echo "Hotel not found.";
        exit;
    }
}

// Handle form submission for updating hotel details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotelid = $_POST['hotelid'];
    $hotel_name = $_POST['hotel_name'];
    $city = $_POST['city'];
    $amenities = $_POST['amenities'];
    $ratings = $_POST['ratings'];
    $description = $_POST['description'];

    updateHotel($conn, $hotelid, $hotel_name, $city, $amenities, $ratings, $description);
    echo '<p>Hotel details updated successfully.</p>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #192119; /* Matched background color */
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #101511; /* Matched background color */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #e78e28; /* Matched heading color */
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #f5f5f5; /* Matched label color */
        }

        input[type="text"], textarea {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #37473b;
            color: #f5f5f5; /* Matched text color */
        }

        input[type="submit"], input[type="reset"] {
            background-color: #a47546; /* Matched button color */
            color: #fff; /* Matched text color */
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #d88627; /* Matched button hover color */
        }

        .back-button {
            background-color: #4a4a4a;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .back-button:hover {
            background-color: #666;
        }

        .error {
            color: #ff3333;
            font-size: 14px;
            margin-top: 5px;
            display: none; /* Hide error messages by default */
        }

        .error.visible {
            display: block; /* Show error messages when they have content */
        }
    </style>
</head>
<body>
<div class="table-container">
    <h2>Edit Hotel</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="hotelid" value="<?php echo isset($hotel['hotelid']) ? $hotel['hotelid'] : ''; ?>">

        <label for="hotel_name">Hotel Name:</label>
        <input type="text" id="hotel_name" name="hotel_name" value="<?php echo isset($hotel['hotel_name']) ? $hotel['hotel_name'] : ''; ?>" required><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo isset($hotel['city']) ? $hotel['city'] : ''; ?>" required><br>

        <label for="amenities">Amenities:</label>
        <textarea id="amenities" name="amenities" rows="4" required><?php echo isset($hotel['amenities']) ? $hotel['amenities'] : ''; ?></textarea><br>

        <label for="ratings">Ratings:</label>
        <input type="text" id="ratings" name="ratings" value="<?php echo isset($hotel['ratings']) ? $hotel['ratings'] : ''; ?>" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required><?php echo isset($hotel['description']) ? $hotel['description'] : ''; ?></textarea><br>

        <input type="submit" value="Update Hotel" class="button">
    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>
