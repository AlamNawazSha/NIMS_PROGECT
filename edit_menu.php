<?php
session_start();
include "config.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM menu WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category= $_POST['category'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $stmt = $pdo->prepare("UPDATE menu SET name=?, description=?, price=?, image=?, category=? WHERE id=?");
        $stmt->execute([$name, $description, $price, $image, $category, $id]);

    } 
    else {
        $stmt = $pdo->prepare("UPDATE menu SET name=?, description=?, price=?, image=?, category=? WHERE id=?");
        $stmt->execute([$name, $description, $price, $image, $category, $id]);
        
    }

    header("Location: manage_menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <style>
        /* Menu Container */
.menu-container {
    width: 80%;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
}

/* Heading */
.menu-container h2 {
    color: #444;
    margin-bottom: 20px;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background: hsl(38, 61%, 73%);
    color: #fff;
}

/* Menu Images */
td img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    object-fit: cover;
}

/* Buttons */
.btn {
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    display: inline-block;
    margin: 5px;
}

/* Edit Button */
.btn-edit {
    background: #4CAF50;
    color: white;
}

/* Delete Button */
.btn-delete {
    background: #e74c3c;
    color: white;
}

/* Add New Menu Button */
.add-menu-btn {
    display: inline-block;
    margin: 20px 0;
    padding: 10px 20px;
    background: hsl(38, 61%, 73%);
    color: white;
    font-size: 16px;
    border-radius: 5px;
    text-decoration: none;
}

/* Button Hover Effects */
.btn:hover,
.add-menu-btn:hover {
    opacity: 0.8;
}

/* Form Container */
.form-container {
    width: 50%;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
}

/* Form Inputs */
.form-container input,
.form-container select,
.form-container textarea {
    width: 90%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ddd;
}

/* Submit Button */
.form-container button {
    background: hsl(38, 61%, 73%);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.form-container button:hover {
    opacity: 0.8;
}

    </style>
</head>
<body>
<div class="form-container">
    <h2>Edit Menu Item</h2>
    <form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" value="<?= $item['name']; ?>" required><br>
    <textarea name="description"><?= $item['description']; ?></textarea><br>
    <input type="number" name="price" step="0.01" value="<?= $item['price']; ?>" required><br>
    <input type="file" name="image"><br>

    <select name="category" required>
        <option value="Veg" <?= ($item['category'] == 'Veg') ? 'selected' : ''; ?>>Veg</option>
        <option value="Non-Veg" <?= ($item['category'] == 'Non-Veg') ? 'selected' : ''; ?>>Non-Veg</option>
        <option value="Beverage" <?= ($item['category'] == 'Beverage') ? 'selected' : ''; ?>>Beverage</option>
        <option value="Dessert" <?= ($item['category'] == 'Dessert') ? 'selected' : ''; ?>>Dessert</option>
    </select><br>

    <button type="submit">Update Item</button>
</form>
</div>

</body>
</html>
