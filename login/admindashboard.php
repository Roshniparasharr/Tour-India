<?php
session_start(); // Starting the session

// Set the value of $_SESSION['Admin_Name'] if it's not already set
if (!isset($_SESSION['Admin_Name'])) {
    $_SESSION['Admin_Name'] = "Admin"; // Set a default value for Admin_Name
}

// Your existing HTML code
?>

<!DOCTYPE html>
<html>
<head>
  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin Panel</title>
    <style>body {
    margin: 0;
    padding: 0;
    font-size: 20px;
}
.overview {
    margin-left: 75px;
    margin-bottom: 25px;
}
.header {
    background-color: #e84393;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
}

.header h1 {
    margin: 0;
    border-top-color: #FF85F3;
  
}

.navigation ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.navigation li {
    margin-right: 20px;
}

.navigation a {
    text-decoration: none;
    color: white;
}


.sidebar {
    background-color: #333;
    color: cornsilk;
    padding: 20px;
    min-width: 200px;
    box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
} 

.sidebar h2 {
    font-size: 20px;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
}

.sidebar-menu li {
    margin-bottom: 10px;
}

.sidebar-menu a {
    text-decoration: none;
}

.sidebar-footer p {
    margin: 20px 0;
}





.logo {
    position: relative;
}

.logo img {
    position: absolute;
    top: 10px;
    left: 10px;
    width: 30px; 
    height: auto;
    z-index: 2;
}

.sidebar .logo img {
    max-width: 100%;
    height: auto;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
}

.sidebar-menu li {
    margin-bottom: 10px;
}

.sidebar-menu li a {
    display: block;
    padding: 10px 15px;
    color: cornsilk;
    text-decoration: none;
    border-radius: 5px;
}

.sidebar-menu li a:hover {
    background-color: #e78e28;
}

.nav-menu {
    list-style: none;
    padding: 0;
}

.nav-menu li {
    margin-bottom: 10px;
}

.nav-menu li a {
    display: block;
    padding: 10px 15px;
    color: cornsilk;
    text-decoration: none;
    border-radius: 5px;
}

.nav-menu li a:hover {
    color: #4a4a4a;
    background-color: white;
}

