<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Create Company Profile</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
            <p class="text-red-800"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/Talent-HUB/recruiter/company/create" method="POST" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Company Name *</label>
                <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Company Email *</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea id="address" name="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Company address..."></textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="/Talent-HUB/recruiter/dashboard" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Create Company</button>
        </div>
    </form>
</div>