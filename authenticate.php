<?php
session_start();
require './db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Подготовка и выполнение запроса
    $stmt = $conn->prepare('SELECT id, password, isAdmin FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($id, $stored_password, $isAdmin);
    $stmt->fetch();

    // Проверка пароля
    if ($stored_password && $password === $stored_password) {
        $_SESSION['user_id'] = $id;
        $_SESSION['isAdmin'] = $isAdmin;
        header('Location: admin.php');
        exit;
    } else {
        echo "Invalid username or password.";
    }
    
    $stmt->close();
}
$conn->close();
?>