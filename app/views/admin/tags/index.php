<?php ob_start(); ?>

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Tags</h2>
        <a href="/Talent-HUB/admin/tags/create"
           class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
            <i class="fas fa-plus mr-2"></i> Add New Tag
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php if (!empty($tags)): ?>
            <?php foreach ($tags as $tag): ?>
    <tr>
        <td><?= $tag->getId() ?></td>
        <td><?= htmlspecialchars($tag->getName(), ENT_QUOTES, 'UTF-8') ?></td>
        <td>
            <a href="/Talent-HUB/admin/tags/edit?id=<?= $tag->getId() ?>" class="text-blue-600 hover:underline">
                Edit
            </a>

            <form action="/Talent-HUB/admin/tags/destroy" method="POST" style="display:inline;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                <input type="hidden" name="id" value="<?= $tag->getId() ?>">
                <button type="submit" class="text-red-600 hover:underline"
                        onclick="return confirm('Are you sure?')">
                    Delete
                </button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>

            <?php else: ?>
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                        No tags found.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content    = ob_get_clean();
$page_title = $page_title ?? 'Manage Tags - TalentHub';
require __DIR__ . '/../layout.php';