.dashboard-overview {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.dashboard-container {
    display: flex;
    justify-content: space-between;
}

.dashboard-widget {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
    width: 40%;
}

.pie-chart-container .dashboard-widget {
    width: 40%; 
}

.dashboard-widget h2 {
    font-size: 20px;
}

.pie-chart {
    max-width: 40%; 
    height: auto; 
}

.userGrowth-chart .dashboard-widget {
    width: 40%;
}

.userLineChart {
    max-width: 40%;
    height: auto; 
}

        body {
            font-family: Arial, sans-serif;
            background-color: #101511;
            color: #333;
            margin: 0;
            padding: 0;
            position: relative; /* Ensure the body covers the whole viewport */
            min-height: 100vh; /* Set minimum height to cover the whole viewport */
        }

        .header {
            background-color: #192119;
            padding: 20px;
            text-align: center;
            color: #e78e28;
        }

        .logo h1 {
            margin: 0;
        }

        .navigation {
            text-align: center;
        }

        .nav-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .nav-menu li {
            display: inline;
            margin-right: 20px;
        }

        .nav-menu li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .nav-menu li a:hover {
            color: #e78e1e;
        }

        .container {
            display: flex;
            flex-direction: row;
        }

        .sidebar {
            background-color: #333;
            color: cornsilk;
            padding: 20px;
            min-width: 200px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar img {
            width: 80px;
            border-radius: 50%;
        }

        .sidebar h2 {
            color: #fff;
            margin-bottom: 10px;
            margin-top: 80px;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar-menu li a:hover {
            color: black;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            left: 20px;    margin-bottom: 100px;
        }

        .sidebar-footer p, .sidebar-footer a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            margin-left: 15px;
        }

        .sidebar-footer a:hover {
            color: #e78e1e;
        }

        .content {
            flex: 1;
            padding: 20px;
            padding-bottom: 60px;
             /* Adjusted padding to accommodate the footer */
        }
        .container {
    display: flex;
    background-color: #f8f8f8;
    min-height: 100vh;
}


        .footer {
            background-color: #192119;
            color: #e78e28;
            text-align: center;
            padding: 10px;
            width: 100%;
            position: fixed; /* Set footer position to fixed */
            bottom: 0;
            left: 0;
        }

        .dashboard-overview {
            margin: 0 0 15px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .dashboard-overview h2 {
            color: #192119;
            margin-bottom: 10px;
        }

        .dashboard-overview p {
            color: #333;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-evenly;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .dashboard-widget {
            width: calc(40% - 20px);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .dashboard-widget:hover {
            transform: translateY(-5px);
        }

        .dashboard-widget h2 {
            color: #192119;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .dashboard-widget p {
            color: #666;
            margin-bottom: 20px;
        }

        /* Add this CSS to your existing CSS */
        .action-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e78e28; /* Button background color */
            color: #fff; /* Button text color */
            text-decoration: none;
            border-radius: 5px;
            margin: 20px;
            font-weight: bold;
            transition: background-color 0.3s;
            text-align: center;
        }

        .action-button:hover {
            background-color: #cd9258;
            color: black; /* Button hover background color */
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Admin Panel</h1>
        </div>
    </header>

    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="silhouette.png" alt="Silhouette Image"><br><br>
            </div>
            <h2>Welcome back, <?php echo isset($_SESSION['Admin_Name']) ? $_SESSION['Admin_Name'] : ''; ?></h2>
            <ul class="sidebar-menu">
                <li><a href="admindashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="adminviewusers.php"><i class="fa fa-users"></i> User Management</a></li>
                <li><a href="adminviewjourneys.php"><i class="fa fa-pencil"></i> Update Packages</a></li>
                <li><a href="adminhotels.php"><i class="fa fa-pencil"></i> Update Hotel</a></li>
                <li><a href="adminusers.php"><i class="fa fa-edit"></i> Admin Management</a></li>
            </ul>
            <div class="sidebar-footer">
                <p>Logged in as Admin</p>
                <a href="../home.php"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>

        <div class="content">
            <div class="overview">
            <h2>Dashboard Overview</h2>
            <p>Welcome to Admin Dashboard. Here, you can manage Packages, Users, and Hotels of the website.</p>
            </div>
            <div class="dashboard-container">
                <div class="dashboard-widget">
                    <h2>Update Users</h2>
                    <p>Manage user accounts and permissions.</p>
                    <a href="adminviewusers.php" class="action-button">Go to Users</a>
                </div>
                <div class="dashboard-widget">
                    <h2>Update Admins</h2>
                    <p>Manage admin accounts and permissions.</p>
                    <a href="adminusers.php" class="action-button">Go to Admins</a>
                </div>
                <div class="dashboard-widget">
                    <h2>Update Packages</h2>
                    <p>Manage tour packages and itineraries.</p>
                    <a href="adminviewjourneys.php" class="action-button">Go to Packages</a>
                </div>
                <div class="dashboard-widget">
                    <h2>Update Hotels</h2>
                    <p>Manage hotel details and amenities.</p>
                    <a href="adminhotels.php" class="action-button">Go to Hotels</a>
                </div>
                <div class="dashboard-widget">
                    <h2>View Reviews</h2>
                    <p>Manage reviews and feedbacks.</p>
                    <a href="../login/reviewsedit.php" class="action-button">Go to reviews</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Admin Panel</p>
    </footer>

    <script>
        var userPieData = {
            labels: ['Admins', 'Regular Users', 'Guests'],
            datasets: [{
                data: [30, 60, 10],
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384']
            }]
        };

        var userPieChart = new Chart(document.getElementById('userPieChart'), {
            type: 'pie',
            data: userPieData
        });
    </script>
</body>
</html>
