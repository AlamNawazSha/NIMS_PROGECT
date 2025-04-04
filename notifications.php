<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit;
}

include 'config.php';
$user_id = $_SESSION['user_id'];

// Mark table notifications as read
$pdo->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?")->execute([$user_id]);

// Fetch table booking notifications
$stmt1 = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$stmt1->execute([$user_id]);
$table_notifications = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// Mark order notifications as read
$pdo->prepare("UPDATE order_notifications SET status = 'read' WHERE user_id = ?")->execute([$user_id]);

// Fetch order notifications
$stmt2 = $pdo->prepare("SELECT * FROM order_notifications WHERE user_id = ? ORDER BY created_at DESC");
$stmt2->execute([$user_id]);
$order_notifications = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h2, h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .notification {
            padding: 20px;
            margin-bottom: 15px;
            border-left: 5px solid #007bff;
            background: #f9fbfc;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .notification .message {
            font-size: 16px;
            color: #444;
        }
        .notification .status {
            margin-top: 10px;
            font-weight: bold;
        }
        .status-Confirmed {
            color: #28a745;
        }
        .status-Rejected {
            color: #dc3545;
        }
        .status-read {
            color: #6c757d;
        }
        .notification small {
            display: block;
            margin-top: 5px;
            color: #777;
            font-size: 12px;
        }
        .section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Notifications</h2>

        <div class="section">
            <h3>📅 Table Booking Notifications</h3>
            <?php if (empty($table_notifications)): ?>
                <p style="text-align: center;">No table booking notifications yet.</p>
            <?php else: ?>
                <?php foreach ($table_notifications as $note): ?>
                    <div class="notification">
                        <div class="message"><?= htmlspecialchars($note['message']) ?></div>
                        <div class="status status-<?= htmlspecialchars($note['status']) ?>">
                            Status: <?= htmlspecialchars($note['status']) ?>
                        </div>
                        <small>Received on <?= date("F j, Y, g:i a", strtotime($note['created_at'])) ?></small>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="section">
            <h3>🛒 Order Notifications</h3>
            <?php if (empty($order_notifications)): ?>
                <p style="text-align: center;">No order notifications yet.</p>
            <?php else: ?>
                <?php foreach ($order_notifications as $note): ?>
                    <div class="notification">
                        <div class="message"><?= htmlspecialchars($note['message']) ?></div>
                        <div class="status status-<?= htmlspecialchars($note['status']) ?>">
                            Status: <?= htmlspecialchars($note['status']) ?>
                        </div>
                        <small>Received on <?= date("F j, Y, g:i a", strtotime($note['created_at'])) ?></small>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
