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

<!-- Analys -->

<?php
include 'config.php';

// Total Orders
$totalOrdersStmt = $pdo->prepare("SELECT COUNT(*) as total FROM orders");
$totalOrdersStmt->execute();
$totalOrders = $totalOrdersStmt->fetch(PDO::FETCH_ASSOC)['total'];

// Total Table Bookings
$totalBookingsStmt = $pdo->prepare("SELECT COUNT(*) as total FROM table_bookings");
$totalBookingsStmt->execute();
$totalBookings = $totalBookingsStmt->fetch(PDO::FETCH_ASSOC)['total'];

// Most Frequently Ordered Item
$topItemStmt = $pdo->prepare("
    SELECT item_name, COUNT(*) AS item_count
    FROM order_items
    GROUP BY item_name
    ORDER BY item_count DESC
    LIMIT 1
");
$topItemStmt->execute();
$topItem = $topItemStmt->fetch(PDO::FETCH_ASSOC);

$topGuestsStmt = $pdo->prepare("
    SELECT guests, COUNT(*) AS guest_count
    FROM table_bookings
    WHERE MONTH(date) = MONTH(CURRENT_DATE())
      AND YEAR(date) = YEAR(CURRENT_DATE())
      AND status = 'Confirmed'
    GROUP BY guests
    ORDER BY guest_count DESC
    LIMIT 1
");

$topGuest = ['guests' => 'N/A', 'guest_count' => 0]; // default

if ($topGuestsStmt->execute()) {
    $result = $topGuestsStmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $topGuest = $result;
    }
}


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

/* Analys */

.dashboard-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin: 30px;
}

.card {
  padding: 20px;
  color: #fff;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.15);
  transition: 0.3s ease;
  text-align: center;
}

.card:hover {
  transform: translateY(-5px);
}

.total-orders {
  background: linear-gradient(135deg, #36D1DC, #5B86E5);
}

.total-bookings {
  background: linear-gradient(135deg, #ff758c, #ff7eb3);
}

.top-item {
  background: linear-gradient(135deg, #43e97b, #38f9d7);
}

.top-guests {
  background: linear-gradient(135deg, #f093fb, #f5576c);
}

.card h3 {
  font-size: 20px;
  margin-bottom: 10px;
  font-weight: 600;
}

.card p {
  font-size: 28px;
  font-weight: bold;
  margin: 5px 0;
}

.card small {
  font-size: 14px;
  opacity: 0.9;
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

    <div class="dashboard-cards">
  <!-- Total Orders -->
  <div class="card total-orders">
    <h3>Total Orders</h3>
    <p><?php echo $totalOrders; ?></p>
  </div>

  <!-- Total Table Bookings -->
  <div class="card total-bookings">
    <h3>Total Table Bookings</h3>
    <p><?php echo $totalBookings; ?></p>
  </div>

  <!-- Most Frequently Ordered Item -->
  <div class="card top-item">
    <h3>Top Ordered Item</h3>
    <p><?php echo $topItem['item_name']; ?></p>
    <small>Ordered <?php echo $topItem['item_count']; ?> times</small>
  </div>

  <!-- Most Booked Guest Count -->
  <div class="card top-guests">
  <h3>Most Booked Guest Count</h3>
  <p><?php echo htmlspecialchars($topGuest['guests']); ?> Guests</p>
  <small>Booked <?php echo htmlspecialchars($topGuest['guest_count']); ?> times</small>
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
