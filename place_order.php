<?php
session_start();
include 'config.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Cart is empty.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect delivery details
    $user_id = $_POST['user_id'] ?? '';
    $user_name = $_POST['user_name'] ?? '';
    $phone = $_POST['user_phone'] ?? '';
    $address = $_POST['user_address'] ?? '';

    if (empty($user_name) || empty($phone) || empty($address)) {
        die("Please fill all delivery fields.");
    }

    // Calculate total
    $total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    // Insert into orders table
    $stmt = $pdo->prepare("INSERT INTO orders (user_id,user_name, phone, address, total_price, status, created_at) VALUES (?,?, ?, ?, ?, 'Pending', NOW())");
    $stmt->execute([$user_id,$user_name, $phone, $address, $total_price]);

    $order_id = $pdo->lastInsertId();

    // Insert each item into order_items
    foreach ($_SESSION['cart'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item['name'], $item['quantity'], $item['price']]);
    }

    // Clear cart
    unset($_SESSION['cart']);

    echo "<script>alert('Order placed successfully!'); window.location.href='cart.php';</script>";
} else {
    echo "Invalid request.";
}
?>

