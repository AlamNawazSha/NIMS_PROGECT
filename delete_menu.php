<?php
session_start();
include "config.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
// $stmt = $pdo->prepare("DELETE FROM menu WHERE id=?");
// $stmt->execute([$id]);

// Delete feedback first
$deleteFeedback = $pdo->prepare("DELETE FROM feedback WHERE item_id = :id");
$deleteFeedback->execute([':id' => $id]);

// Then delete the menu item
$deleteMenu = $pdo->prepare("DELETE FROM menu WHERE id = :id");
$deleteMenu->execute([':id' => $id]);


header("Location: manage_menu.php");
exit();
?>

