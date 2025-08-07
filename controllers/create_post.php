<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /controllers/login.php');
    exit;
}
require_once __DIR__ . '/../database.php';
$config = require __DIR__ . '/../config.php';
$db = new DataBase($config['database']);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if (!$title) $errors[] = 'Title is required.';
    if (!$content) $errors[] = 'Content is required.';
    if (empty($errors)) {
        $db->query('INSERT INTO posts (user_id, title, content) VALUES (:user_id, :title, :content)', [
            'user_id' => $_SESSION['user_id'],
            'title' => $title,
            'content' => $content
        ]);
        header('Location: /controllers/dashboard.php');
        exit;
    }
}
include __DIR__ . '/../views/create_post.view.php';