<?php
session_start();
include "config.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM menu WHERE id=?");
$stmt->execute([$id]);

header("Location: manage_menu.php");
exit();
?>
