<?php
include 'config.php';

if (isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];

    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);

    echo "<script>alert('Order deleted!'); window.location.href='admin_orders.php';</script>";
}
?>
