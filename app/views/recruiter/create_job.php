<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Create Job Posting</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
            <p class="text-red-800"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/Talent-HUB/recruiter/jobs/create" method="POST" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Job Title *</label>
                <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category *</label>
                <select id="category_id" name="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                <input type="number" id="salary" name="salary" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Job Description *</label>
            <textarea id="description" name="description" rows="6" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Describe the job..."></textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="/Talent-HUB/recruiter/jobs" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Create Job</button>
        </div>
    </form>
</div>