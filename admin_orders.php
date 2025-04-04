<?php
session_start();
include 'config.php';

$stmt = $pdo->prepare("SELECT * FROM orders ORDER BY id DESC");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #333;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #333;
    color: white;
    text-transform: uppercase;
}

/* Hover Effect */
tr:hover {
    background-color: #f9f9f9;
}

/* Dropdown Styling */
select {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
}

/* Buttons */
button {
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s;
}

button[name="update_status"] {
    background-color: #007BFF;
    color: white;
}

button[name="update_status"]:hover {
    background-color: #0056b3;
}

button[name="delete_order"] {
    background-color: #dc3545;
    color: white;
}

button[name="delete_order"]:hover {
    background-color: #c82333;
}

/* Responsive Design */
@media (max-width: 768px) {
    table {
        font-size: 12px;
    }

    button {
        font-size: 12px;
        padding: 6px 10px;
    }
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

        .nav-buttons a.home {
            background-color: #007bff;
        }

        .nav-buttons a.home:hover {
            background-color: #0056b3;
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
            <a href="admin_dashboard.php" class="home">Home</a>
            <a href="manage_menu.php">Menu</a>
            <a href="admin_bookings.php">Bookings</a>
            <a href="admin_orders.php">Orders</a>
            <a href="admin_logout.php" class="logout">Logout</a>
        </div>
    </div>
    <h2>Manage Orders</h2>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= $order['user_id'] ?></td>
            <td>₹<?= $order['total_price'] ?></td>
            <td>
            <form method="post" action="update_order.php">
    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
    <select name="status">
        <option value="Pending" <?= ($order['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
        <option value="Confirmed" <?= ($order['status'] == 'Confirmed') ? 'selected' : '' ?>>Confirmed</option>
        <option value="Out for Delivery" <?= ($order['status'] == 'Out for Delivery') ? 'selected' : '' ?>>Out for Delivery</option>
        <option value="Delivered" <?= ($order['status'] == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
    </select>
    <button type="submit" name="update_status">Update</button>
</form>

            </td>
            <td>
                <form method="post" action="delete_order.php">
                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                    <button type="submit" name="delete_order" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
