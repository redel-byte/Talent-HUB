<?php ob_start(); ?>

<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h1>Edit Tag</h1>

<?php if (!empty($error)): ?>
    <div class="text-red-600 mb-4">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form action="/Talent-HUB/admin/tags/update" method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
    <input type="hidden" name="id" value="<?= $tag->getId() ?>">

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="<?= htmlspecialchars($tag->getName(), ENT_QUOTES, 'UTF-8') ?>"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            required
        >
    </div>

    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
        Update
    </button>
</form>

</div>

<?php
$content    = ob_get_clean();
$page_title = $page_title ?? 'Edit Tag - TalentHub';
require __DIR__ . '/../layout.php';

