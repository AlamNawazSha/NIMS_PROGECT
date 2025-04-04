<?php
include 'config.php'; // Include your database connection file

// Handle Status Update
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $order_id]);

    header("Location: admin_orders.php"); // Refresh the page
    exit();
}

// Handle Delete Order
if (isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];

    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);

    header("Location: admin_orders.php"); // Refresh the page
    exit();
}

// Fetch all orders
$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Order Management</title>
    <style>
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

table {
width: 100%;
border-collapse: collapse;
background: white;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
border-radius: 5px;
overflow: hidden;
}

table, th, td {
border: 1px solid #ddd;
}

th, td {
padding: 12px;
text-align: center;
}

th {
background: #007bff;
color: white;
text-transform: uppercase;
}

tr:nth-child(even) {
background: #f9f9f9;
}

button {
padding: 8px 12px;
border: none;
cursor: pointer;
border-radius: 4px;
}

button.approve {
background: #28a745;
color: white;
}

button.reject {
background: #dc3545;
color: white;
}

button.delete {
background: #6c757d;
color: white;
}

button:hover {
opacity: 0.8;
}
    </style>
</head>
<body>

    <h2>Order Management</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($orders as $order) : ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= $order['user_id'] ?></td>
            <td>$<?= $order['total_price'] ?></td>
            <td><?= $order['status'] ?></td>
            <td><?= $order['created_at'] ?></td>
            <td>
                <!-- Update Status -->
                <form method="post" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                    <select name="new_status">
                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="confirmed" <?= $order['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="out for delivery" <?= $order['status'] == 'out for delivery' ? 'selected' : '' ?>>Out for Delivery</option>
                        <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                    </select>
                    <button type="submit" name="update_status">Update</button>
                </form>

                <!-- Delete Order -->
                <form method="post" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                    <button type="submit" name="delete_order" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
