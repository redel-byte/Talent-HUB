<?php ob_start(); ?>

<div class="px-6 sm:px-8 lg:px-10 max-w-xl border-4 rounded-md h-[200px]">
    <h1 class="text-base font-semibold leading-6 text-red-900">
        Create Category
    </h1>
    <p class="mt-2 text-sm text-gray-700">
        Add a new category.
    </p>

    <?php if (!empty($error)): ?>
        <div class="mt-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form action="/Talent-HUB/admin/categories/store" method="POST" class="mt-6 space-y-4">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Name
            </label>
            <input
                type="text"
                id="name"
                name="name"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            >
        </div>

        <div class="flex items-center gap-x-3">
            <button type="submit"
                    class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                Save
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
