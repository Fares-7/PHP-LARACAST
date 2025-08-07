<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /controllers/login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../database.php';
    $config = require __DIR__ . '/../config.php';
    $db = new DataBase($config['database']);
    $id = $_POST['id'] ?? null;
    if ($id) {
        $db->query('DELETE FROM posts WHERE id = :id AND user_id = :user_id', [
            'id' => $id,
            'user_id' => $_SESSION['user_id']
        ]);
    }
}
header('Location: /controllers/dashboard.php');
exit;