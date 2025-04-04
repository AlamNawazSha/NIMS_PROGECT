<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Please log in to view your orders.");
}

$user_id = $_SESSION['user_id'];

// Handle order cancellation
if (isset($_POST['cancel_order'])) {
    $order_id = $_POST['order_id'];

    // Only allow cancel if the order belongs to this user and not already cancelled/delivered
    $check = $pdo->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ? AND status NOT IN ('cancelled', 'delivered')");
    $check->execute([$order_id, $user_id]);

    if ($check->rowCount() > 0) {
        $pdo->prepare("UPDATE orders SET status = 'cancelled' WHERE id = ?")->execute([$order_id]);
        echo "<script>alert('Order #$order_id has been cancelled'); window.location.href='user_orders.php';</script>";
        exit;
    }
}

// Fetch orders
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch related items
$order_items = [];
foreach ($orders as $order) {
    $stmt_items = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt_items->execute([$order['id']]);
    $order_items[$order['id']] = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST['cancel_booking'])) {
    $booking_id = $_POST['cancel_booking_id'];

    // Update booking status to Cancelled
    $stmt = $pdo->prepare("UPDATE table_bookings SET status = 'Rejected' WHERE id = ? AND user_id = ?");
    $stmt->execute([$booking_id, $user_id]);

    echo "<script>alert('Booking cancelled successfully.'); window.location.href='user_orders.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .orders-container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        .order-items {
            margin-top: 10px;
            padding-left: 15px;
        }

        .item {
            margin-bottom: 8px;
        }

        .status {
            text-transform: capitalize;
        }

        .cancel-btn {
            padding: 6px 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }

        .cancel-form {
            margin-top: 10px;
        }


    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #f8f8f8;
        color: #333;
    }

    button {
        padding: 6px 12px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #c82333;
    }

    </style>
</head>
<body>

<div class="orders-container">
    <h2>Your Orders</h2>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td>₹<?= number_format($order['total_price'], 2) ?></td>
                <td class="status"><?= htmlspecialchars($order['status']) ?></td>
                <td><?= $order['created_at'] ?></td>
                <td>
                    <?php if (!in_array($order['status'], ['cancelled', 'delivered'])): ?>
                        <form method="post" class="cancel-form">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            <button type="submit" name="cancel_order" class="cancel-btn">Cancel</button>
                        </form>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div class="order-items">
                        <?php foreach ($order_items[$order['id']] as $item): ?>
                            <div class="item">
                                <?= htmlspecialchars($item['item_name']) ?> - ₹<?= $item['price'] ?> × <?= $item['quantity'] ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Your Table Bookings</h2>
<table border="1">
    <tr>
        <th>Booking ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Guests</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM table_bookings WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($bookings as $booking) :
    ?>
        <tr>
            <td><?= $booking['id'] ?></td>
            <td><?= htmlspecialchars($booking['name']) ?></td>
            <td><?= htmlspecialchars($booking['phone']) ?></td>
            <td><?= $booking['guests'] ?></td>
            <td><?= $booking['date'] ?></td>
            <td><?= $booking['time'] ?></td>
            <td><?= ucfirst($booking['status']) ?></td>
            <td>
                <?php if ($booking['status'] === 'Pending' || $booking['status'] === 'Confirmed'): ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="cancel_booking_id" value="<?= $booking['id'] ?>">
                        <button type="submit" name="cancel_booking" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                    </form>
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</div>

</body>
</html>
