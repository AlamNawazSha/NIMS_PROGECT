<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    // Update the order status
    $stmt = $pdo->prepare("UPDATE orders SET status = :status WHERE id = :order_id");
    $stmt->execute([
        ':status' => $new_status,
        ':order_id' => $order_id
    ]);

    // Fetch user_id from the order
    $stmt = $pdo->prepare("SELECT user_id FROM orders WHERE id = :order_id");
    $stmt->execute([':order_id' => $order_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        $user_id = $order['user_id'];
        $message = "Your order #$order_id status has been updated to $new_status.";
        $type = "order";

        // Insert notification
        $notify = $pdo->prepare("INSERT INTO order_notifications (user_id, message, type, status) VALUES (:user_id, :message, :type, 'unread')");
        $notify->execute([
            ':user_id' => $user_id,
            ':message' => $message,
            ':type' => $type
        ]);
    }

    // Redirect back to orders page
    header("Location: admin_orders.php");
    exit();
}
?>


<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status
    $stmt = $pdo->prepare("UPDATE orders SET status = :status WHERE id = :order_id");
    $stmt->execute([':status' => $status, ':order_id' => $order_id]);

    // Get the user_id of the order
    $getUser = $pdo->prepare("SELECT user_id FROM orders WHERE id = :order_id");
    $getUser->execute([':order_id' => $order_id]);
    $user = $getUser->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $user_id = $user['user_id'];
        $message = "Your order #$order_id status has been updated to '$status'.";

        // Insert notification
        $insert = $pdo->prepare("INSERT INTO order_notifications (user_id, message, type, status) VALUES (:user_id, :message, 'order', 'unread')");
        $insert->execute([
            ':user_id' => $user_id,
            ':message' => $message
        ]);
    }

    header("Location: admin_orders.php");
    exit();
}
?>
