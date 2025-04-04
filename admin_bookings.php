<?php
session_start();
include 'config.php';

// Fetch all bookings
$bookings = $pdo->query("SELECT * FROM table_bookings ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Handle booking status update
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_status'])) {
    $booking_id = $_POST['booking_id'];
    $status = $_POST['new_status']; // FIX: This was previously $_POST['status']

    // 1. Update booking status
    $stmt = $pdo->prepare("UPDATE table_bookings SET status = ? WHERE id = ?");
    $stmt->execute([$status, $booking_id]);

    // 2. Get the user_id from the booking
    $stmt2 = $pdo->prepare("SELECT user_id FROM table_bookings WHERE id = ?");
    $stmt2->execute([$booking_id]);
    $booking = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    if ($booking && $booking['user_id']) {
        $user_id = $booking['user_id'];

        // 3. Insert a notification for the user
        $message = "Your table booking has been $status.";
        $stmt3 = $pdo->prepare("INSERT INTO notifications (user_id, message, status, created_at) VALUES (?, ?, ?, NOW())");
        $stmt3->execute([$user_id, $message, $status]);
    }

    echo "<script>alert('Booking updated and notification sent!'); location.href='admin_bookings.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Table Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #343a40;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .approve {
            background-color: #28a745;
            color: white;
        }
        .reject {
            background-color: #dc3545;
            color: white;
        }
        .delete {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>

    <h2>Table Bookings Management</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Guests</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($bookings as $booking) : ?>
        <tr>
            <td><?= $booking['id'] ?></td>
            <td><?= $booking['name'] ?></td>
            <td><?= $booking['phone'] ?></td>
            <td><?= $booking['guests'] ?></td>
            <td><?= $booking['date'] ?></td>
            <td><?= $booking['time'] ?></td>
            <td><?= $booking['status'] ?></td>
            <td>
                <!-- Approve -->
                <form method="post" style="display:inline;">
                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                    <input type="hidden" name="new_status" value="Confirmed">
                    <button type="submit" name="update_status" class="approve">Approve</button>
                </form>

                <!-- Reject -->
                <form method="post" style="display:inline;">
                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                    <input type="hidden" name="new_status" value="Rejected">
                    <button type="submit" name="update_status" class="reject">Reject</button>
                </form>

                <!-- Delete -->
                <form method="post" style="display:inline;">
                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                    <button type="submit" name="delete_booking" class="delete" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
