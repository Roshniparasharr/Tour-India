<!DOCTYPE html>
<html>
<head>
    <title>Edit Package</title>
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
<div class="container">
    <h1>Edit Package</h1>
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

    $row = []; // Initialize $row variable

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_package'])) {
        $package_id = $_POST['package_id']; // Get package_id from POST

        // Get form data
        $city = $_POST['city'];
        $region = $_POST['region'];
        $days = $_POST['days'];
        $package_name = $_POST['package_name'];
        $package_description = $_POST['package_description'];
        $package_price = $_POST['package_price'];
        $hotel_name = $_POST['hotel_name'];
        $amenities = $_POST['amenities'];
        $ratings = $_POST['ratings'];

        // Update package details in city_packages table
        $update_sql = "UPDATE city_packages
                   SET city = '$city',
                       region = '$region',
                       days = '$days',
                       package_name = '$package_name',
                       package_description = '$package_description',
                       package_price = '$package_price'
                   WHERE package_id = $package_id";
        if ($conn->query($update_sql) === TRUE) {
            // Update hotel details in hotels table
            $update_hotel_sql = "UPDATE hotels
                             SET hotel_name = '$hotel_name',
                                 amenities = '$amenities',
                                 ratings = '$ratings'
                             WHERE hotelid IN (SELECT hotelid FROM city_packages WHERE package_id = $package_id)";
            if ($conn->query($update_hotel_sql) === TRUE) {
                echo '<script>alert("Package updated successfully");</script>';
            } else {
                echo "Error updating hotel details: " . $conn->error;
            }
        } else {
            echo "Error updating package details: " . $conn->error;
        }
    } else {
        // Fetch package details if not submitted
        if (isset($_GET['package_id'])) {
            $package_id = $_GET['package_id'];
            $sql = "SELECT cp.*, h.hotel_name, h.amenities, h.ratings FROM city_packages cp JOIN hotels h ON cp.hotelid = h.hotelid WHERE package_id = $package_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "No package found with the given ID.";
            }
        }
    }
    ?>


    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
        <input type="hidden" name="package_id" value="<?php echo isset($_GET['package_id']) ? htmlspecialchars($_GET['package_id']) : ''; ?>">

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo isset($row['city']) ? $row['city'] : ''; ?>" required><br>
        <span class="error" id="cityError"></span>

        <label for="region">Region:</label>
        <input type="text" id="region" name="region" value="<?php echo isset($row['region']) ? $row['region'] : ''; ?>" required><br>
        <span class="error" id="regionError"></span>

        <label for="days">Days:</label>
        <input type="text" id="days" name="days" value="<?php echo isset($row['days']) ? $row['days'] : ''; ?>" required><br>
        <span class="error" id="daysError"></span>

        <label for="package_name">Package Name:</label>
        <input type="text" id="package_name" name="package_name" value="<?php echo isset($row['package_name']) ? $row['package_name'] : ''; ?>" required><br>
        <span class="error" id="packageNameError"></span>

        <label for="package_description">Package Description:</label>
        <textarea id="package_description" name="package_description" rows="4" required><?php echo isset($row['package_description']) ? $row['package_description'] : ''; ?></textarea><br>
        <span class="error" id="packageDescriptionError"></span>

        <label for="package_price">Package Price:</label>
        <input type="text" id="package_price" name="package_price" value="<?php echo isset($row['package_price']) ? $row['package_price'] : ''; ?>" required><br>
        <span class="error" id="priceError"></span>

        <label for="hotel_name">Hotel Name:</label>
        <input type="text" id="hotel_name" name="hotel_name" value="<?php echo isset($row['hotel_name']) ? $row['hotel_name'] : ''; ?>" required><br>
        <span class="error" id="hotelError"></span>

        <label for="amenities">Amenities:</label>
        <textarea id="amenities" name="amenities" rows="4" required><?php echo isset($row['amenities']) ? $row['amenities'] : ''; ?></textarea><br>
        <span class="error" id="amenitiesError"></span>

        <label for="ratings">Ratings:</label>
        <input type="text" id="ratings" name="ratings" value="<?php echo isset($row['ratings']) ? $row['ratings'] : ''; ?>" required><br>
        <span class="error" id="ratingsError"></span>

        <input type="submit" name="update_package" value="Update Package">
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
            cityError.classList.add("visible");
            return false;
        } else {
            cityError.textContent = "";
            cityError.classList.remove("visible");
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
            regionError.classList.add("visible");
            return false;
        } else {
            regionError.textContent = "";
            regionError.classList.remove("visible");
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
            daysError.classList.add("visible");
            return false;
        } else {
            daysError.textContent = "";
            daysError.classList.remove("visible");
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
            packageNameError.classList.add("visible");
            return false;
        } else {
            packageNameError.textContent = "";
            packageNameError.classList.remove("visible");
            return true;
        }
    }

    // Package description validation function
    function validatePackageDescription() {
        var packageDescriptionInput = document.getElementById("package_description").value.trim();
        var packageDescriptionError = document.getElementById("packageDescriptionError");
        if (packageDescriptionInput === "") {
            packageDescriptionError.textContent = "Package description is required.";
            packageDescriptionError.classList.add("visible");
            return false;
        } else {
            packageDescriptionError.textContent = "";
            packageDescriptionError.classList.remove("visible");
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
            priceError.classList.add("visible");
            return false;
        } else {
            priceError.textContent = "";
            priceError.classList.remove("visible");
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
            hotelError.classList.add("visible");
            return false;
        } else {
            hotelError.textContent = "";
            hotelError.classList.remove("visible");
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
            ratingsError.classList.add("visible");
            return false;
        } else {
            ratingsError.textContent = "";
            ratingsError.classList.remove("visible");
            return true;
        }
    }
</script>
</body>
</html>
