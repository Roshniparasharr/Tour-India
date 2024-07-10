<!DOCTYPE html>
<html>
<head>
    <title>Admin Hotels</title>
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
            width: 100%;
            border-collapse: collapse;
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

        .button {
            background-color: #cd9258;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin: 10px;
            font-size: 16px;
        }

        .button:hover {
            background-color: #b67b52;
        }

        .add-button {
            background-color: #cd9258;
        }

        .add-button:hover {
            background-color: #b67b52;
        }

        .back-button {
            background-color: #cd9258;
        }

        .back-button:hover {
            background-color: #b67b52;
        }

        .small-font {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

<a href="admindashboard.php" class="button back-button">Back to Dashboard</a>
    <div class="table-container">
        <h2>Admin Hotels</h2>

        <?php
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

        // Function to fetch hotel data
        function fetchHotels($conn) {
            $sql = "SELECT * FROM hotels";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return array();
            }
        }


        $hotels = fetchHotels($conn);
        ?>

        <p class="small-font">(Total Hotels: <?php echo count($hotels); ?>)</p>

        <table>
            <tr>
                <th>Hotel ID</th>
                <th>Hotel Name</th>
                <th>Description</th>
                <th>Amenities</th>
                <th>Ratings</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($hotels as $hotel) : ?>
                <tr>
                    <td><?php echo $hotel['hotelid']; ?></td>
                    <td><?php echo $hotel['hotel_name']; ?></td>
                    <td><?php echo $hotel['description']; ?></td>
                    <td><?php echo $hotel['amenities']; ?></td>
                    <td><?php echo $hotel['ratings']; ?></td>
                    <td>
                    <form method="post" action="../login/editHotel.php">
    <input type="hidden" name="hotelid" value="<?php echo isset($hotel['hotelid']) ? $hotel['hotelid'] : ''; ?>">
    <input type="submit" value="Edit" class="button">
</form>


                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        
    </div>

    <?php $conn->close(); ?>
</body>
</html>
