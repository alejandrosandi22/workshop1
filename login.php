<?php
session_start();
require_once 'config.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['error'] = 'Credenciales inválidas';
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'SELECT id, username, password FROM users WHERE username = :u LIMIT 1'
    );
    $stmt->execute(['u' => $username]);
    $user = $stmt->fetch();

    if ($user && $user['password'] === $password) {
        // Login correcto
        $_SESSION['user_id'] = $user['id'];
        header('Location: welcome.php');
        exit;
    }

    // No existe el usuario o contraseña incorrecta → mismo mensaje
    $_SESSION['error'] = 'Credenciales inválidas';
    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['error'] = 'Credenciales inválidas';
    header('Location: index.php');
    exit;
}