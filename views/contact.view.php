<html class="h-full bg-gray-100">
  <head>
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="h-full">
    <div class="min-h-full flex items-center justify-center py-8">
      <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-6">Contact Us</h2>
        <?php if (!empty($errors)): ?>
          <div class="mb-4 text-red-600">
            <ul>
              <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
          <div class="mb-4 text-green-600">
            <?= htmlspecialchars($success) ?>
          </div>
        <?php endif; ?>
        <form method="POST">
          <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
          </div>
          <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
          </div>
          <div class="mb-4">
            <label class="block mb-1">Message</label>
            <textarea name="message" class="w-full border px-3 py-2 rounded" rows="5"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Send Message</button>
        </form>
      </div>
    </div>
  </body>
</html>