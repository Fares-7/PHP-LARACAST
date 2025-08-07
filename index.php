<?php
session_start();
require_once 'database.php';
$config = require 'config.php';
$db = new DataBase($config['database']);

// Fetch all posts with author
$posts = $db->query('SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC')->fetchAll();
?>
<html>
<head>
    <title>Blog Home</title>
    <link rel="stylesheet" href="/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">All Blog Posts</h1>
        <?php if (empty($posts)): ?>
            <p>No posts found.</p>
        <?php else: ?>
            <div class="space-y-6">
                <?php foreach ($posts as $post): ?>
                    <div class="bg-white p-6 rounded shadow">
                        <h2 class="text-2xl font-semibold mb-2"><?= htmlspecialchars($post['title']) ?></h2>
                        <div class="text-gray-500 text-sm mb-2">By <?= htmlspecialchars($post['username']) ?> on <?= htmlspecialchars($post['created_at']) ?></div>
                        <p class="mb-4"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                            <a href="/controllers/edit_post.php?id=<?= $post['id'] ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form method="POST" action="/controllers/delete_post.php" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>