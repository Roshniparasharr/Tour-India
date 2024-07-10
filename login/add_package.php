<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
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

    // Prepare and bind parameters for inserting into hotels table
    $stmt_hotel = $conn->prepare("INSERT INTO hotels (hotel_name, city, amenities, ratings) VALUES (?, ?, ?, ?)");
    $stmt_hotel->bind_param("ssss", $hotel_name, $city, $amenities, $ratings);

    // Set parameters
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $region = mysqli_real_escape_string($conn, $_POST["region"]);
    $days = mysqli_real_escape_string($conn, $_POST["days"]);
    $package_name = mysqli_real_escape_string($conn, $_POST["package_name"]);
    $package_description = mysqli_real_escape_string($conn, $_POST["package_description"]);
    $package_price = mysqli_real_escape_string($conn, $_POST["package_price"]);
    $hotel_name = mysqli_real_escape_string($conn, $_POST["hotel_name"]);
    $amenities = mysqli_real_escape_string($conn, $_POST["amenities"]);
    $ratings = mysqli_real_escape_string($conn, $_POST["ratings"]);

    // Execute the statement for inserting into hotels table
    if ($stmt_hotel->execute()) {
        $hotelid = $conn->insert_id;

        // Prepare and bind parameters for inserting into city_packages table
        $stmt_package = $conn->prepare("INSERT INTO city_packages (city, region, days, package_name, package_description, package_price, hotelid) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt_package->bind_param("sssssss", $city, $region, $days, $package_name, $package_description, $package_price, $hotelid);

        // Execute the statement for inserting into city_packages table
        if ($stmt_package->execute()) {
            echo "<script>alert('New package added successfully');</script>";
        } else {
            echo "<script>alert('Error adding package');</script>";
        }
    } else {
        echo "<script>alert('Error adding hotel');</script>";
    }

    // Close statement and connection
    $stmt_hotel->close();
    $stmt_package->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Package</title>
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
           /* Matched border color */
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
<div class="container">
    <h1>Add Package</h1>
    <form id="packageForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return validateForm()">
        <label for="city">City:</label>
        <input type="text" id="city" name="city" placeholder="City" required><br>
        <span class="error" id="cityError"></span>

        <label for="region">Region:</label>
        <input type="text" id="region" name="region" placeholder="Region" required><br>
        <span class="error" id="regionError"></span>

        <label for="days">Days:</label>
        <input type="text" id="days" name="days" placeholder="Days" required><br>
        <span class="error" id="daysError"></span>

        <label for="package_name">Package Name:</label>
        <input type="text" id="package_name" name="package_name" placeholder="Package Name" required><br>
        <span class="error" id="packageNameError"></span>

        <label for="package_description">Package Description:</label>
        <textarea id="package_description" name="package_description" rows="4" placeholder="Package Description" required></textarea><br>
        <span class="error" id="packageDescriptionError"></span>

        <label for="package_price">Package Price:</label>
        <input type="text" id="package_price" name="package_price" placeholder="Package Price" required><br>
        <span class="error" id="priceError"></span>

        <label for="hotel_name">Hotel Name:</label>
        <input type="text" id="hotel_name" name="hotel_name" placeholder="Hotel Name" required><br>
        <span class="error" id="hotelError"></span>

        <label for="amenities">Amenities:</label>
        <textarea id="amenities" name="amenities" rows="4" placeholder="Amenities" required></textarea><br>
        <span class="error" id="amenitiesError"></span>

        <label for="ratings">Ratings:</label>
        <input type="text" id="ratings" name="ratings" placeholder="Ratings" required><br>
        <span class="error" id="ratingsError"></span>

        <input type="submit" value="Add Package">
        <input type="reset" value="Reset">
        <button class='back-button' onclick="window.location.href='adminviewjourneys.php'">Back to Dashboard</button>
    </form>
</div>

<script>
    // Validate city input
    document.getElementById("city").addEventListener("input", function() {
        validateCity();
    });

    // Validate region input
    document.getElementById("region").addEventListener("input", function() {
        validateRegion();
    });

    // Validate days input
    document.getElementById("days").addEventListener("input", function() {
        validateDays();
    });

    // Validate package name input
    document.getElementById("package_name").addEventListener("input", function() {
        validatePackageName();
    });

    // Validate package description input
    document.getElementById("package_description").addEventListener("input", function() {
        validatePackageDescription();
    });

    // Validate package price input
    document.getElementById("package_price").addEventListener("input", function() {
        validatePrice();
    });

    // Validate hotel name input
    document.getElementById("hotel_name").addEventListener("input", function() {
        validateHotelName();
    });

    // Validate amenities input
    document.getElementById("amenities").addEventListener("input", function() {
        validateAmenities();
    });

    // Validate ratings input
    document.getElementById("ratings").addEventListener("input", function() {
        validateRatings();
    });

    // Form validation function
    function validateForm() {
        return validateCity() && validateRegion() && validateDays() && validatePackageName() && validatePackageDescription() && validatePrice() && validateHotelName() && validateAmenities() && validateRatings();
    }

    // City validation function
    function validateCity() {
        var cityInput = document.getElementById("city").value.trim();
        var cityRegex = /^[A-Za-z\s]+$/;
        var cityError = document.getElementById("cityError");
        if (!cityRegex.test(cityInput)) {
            cityError.textContent = "City must contain alphabets only.";
            cityError.style.display = "block";
            return false;
        } else {
            cityError.textContent = "";
            cityError.style.display = "none";
            return true;
        }
    }

    // Region validation function
    function validateRegion() {
        var regionInput = document.getElementById("region").value.trim();
        var regionRegex = /^[A-Za-z\s]+$/;
        var regionError = document.getElementById("regionError");
        if (!regionRegex.test(regionInput)) {
            regionError.textContent = "Region must contain alphabets only.";
            regionError.style.display = "block";
            return false;
        } else {
            regionError.textContent = "";
            regionError.style.display = "none";
            return true;
        }
    }

    // Days validation function
    function validateDays() {
        var daysInput = document.getElementById("days").value.trim();
        var daysRegex = /^[0-9]+$/;
        var daysError = document.getElementById("daysError");
        if (!daysRegex.test(daysInput)) {
            daysError.textContent = "Days must contain numbers only.";
            daysError.style.display = "block";
            return false;
        } else {
            daysError.textContent = "";
            daysError.style.display = "none";
            return true;
        }
    }

    // Package name validation function
    function validatePackageName() {
        var packageNameInput = document.getElementById("package_name").value.trim();
        var packageNameRegex = /^[A-Za-z\s]+$/; // Updated regex to allow spaces
        var packageNameError = document.getElementById("packageNameError");
        if (!packageNameRegex.test(packageNameInput)) {
            packageNameError.textContent = "Package name must contain alphabets only.";
            packageNameError.style.display = "block";
            return false;
        } else {
            packageNameError.textContent = "";
            packageNameError.style.display = "none";
            return true;
        }
    }

    // Package description validation function
    function validatePackageDescription() {
        var packageDescriptionInput = document.getElementById("package_description").value.trim();
        var packageDescriptionError = document.getElementById("packageDescriptionError");
        if (packageDescriptionInput === "") {
            packageDescriptionError.textContent = "Package description is required.";
            packageDescriptionError.style.display = "block";
            return false;
        } else {
            packageDescriptionError.textContent = "";
            packageDescriptionError.style.display = "none";
            return true;
        }
    }

    // Price validation function
    function validatePrice() {
        var priceInput = document.getElementById("package_price").value.trim();
        var priceRegex = /^[0-9]+$/;
        var priceError = document.getElementById("priceError");
        if (!priceRegex.test(priceInput)) {
            priceError.textContent = "Price must contain numbers only.";
            priceError.style.display = "block";
            return false;
        } else {
            priceError.textContent = "";
            priceError.style.display = "none";
            return true;
        }
    }

    // Hotel name validation function
    function validateHotelName() {
        var hotelInput = document.getElementById("hotel_name").value.trim();
        var hotelRegex = /^[A-Za-z\s]+$/;
        var hotelError = document.getElementById("hotelError");
        if (!hotelRegex.test(hotelInput)) {
            hotelError.textContent = "Hotel name must contain alphabets only.";
            hotelError.style.display = "block";
            return false;
        } else {
            hotelError.textContent = "";
            hotelError.style.display = "none";
            return true;
        }
    }

    // Amenities validation function
    function validateAmenities() {
        var amenitiesInput = document.getElementById("amenities").value.trim();
        var amenitiesRegex = /^[A-Za-z0-9\s]+$/;
        var amenitiesError = document.getElementById("amenitiesError");
        if (!amenitiesRegex.test(amenitiesInput)) {
            amenitiesError.textContent = "Amenities must contain alphabets and numbers only.";
            amenitiesError.style.display = "block";
            return false;
        } else {
            amenitiesError.textContent = "";
            amenitiesError.style.display = "none";
            return true;
        }
    }

    // Ratings validation function
    function validateRatings() {
        var ratingsInput = document.getElementById("ratings").value.trim();
        var ratingsError = document.getElementById("ratingsError");
        var ratingsRegex = /^[1-5]$/;
        if (!ratingsRegex.test(ratingsInput)) {
            ratingsError.textContent = "Ratings must be between 1 and 5.";
            ratingsError.style.display = "block";
            return false;
        } else {
            ratingsError.textContent = "";
            ratingsError.style.display = "none";
            return true;
        }
    }
</script>
</body>
</html>
