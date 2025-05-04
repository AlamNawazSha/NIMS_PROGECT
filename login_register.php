<?php
session_start();
$pdo = new mysqli("localhost", "root", "", "nimsdb");

// Check connection
if ($pdo->connect_error) {
    die("Connection failed: " . $pdo->connect_error);
}

// Registration
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $password);
    
    if ($stmt->execute()) {
        
        echo "<script>alert('Registration Successful!'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Email already exists!'); window.location.href='index.php';</script>";
    }
}

// Login

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) 
    {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['phone'] = $user['phone'];


        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password..'); window.location.href = 'index.php';</script>";
        exit();
    }
}

?>


