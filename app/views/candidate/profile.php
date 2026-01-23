<?php ob_start(); ?>

<!-- Profile Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
        <p class="mt-2 text-gray-600">Manage your personal information and professional details.</p>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800"><?= htmlspecialchars($_SESSION['success']) ?></p>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800"><?= htmlspecialchars($_SESSION['error']) ?></p>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/Talent-HUB/candidate/profile/update" method="POST" class="space-y-8">
        <!-- Personal Information -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Personal Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="fullname" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
                    <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="+1 234 567 8900">
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="City, Country">
                </div>
            </div>
        </div>

        <!-- Professional Information -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Professional Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Professional Title</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($user['title'] ?? '') ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Senior Developer">
                </div>
                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience Level</label>
                    <select id="experience" name="experience" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select experience</option>
                        <option value="0-2" <?= ($user['experience'] ?? '') === '0-2' ? 'selected' : '' ?>>0-2 years</option>
                        <option value="2-5" <?= ($user['experience'] ?? '') === '2-5' ? 'selected' : '' ?>>2-5 years</option>
                        <option value="5-10" <?= ($user['experience'] ?? '') === '5-10' ? 'selected' : '' ?>>5-10 years</option>
                        <option value="10+" <?= ($user['experience'] ?? '') === '10+' ? 'selected' : '' ?>>10+ years</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                    <textarea id="skills" name="skills" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="PHP, JavaScript, React, Node.js..."><?= htmlspecialchars($user['skills'] ?? '') ?></textarea>
                    <p class="text-xs text-gray-500 mt-1">Separate skills with commas</p>
                </div>
                <div class="md:col-span-2">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Professional Summary</label>
                    <textarea id="bio" name="bio" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Tell us about your professional background and career goals..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
