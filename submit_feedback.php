<?php
session_start();
require 'config.php'; // DB Connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $item_id = $_POST['item_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'] ?? null;
    $username = $_SESSION['username'] ?? 'Guest'; // Change if you have a user login system

    if (!empty($item_id) && !empty($rating)) {
        $stmt = $pdo->prepare("INSERT INTO feedback (item_id, username, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->execute([$item_id, $username, $rating, $comment]);
    }

    header("Location: additem.php?id=$item_id"); // Redirect back
    exit();
}
?>
