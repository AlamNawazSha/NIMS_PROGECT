
<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 24px;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }
        .button {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 10px 0;
            background: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background: #218838;
        }



        /* General Styling */
body {
    font-family: 'Montserrat', sans-serif;
    background: #f4f4f4;
    margin: 0;
    padding: 0;
}

/* Container */
.menu-container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background: #ffcc00;
    color: #333;
    font-weight: bold;
}

td img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
}

/* Buttons */
.btn {
    display: inline-block;
    padding: 6px 12px;
    text-decoration: none;
    font-size: 14px;
    border-radius: 5px;
    transition: 0.3s;
}

.btn-edit {
    background: #28a745;
    color: white;
}

.btn-edit:hover {
    background: #218838;
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.btn-delete:hover {
    background: #c82333;
}

/* Form Styling */
form {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: auto;
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

button {
    background: #ffcc00;
    border: none;
    padding: 10px 20px;
    margin-top: 10px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: 0.3s;
}

button:hover {
    background: #e6b800;
}

/* .order-btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    margin-top: 10px;
    transition: 0.3s;
}

.order-btn:hover {
    background-color: #0056b3;
} */


    </style>
</head>
<body>

<div class="header">Admin Dashboard</div>

<div class="container">
    <a href="manage_menu.php" class="button">Manage Menu</a>
    <a href="admin_bookings.php" class="button">Manage Table Bookings</a>
    <a href="admin_orders.php" class="button">Manage Orders</a>


    <a href="admin_logout.php" class="button" style="background: red;">Logout</a>

</div>

</body>
</html>
