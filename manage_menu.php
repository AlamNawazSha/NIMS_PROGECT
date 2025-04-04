<?php
session_start();
include "config.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch menu items
$stmt = $pdo->query("SELECT * FROM menu ORDER BY created_at DESC");
$menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
    <style>
        /* body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { width: 80%; margin: auto; padding: 20px; background: white; box-shadow: 0px 0px 10px 0px #000000; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #333; color: white; }
        .btn { padding: 5px 10px; border: none; cursor: pointer; }
        .btn-edit { background: #28a745; color: white; }
        .btn-delete { background: #dc3545; color: white; } */
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
 /* Navbar */
 .navbar {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 30px;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar h1 {
            margin: 0;
            font-size: 22px;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
        }

        .nav-buttons a {
            color: white;
            text-decoration: none;
            background: #28a745;
            padding: 8px 16px;
            border-radius: 6px;
            transition: 0.3s;
            font-weight: bold;
        }

        .nav-buttons a:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .nav-buttons a.logout {
            background-color: #dc3545;
        }

        .nav-buttons a.logout:hover {
            background-color: #c82333;
        }

        .nav-buttons a.home {
            background-color: #007bff;
        }

        .nav-buttons a.home:hover {
            background-color: #0056b3;
        }


    </style>
</head>
<body>
<div class="navbar">
        <h1>🍽️ Admin Dashboard</h1>
        <div class="nav-buttons">
            <a href="admin_dashboard.php" class="home">Home</a>
            <a href="manage_menu.php">Menu</a>
            <a href="admin_bookings.php">Bookings</a>
            <a href="admin_orders.php">Orders</a>
            <a href="admin_logout.php" class="logout">Logout</a>
        </div>
    </div>
<div class="menu-container">
<div class="container">
    <h2>Manage Menu</h2>
    <a href="add_menu.php" style="text-decoration: none; padding: 10px; background: blue; color: white;">Add New Item</a>
    
    <table>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($menuItems as $item) { ?>
        <tr>
            <td><?= $item['name']; ?></td>
            <td><?= $item['description']; ?></td>
            <td>$<?= number_format($item['price'], 2); ?></td>
            <td><img src="uploads/<?= $item['image']; ?>" width="50"></td>
            <td><?= $item['category']; ?></td>
            <td>
                <a href="edit_menu.php?id=<?= $item['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="delete_menu.php?id=<?= $item['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
</div>
</div>

</body>
</html>
