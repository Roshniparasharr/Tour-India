<?php

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

$selectedRegions = [];
$selectedSeasons = [];
$selectedDays = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve filter values from the form
    $selectedRegions = isset($_POST["region"]) ? $_POST["region"] : [];
    $selectedSeasons = isset($_POST["season"]) ? $_POST["season"] : [];
    $selectedDays = isset($_POST["days"]) ? $_POST["days"] : [];
}

// Build the SQL query based on selected filters
$sql = "SELECT * FROM city_packages WHERE 1"; 

if (!empty($selectedRegions)) {
    if (!in_array("All", $selectedRegions)) {
        $sql .= " AND region IN ('" . implode("','", $selectedRegions) . "')";
    }
} else {
    $selectedRegions = ["All"]; 
}

if (!empty($selectedSeasons)) {
    if (!in_array("All", $selectedSeasons)) {
        $sql .= " AND season IN ('" . implode("','", $selectedSeasons) . "')";
    }
} else {
    $selectedSeasons = ["All"]; 
}

if (!empty($selectedDays)) {
    if (!in_array("All", $selectedDays)) {
        $sql .= " AND days IN ('" . implode("','", $selectedDays) . "')";
    }
} else {
    $selectedDays = ["All"]; 
}

// Execute the SQL query
$result = $conn->query($sql);

// Check for errors in query execution
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Echo the SQL query for debugging
echo "SQL Query: " . $sql . "<br>";

// Create an array to store the data
$data = [];

// Loop through the results and add them to the array
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./style/css/cities.css">
    <script>
        function toggleDropdown(filterName) {
            var dropdownContent = document.getElementById(filterName + "Dropdown");
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        }
    </script>
    <style>
        h1 {
    color: #e84393;
    text-align: center;
    margin: 20px 0 40px;
}
table {
    border-collapse: separate;
    border-width: 50px;
    width: 80%;
    text-align: center;
    margin:0 auto;
    border-radius: 2px;

}
table, th, td {
    border: 1px solid #e84393;
    text-align: center; 
    padding: 15px 25px 15px;
}
    </style>
</head>
<body>
    <div class="navbar">
    <span class="logo">Travelscapes</span>
</div>
<div class="content-container">
    <h1>Travel Packages</h1>
    
    <?php
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>City ID</th>"; 
    echo "<th>City</th>";
    echo "<th>Region</th>";
    echo "<th>Season</th>";
    echo "<th>Days</th>";
    echo "<th>Cost</th>";
    echo "<th>Action</th>";
    echo "</tr>";

    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . $row["cityid"] . "</td>"; 
        echo "<td>" . $row["city"] . "</td>"; 
        echo "<td>" . $row["region"] . "</td>";
        echo "<td>" . $row["season"] . "</td>";
        echo "<td>" . $row["days"] . "</td>";
        echo "<td>Rs " . $row["cost"] . "</td>";
        echo "<td><a href='viewjourney.php?city_id=" . $row["cityid"] . "' class='view-button'>View Journey</a></td>"; 
        echo "</tr>";
    }

    echo "</table>";
    $conn->close();
    ?>
    </div>
    <footer>
    <p>&copy; 2024 TourIndia. All rights reserved.</p>
</footer>


</body>

</html>
