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

    </style>
</head>
<body>
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
