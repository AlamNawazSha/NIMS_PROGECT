<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php'; 

echo "Database connection successful!";
?>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #000000;
            background: linear-gradient(to right, #000000, #000000);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button {
            background-color: hsl(38, 61%, 73%);
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
        }

        .container button.hidden {
            background-color: transparent;
            border-color: #fff;
        }

        .container form {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input {
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            border: 1px solid #ccc;
            border-radius: 20%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 40px;
            height: 40px;
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        .toggle {
            background-color: hsl(38, 61%, 73%);
            height: 100%;
            background: hsl(38, 61%, 73%);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }
    </style>



<section class="section menu" aria-label="menu-label" id="menu">
        <div class="container">
        
          <p class="section-subtitle text-center label-2">Special Selection</p>

          <h2 class="headline-1 section-title text-center">Delicious Menu</h2>

          <ul class="grid-list">

          <?php foreach ($menu_items as $item): ?>
            <li>
            <a href="additem.php">
              <div class="menu-card hover:card">

                <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                  <!-- <img src="./assets/images/menu-1.png" width="100" height="100" loading="lazy" alt="Greek Salad" class="img-cover"> -->
                  <img src="uploads/<?= ($item['image']) ?>" alt="<?= ($item['name']) ?>" width="100" height="100">
                </figure>

                <div>

                  <div class="title-wrapper">
                    
                      <h3 class="title-3"><?= ($item['name']) ?></h3>
                   

                  
                      <span class="span title-2">₹<?= ($item['price']) ?></span>

                  </div>

                 
                  <p class="card-text label-1"><?= ($item['description']) ?></p>
               

                </div>

              </div>
              </a>
            </li>
          <?php endforeach; ?>
          </ul>

          <p class="menu-text text-center">
            During winter daily from <span class="span">7:00 pm</span> to <span class="span">9:00 pm</span>
          </p>

          <a href="fullmenu.php" class="btn btn-primary">
            <span class="text text-1">View All Menu</span>

          <span class="text text-2" aria-hidden="true">View All Menu</span>
          </a>

          <img src="./assets/images/shape-5.png" width="921" height="1036" loading="lazy" alt="shape"
            class="shape shape-2 move-anim">
          <img src="./assets/images/shape-6.png" width="343" height="345" loading="lazy" alt="shape"
            class="shape shape-3 move-anim">
        
        </div>
      </section>




      <?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please log in to place an order.");
}

$user_id = $_SESSION['user_id'];
$total_price = 0;

// Fetch cart items from session or database
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    try {
        $pdo->beginTransaction();

        // Insert into orders table
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
        $stmt->execute([$user_id, $total_price]);
        $order_id = $pdo->lastInsertId();

        // Insert order items
        foreach ($_SESSION['cart'] as $food_id => $cartItem) {
            $quantity = $cartItem['quantity'];
            $price = $cartItem['price'];
            $total_price += $price * $quantity;

            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, food_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$order_id, $food_id, $quantity, $price]);
        }

        // Update total price in orders table
        $stmt = $pdo->prepare("UPDATE orders SET total_price = ? WHERE id = ?");
        $stmt->execute([$total_price, $order_id]);

        $pdo->commit();
        
        // Clear Cart After Order
        unset($_SESSION['cart']);

        echo "Order placed successfully!";
        header("Location: user_orders.php");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Error placing order: " . $e->getMessage());
    }
} else {
    die("Cart is empty. Add items to place an order.");
}
?>



<!-- notification order-->

<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch notifications
$stmt = $pdo->prepare("SELECT * FROM order_notifications WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute([':user_id' => $user_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Optional: Mark all as read
$pdo->prepare("UPDATE order_notifications SET status = 'read' WHERE user_id = :user_id")->execute([':user_id' => $user_id]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Notifications</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f8f8f8; }
        .notification {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .unread { border-left: 5px solid #007bff; }
    </style>
</head>
<body>

<h2>Your Notifications</h2>

<?php if (empty($notifications)): ?>
    <p>No notifications yet.</p>
<?php else: ?>
    <?php foreach ($notifications as $note): ?>
        <div class="notification <?= $note['status'] === 'unread' ? 'unread' : '' ?>">
            <strong><?= htmlspecialchars($note['message']) ?></strong><br>
            <small><?= date('d M Y, h:i A', strtotime($note['created_at'])) ?></small>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>



<!-- notification table  -->


<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit;
}

include 'config.php';

$user_id = $_SESSION['user_id'];

// Mark all as read
$pdo->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?")->execute([$user_id]);

// Fetch notifications
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
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
        .notification small {
            display: block;
            margin-top: 5px;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Notifications</h2>
        <?php if (empty($notifications)): ?>
            <p style="text-align: center;">🎉 No notifications yet. Book a table to get started!</p>
        <?php else: ?>
            <?php foreach ($notifications as $note): ?>
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
</body>
</html>