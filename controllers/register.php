<?php
require_once __DIR__ . '/../database.php';
$config = require __DIR__ . '/../config.php';
$db = new DataBase($config['database']);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (!$username) $errors[] = 'Username is required.';
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (!$password) $errors[] = 'Password is required.';
    if ($password !== $password_confirm) $errors[] = 'Passwords do not match.';

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $db->query('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)', [
                'username' => $username,
                'email' => $email,
                'password' => $hash
            ]);
            header('Location: /controllers/login.php?registered=1');
            exit;
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'users.username')) {
                $errors[] = 'Username already exists.';
            } elseif (str_contains($e->getMessage(), 'users.email')) {
                $errors[] = 'Email already exists.';
            } else {
                $errors[] = 'Registration failed: ' . $e->getMessage();
            }
        }
    }
}
include __DIR__ . '/../views/register.view.php';