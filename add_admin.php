<?php
session_start();
include "config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

    // Insert admin into database
    $sql = "INSERT INTO admin (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);

    if ($stmt->execute()) {
        echo "<script>alert('Admin added successfully!'); window.location.href='admin_login.php';</script>";
    } else {
        $error = "Failed to add admin!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .admin-container {
            width: 30%;
            margin: 100px auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px #000000;
            text-align: center;
            border-radius: 10px;
        }
        input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .button {
            width: 85%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>Add New Admin</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter New Admin Username" required>
        <input type="password" name="password" placeholder="Enter New Password" required>
        <button type="submit" class="button">Add Admin</button>
    </form>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
</div>

</body>
</html>

