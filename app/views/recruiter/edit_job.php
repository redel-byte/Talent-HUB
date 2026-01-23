<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Job Posting</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
            <p class="text-red-800"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/Talent-HUB/recruiter/jobs/edit" method="POST" class="space-y-6">
        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Job Title *</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category *</label>
                <select id="category_id" name="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo $job['category_id'] == $category['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                <input type="number" id="salary" name="salary" value="<?php echo htmlspecialchars($job['salary']); ?>" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Job Description *</label>
            <textarea id="description" name="description" rows="6" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"><?php echo htmlspecialchars($job['description']); ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tags</label>
            <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-2">
                <?php foreach ($tags as $tag): ?>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>" <?php echo in_array($tag['id'], $jobTags) ? 'checked' : ''; ?> class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm"><?php echo htmlspecialchars($tag['name']); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="/Talent-HUB/recruiter/jobs" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Update Job</button>
        </div>
    </form>
</div>