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
    </style>
</head>
<body>
    <a href="admindashboard.php" class="back-button">Back to Dashboard</a>
    <div class="table-container">
        <h2>All Admins</h2>
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

        // Fetch admin login data
        $sql = "SELECT srno, Admin_Name FROM admin_login";
        $result = $conn->query($sql);
        ?>
        <p class="small-font">(Total Admins: <?php echo $result->num_rows; ?>)</p>
        <table class="data-table">
            <tr>
                <th>Sr No.</th>
                <th>Admin Name</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['srno'] . "</td>";
                    echo "<td>" . $row['Admin_Name'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No records found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
