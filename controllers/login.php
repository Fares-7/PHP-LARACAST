<?php
session_start();
require_once __DIR__ . '/../database.php';
$config = require __DIR__ . '/../config.php';
$db = new DataBase($config['database']);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username) $errors[] = 'Username is required.';
    if (!$password) $errors[] = 'Password is required.';

    if (empty($errors)) {
        $user = $db->query('SELECT * FROM users WHERE username = :username', ['username' => $username])->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: /index.php');
            exit;
        } else {
            $errors[] = 'Invalid username or password.';
        }
    }
}
include __DIR__ . '/../views/login.view.php';