<!DOCTYPE html>
<html>
<head>
    <title>Admin Users</title>
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

        .data-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #bcbcbc;
        }

        .data-table th {
            background-color: #e78e28;
            color: #ffffff;
        }

        .data-table td {
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

        /* Tooltip CSS */
        .tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip .tooltiptext {
    visibility: hidden;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 10px; /* Adjust padding as needed */
    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s;
}


        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>
    <a href="admindashboard.php" class="back-button">Back to Dashboard</a>
    <div class="table-container">
        <h2>All Users</h2>
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

        // Fetch user data
        $sql = "SELECT * FROM login";
        $result = $conn->query($sql);
        ?>
        <p class="small-font">(Total Users: <!-- PHP code for total users goes here -->)</p>
        <table class="data-table">
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Number</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Email</th>
                <th>Password</th>
                <th>User Aadhar</th>
                <th>Action</th>
            </tr>
            <!-- PHP while loop for users data -->
            <?php
            // Assuming your database connection and query logic is here and is correct
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['usersid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['number']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['usersEmail']) . "</td>";
                    // Updated password field with tooltip
                    echo "<td><div class='tooltip'>Hover here<span class='tooltiptext'>" . htmlspecialchars($row['password']) . "</span></div></td>";
                    echo "<td>" . htmlspecialchars($row['userAadhar']) . "</td>";
                    echo "<td>
                            <form method='post' action='delete_user.php'>
                                <input type='hidden' name='usersid' value='" . $row['usersid'] . "'>
                                <input type='submit' value='Delete' class='button delete-button' onclick=\"return confirm('Are you sure you want to delete this user?');\">
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No records found.</td></tr>";
            }
            ?>
            <!-- End PHP while loop -->
        </table>
    </div>
</body>
</html>


