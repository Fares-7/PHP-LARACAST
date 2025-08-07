<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Edit Post</h2>
        <?php if (!empty($errors)): ?>
            <div class="mb-4 text-red-600">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-1">Title</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded" value="<?= htmlspecialchars($_POST['title'] ?? $post['title']) ?>">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Content</label>
                <textarea name="content" class="w-full border px-3 py-2 rounded" rows="6"><?= htmlspecialchars($_POST['content'] ?? $post['content']) ?></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Update Post</button>
        </form>
        <a href="/controllers/dashboard.php" class="block mt-4 text-blue-600">Back to Dashboard</a>
    </div>
</body>
</html>