<?php
session_start();

// Initialize $packageName with an empty string
$packageName = '';

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourindia";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store package details
$hotelName = $initialCost = '';
$name = $email = $contact = '';

// Check if package_id and package_name are set in the URL
if(isset($_GET['package_id']) && isset($_GET['package_name'])) {
    // Escape special characters and prevent SQL injection
    $packageId = $conn->real_escape_string($_GET['package_id']);
    // Decode URL-encoded package name
    $packageName = urldecode($_GET['package_name']); 

    // Query to fetch package details along with hotel information based on package_id
    $sql = "SELECT cp.*, h.hotel_name FROM city_packages cp
            INNER JOIN hotels h ON cp.hotelid = h.hotelid
            WHERE cp.package_id = '$packageId'";
    $result = $conn->query($sql);

    // Check if the query was successful and if any rows were returned
    if ($result && $result->num_rows > 0) {
        // Fetch the row of package details
        $row = $result->fetch_assoc();
        // Assign retrieved package and hotel details to variables
        $hotelName = $row['hotel_name'];
        // Fetch other package details as needed
        $initialCost = $row['package_price'];
    } else {
        echo "Package details not found.";
    }
} else {
    echo "Package ID or Name not provided.";
}

// Fetch user details based on logged-in user's email
if(isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];
    $userDetailsQuery = "SELECT * FROM login WHERE usersEmail = '$userEmail'";
    $userDetailsResult = $conn->query($userDetailsQuery);

    if ($userDetailsResult && $userDetailsResult->num_rows > 0) {
        $userDetails = $userDetailsResult->fetch_assoc();
        // Assign user details to variables
        $name = $userDetails['firstname'] . ' ' . $userDetails['lastname'];
        $email = $userDetails['usersEmail'];
        $contact = $userDetails['number'];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape special characters and prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $tourists = $conn->real_escape_string($_POST['tourists']);
    $date = $conn->real_escape_string($_POST['date']);
    $paymentMethod = $conn->real_escape_string($_POST['payment_method']); // Retrieve mode of payment

    // Calculate total amount based on package price and number of tourists
    $totalAmount = $initialCost * $tourists;

    // Insert booking details into the database
    $insertQuery = "INSERT INTO bookings (package_id, name, email, contact_number, number_of_tourists, date, total_amount, mode_of_payment) 
                    VALUES ('$packageId', '$name', '$email', '$contact', '$tourists', '$date', '$totalAmount', '$paymentMethod')";

    if ($conn->query($insertQuery) === TRUE) {
        // Display success message using JavaScript alert
        echo '<script>alert("Booking successful!");</script>';
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
   
    <style>
        /* Global Styles */
        body {
            background-color: #192119;
            color: #212529;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #e78e28;
            text-align: center;
        }

        /* Card Container Styles */
        .card-container {
            background-color: #101511;
            border-radius: 10px;
            width: 550px;
            margin: 20px auto;
            padding: 50px;
        }

        /* Form Styles */
        form {
            text-align: center;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="date"],
        input[type="tel"],
        select {
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 15px;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        input[type="tel"]:focus,
        button:focus,
        select:focus {
            outline: none;
        }

        /* Add equal vertical spacing between form elements */
        input,
        select,
        button {
            margin-top: 15px;
        }

        /* Adjust margin specifically for email input */
        input[type="email"] {
            margin-bottom: 25px;
        }

        /* Cost Display Styles */
        p {
            text-align: center;
            font-weight: bold;
            color: #b4b4b4;
        }

        #calculatedCost {
            color: #e78e1e;
            font-size: 22px;
        }

        /* Button Styles */
        button[name="submit"] {
            background-color: #e78e1a;
            color: #000;
            cursor: pointer;
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 15px;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[name="submit"]:hover {
            background-color: #e78e1a;
            color: #fff;
            cursor: pointer;
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 15px;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[name="Payment"] {
            background-color: #cd9258;
            color: #000;
            cursor: pointer;
            font-size: 13px;
            padding: 8px 16px;
            border-radius: 5px;
            width: calc(30% - 20px);
            margin: 10px auto;
            padding: 12px;
            box-sizing: border-box;
        }

        button[name="Payment"]:hover {
            color: #fff;
            background-color: #cd9258;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .center-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-link {
            display: inline-block;
            text-decoration: none;
            color: #000;
            background-color: #e78e1a;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }

        .button-link:hover {
            color: #fff;
            background-color: #cd9258;
        }

    </style>

</head>
<body>
<div class="card-container">
    <div class="booking-details">
        <h2>Booking Details</h2>
        <!-- Display package and hotel details -->
        <p>Package Name: <?php echo $packageName; ?></p>
        <p>Hotel Name: <?php echo $hotelName; ?></p>
    </div>

    <form id="bookingForm" method="post" action="">
        <h2>Booking Form</h2>
        <!-- Input fields for user information -->
        <input type="text" name="name" placeholder="Name" value="<?php echo isset($name) ? $name : ''; ?>" required><br>
        <input type="email" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : ''; ?>" required><br>
        <input type="tel" name="contact" placeholder="Contact Number" value="<?php echo isset($contact) ? $contact : ''; ?>" required><br>
        <input type="number" name="tourists" id="touristsInput" placeholder="Number of Tourists" required><br>
        <input type="date" name="date" id="date" min="<?php echo date('Y-m-d'); ?>" required><br>

        <!-- Display initial cost -->
        <p>Total Cost: Rs. <span id="calculatedCost"><?php echo isset($initialCost) ? $initialCost : 0; ?></span></p>
        
        <select name="payment_method" id="paymentMethod" required>
            <option value="" disabled selected>Select Payment Method</option>
            <option value="online">Online Payment</option>
            <option value="cash">Cash on Arrival</option>
        </select><br>

        <!-- Submit button -->
        <button type="submit" name="submit" id="submitBtn" disabled>Book Package</button>
    </form>
    <div class="center-button">
        <a href="./login/loggedinhome.php" class="button-link">Explore more</a>
    </div>
</div>

<?php
// Display success message if booking was successful
if (isset($bookingSuccess) && $bookingSuccess === true) {
    echo '<div class="modal">
              <div class="modal-content">
                  <span class="close">&times;</span>
                  <p>Booking Successful!</p>
              </div>
          </div>';
}
?>

<script>
    // JavaScript to enable/disable book package button based on form validation
    const bookingForm = document.getElementById("bookingForm");
    const submitBtn = document.getElementById("submitBtn");
    const paymentMethod = document.getElementById("paymentMethod");

    bookingForm.addEventListener("input", function() {
        const name = bookingForm.elements["name"].value;
        const email = bookingForm.elements["email"].value;
        const contact = bookingForm.elements["contact"].value;
        const tourists = bookingForm.elements["tourists"].value;
        const date = bookingForm.elements["date"].value;

        // Enable/disable submit button based on form validation
        if (name && email && contact && tourists && date && paymentMethod.value === "cash") {
            submitBtn.removeAttribute("disabled");
        } else {
            submitBtn.setAttribute("disabled", "disabled");
        }
    });

    // JavaScript to close modal
    const modal = document.querySelector(".modal");
    const closeModal = document.querySelector(".close");

    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
    });
</script>

</body>
</html>
