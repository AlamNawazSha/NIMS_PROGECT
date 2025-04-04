<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to place an order.");
}
$user_id = $_SESSION['user_id'];


// If cart is empty but still showing items, force clear it
if (empty($_SESSION['cart'])) {
    unset($_SESSION['cart']); // 🔥 This ensures no old session data remains
    $_SESSION['cart'] = [];   // Reinitialize empty cart
}

// Handle adding items to the cart
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if (!empty($id) && !empty($name) && !empty($price)) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'quantity' => $quantity
            ];
        }
    }

    header("Location: cart.php");
    exit();
}

// Handle removing an item from the cart
if (isset($_POST['remove_item'])) {
    $id = $_POST['id'];

    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]); // ✅ Removes only selected item
    }

    // Check if cart is completely empty, then unset it to remove default items
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
        $_SESSION['cart'] = []; // Reinitialize empty cart
    }

    header("Location: cart.php");
    exit();
}

// Handle updating quantity
if (isset($_POST['update_quantity'])) {
    $id = $_POST['id'];
    $quantity = max(1, intval($_POST['quantity']));

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] = $quantity;
    }

    header("Location: cart.php");
    exit();
}

// Calculate total price
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>


<?php
if (isset($_POST['place_order'])) {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<script>alert('Your cart is empty!');</script>";
        exit;
    }

    $user_name = $_POST['user_name'];
    $user_phone = $_POST['user_phone'];
    $user_address = $_POST['user_address'];

    if (empty($user_name) || empty($user_phone) || empty($user_address)) {
        echo "<script>alert('Please fill all delivery details.');</script>";
        exit;
    }

    // Insert into orders
    $total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price, user_name, user_phone, user_address) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $total_price, $user_name, $user_phone, $user_address]);

    $order_id = $pdo->lastInsertId();

    foreach ($_SESSION['cart'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item['name'], $item['quantity'], $item['price']]);
    }

    unset($_SESSION['cart']);
    header("Location: order_success.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 20px; }
        .cart-container { width: 80%; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        .cart-item { display: flex; align-items: center; justify-content: space-between; padding: 15px; border-bottom: 1px solid #ddd; }
        .cart-item img { width: 70px; height: 70px; border-radius: 5px; margin-right: 15px; }
        .cart-item div { flex-grow: 1; }
        .cart-item h4, .cart-item p { margin: 5px 0; }
        .cart-item input { width: 50px; padding: 5px; text-align: center; }
        .cart-total { font-size: 18px; font-weight: bold; text-align: right; padding: 15px 0; }
        .cart-actions { text-align: right; padding-top: 15px; }
        .btn { padding: 10px 15px; border: none; cursor: pointer; border-radius: 5px; }
        .btn-update { background-color: #4CAF50; color: white; }
        .btn-remove { background-color: #FF5733; color: white; }
        .btn-place-order { background-color: #007BFF; color: white; font-size: 16px; }

        <style>
.cart-actions {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 40px auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
    font-family: 'Segoe UI', sans-serif;
}

.cart-actions input[type="text"] {
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.cart-actions input[type="text"]:focus {
    border-color: #007BFF;
    outline: none;
}

.btn-place-order {
    padding: 12px;
    font-size: 16px;
    border: none;
    background-color: #28a745;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-place-order:hover {
    background-color: #218838;
}
</style>

    </style>
</head>
<body>

<div class="cart-container">
    <h2>Your Shopping Cart</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <div class="cart-item">
                <img src="uploads/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                <div>
                    <h4><?= htmlspecialchars($item['name']); ?></h4>
                    <p>₹<?= number_format($item['price'], 2); ?> each</p>
                </div>
                
                <form action="cart.php" method="post">
                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                    <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1">
                    <button type="submit" name="update_quantity" class="btn btn-update">Update</button>
                </form>

                <form action="cart.php" method="post">
                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                    <button type="submit" name="remove_item" class="btn btn-remove">Remove</button>
                </form>
            </div>
        <?php endforeach; ?>

        <p class="cart-total">Total: ₹<?= number_format($total, 2); ?></p>

        <form method="post" action="cart.php">
    <div class="cart-actions">
        <input type="text" name="user_name" placeholder="Your Name" required>
        <input type="text" name="user_phone" placeholder="Phone Number" required>
        <input type="text" name="user_address" placeholder="Delivery Address" required>
        <button type="submit" name="place_order" class="btn btn-place-order">Place Order</button>
    </div>
</form>


</form>

    
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

</body>
</html>
