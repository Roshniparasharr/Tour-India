<!DOCTYPE html>
<html>
<head>
    <title>Available City Packages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #192119;
            color: #bcbcbc;
            padding-top: 20px;
            text-align: center;
        }

        h2 {
            color: #e78e1e;
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            margin: 50px auto;
            width: 80%;
            background-color: #101511;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 10px;
            border: 2px solid #192119;
            text-align: center;
        }

        th {
            background-color: #e78e28;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #37473b;
        }

        .small-font {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
            text-align: center;
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

        .edit-button, .delete-button, .add-button {
            background-color: #cd9258;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin: 10px;
            display: inline-block;
            text-align: center;
            font-size: 16px;
        }

        .edit-button:hover, .delete-button:hover, .add-button:hover {
            background-color: #b67b52;
        }

        .amenities-box {
            text-align: left;
            display: none;
            position: absolute;
            background-color: #192119;
            border: 1px solid #ccc;
            padding: 10px;
            z-index: 1;
        }

        .amenities-box p {
            margin-bottom: 5px;
            color: #ffffff;
        }

        .amenities-text:hover + .amenities-box {
            display: block;
        }

        .navbar { 
            background-color: #192119;
        }

        .navbar a {
            font-size: 2rem;
            padding: 0 1.5rem;
            color: #fff;
        }

        .navbar a:hover {
            color: #E78E28;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="admindashboard.php" class="back-button">Back to Dashboard</a>

    <div class="table-container">
        <h2>Available City Packages</h2>
        <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tourindia";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Execute SQL query to fetch data from city_packages table along with hotel details
        $result = $conn->query("SELECT cp.*, h.hotel_name, h.amenities FROM city_packages cp LEFT JOIN hotels h ON cp.hotelid = h.hotelid");

        if ($result && $result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Package ID</th>"; 
            echo "<th>City</th>";
            echo "<th>Region</th>";
            echo "<th>Days</th>";
            echo "<th>Base Cost</th>";
            echo "<th>Package Name</th>";
            echo "<th>Package Description</th>";
            echo "<th>Hotel Name</th>";
            echo "<th>Hotel Amenities</th>";
            echo "<th>Actions</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["package_id"] . "</td>"; 
                echo "<td>" . $row["city"] . "</td>"; 
                echo "<td>" . $row["region"] . "</td>";
                echo "<td>" . $row["days"] . "</td>";
                echo "<td>" . $row["package_price"] . "</td>";
                echo "<td>" . $row["package_name"] . "</td>";
                echo "<td>" . $row["package_description"] . "</td>";
                echo "<td>" . $row["hotel_name"] . "</td>";
                echo "<td>"; // Hotel Amenities box
                echo "<span class='amenities-text'>Hover here</span>"; // Text to hover for showing amenities box
                echo "<div class='amenities-box'>";
                
                $amenities = explode("\r\n", $row['amenities']);
                foreach ($amenities as $index => $amenity) {
                    echo "<p>" . ($index + 1) . ". {$amenity}</p>"; // Increment index by 1
                }
                echo "</div>";
                echo "</td>";
                echo "<td>";
                echo "<form method='post' action='delete_package.php'>";
                echo "<input type='hidden' name='package_id' value='" . $row["package_id"] . "'>";
                echo "<button type='submit' onclick='return confirmDelete()' class='delete-button'>Delete</button>";
                echo "</form>";
                echo "<a href='edit_package.php?package_id={$row['package_id']}' class='edit-button'>Edit</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No data found.</p>";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>

    <a href="add_package.php" class="add-button">Add Package</a>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this package?");
        }
    </script>
</body>
</html>
