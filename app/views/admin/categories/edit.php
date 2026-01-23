<?php ob_start(); ?>

<div class="px-4 sm:px-6 lg:px-8 max-w-xl">
    <h1 class="text-base font-semibold leading-6 text-gray-900">
        Edit Category
    </h1>
    <p class="mt-2 text-sm text-gray-700">
        Update category information.
    </p>

    <?php if (!empty($error)): ?>
        <div class="mt-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form action="/Talent-HUB/admin/categories/update" method="POST" class="mt-6 space-y-4">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
        <input type="hidden" name="id" value="<?= $category->getId() ?>">

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Name
            </label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?= htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8') ?>"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            >
        </div>

        <div class="flex items-center gap-x-3">
            <button type="submit"
                    class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                Update
            </button>
            <a href="/Talent-HUB/admin/categories"
               class="text-sm font-semibold text-gray-700 hover:text-gray-900">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
