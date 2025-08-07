<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-3xl mx-auto py-8">
        <h2 class="text-3xl font-bold mb-6">Your Posts</h2>
        <a href="/controllers/create_post.php" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create New Post</a>
        <?php if (empty($posts)): ?>
            <p class="mt-4">You have not written any posts yet.</p>
        <?php else: ?>
            <div class="space-y-4 mt-4">
                <?php foreach ($posts as $post): ?>
                    <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold mb-1"><?= htmlspecialchars($post['title']) ?></h3>
                            <div class="text-gray-500 text-sm mb-2">Created: <?= htmlspecialchars($post['created_at']) ?></div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="/controllers/edit_post.php?id=<?= $post['id'] ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form method="POST" action="/controllers/delete_post.php" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>