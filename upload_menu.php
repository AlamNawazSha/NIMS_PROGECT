<?php
include 'config.php'; // Database connection

if (isset($_POST['upload'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Save menu item to database
    $stmt = $pdo->prepare("INSERT INTO menu (name, price, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $_FILES["image"]["name"]]);

    header("Location: admin_menu.php"); // Redirect back to menu management
    exit();
}
?>
