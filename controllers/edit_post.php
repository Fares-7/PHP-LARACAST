<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /controllers/login.php');
    exit;
}
require_once __DIR__ . '/../database.php';
$config = require __DIR__ . '/../config.php';
$db = new DataBase($config['database']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /controllers/dashboard.php');
    exit;
}
$post = $db->query('SELECT * FROM posts WHERE id = :id AND user_id = :user_id', [
    'id' => $id,
    'user_id' => $_SESSION['user_id']
])->fetch();
if (!$post) {
    header('Location: /controllers/dashboard.php');
    exit;
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if (!$title) $errors[] = 'Title is required.';
    if (!$content) $errors[] = 'Content is required.';
    if (empty($errors)) {
        $db->query('UPDATE posts SET title = :title, content = :content WHERE id = :id AND user_id = :user_id', [
            'title' => $title,
            'content' => $content,
            'id' => $id,
            'user_id' => $_SESSION['user_id']
        ]);
        header('Location: /controllers/dashboard.php');
        exit;
    }
}
include __DIR__ . '/../views/edit_post.view.php';