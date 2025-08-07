<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /controllers/login.php');
    exit;
}
require_once __DIR__ . '/../database.php';
$config = require __DIR__ . '/../config.php';
$db = new DataBase($config['database']);

$user_id = $_SESSION['user_id'];
$posts = $db->query('SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC', ['user_id' => $user_id])->fetchAll();

include __DIR__ . '/../views/dashboard.view.php';