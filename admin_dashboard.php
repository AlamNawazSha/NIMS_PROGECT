<?php
session_start();

// Block access if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Prevent back navigation to login page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        /* Navbar */
        .navbar {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 30px;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar h1 {
            margin: 0;
            font-size: 22px;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
        }

        .nav-buttons a {
            color: white;
            text-decoration: none;
            background: #28a745;
            padding: 8px 16px;
            border-radius: 6px;
            transition: 0.3s;
            font-weight: bold;
        }

        .nav-buttons a:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .nav-buttons a.logout {
            background-color: #dc3545;
        }

        .nav-buttons a.logout:hover {
            background-color: #c82333;
        }

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.08);
        }

        .button {
            display: block;
            width: 240px;
            padding: 12px;
            margin: 20px auto;
            background: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .button:hover {
            background: #0056b3;
            transform: translateY(-3px);
        }

        /* Animation on load */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>🍽️ Admin Dashboard</h1>
        <div class="nav-buttons">
            <a href="home.php" class="home">Home</a>
            <a href="manage_menu.php">Menu</a>
            <a href="admin_bookings.php">Bookings</a>
            <a href="admin_orders.php">Orders</a>
            <a href="admin_logout.php" class="logout">Logout</a>
        </div>
    </div>

    <div class="container fade-in">
        <a href="manage_menu.php" class="button">Manage Menu</a>
        <a href="admin_bookings.php" class="button">Manage Table Bookings</a>
        <a href="admin_orders.php" class="button">Manage Orders</a>
    </div>

    <!-- 💡 JS to prevent back navigation -->
    <script>
        // Prevent browser back button from showing the login page
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.pushState(null, null, location.href);
        };
    </script>

</body>
</html>
