<?php ob_start(); ?>

<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">Create Tag</h2>

    <?php if (!empty($error)): ?>
        <div class="mb-4 text-sm text-red-600">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="/Talent-HUB/admin/tags/store" method="POST" class="space-y-4">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tag Name</label>
            <input type="text" name="name"
                   class="w-full border border-gray-300 rounded-md shadow-sm p-2"
                   required>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="/Talent-HUB/admin/tags"
               class="px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-700">
                Save
            </button>
        </div>
    </form>
</div>

<?php
$content    = ob_get_clean();
$page_title = $page_title ?? 'Create Tag - TalentHub';
require __DIR__ . '/../layout.php';
