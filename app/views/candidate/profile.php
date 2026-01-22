<?php ob_start(); ?>

<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
        <p class="mt-2 text-gray-600">Manage your personal and professional information.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Overview -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold"><?= strtoupper(substr($user['email'], 0, 1)) ?></span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($user['fullname'] ?? 'Candidate') ?></h2>
                    <p class="text-gray-600"><?= htmlspecialchars($user['email']) ?></p>
                    
                    <?php if (!empty($profile)): ?>
                        <div class="mt-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Total Applications:</span>
                                <span class="font-medium"><?= $profile['total_applications'] ?? 0 ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Accepted:</span>
                                <span class="font-medium text-green-600"><?= $profile['accepted_applications'] ?? 0 ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Pending:</span>
                                <span class="font-medium text-yellow-600"><?= $profile['pending_applications'] ?? 0 ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Skills Section -->
            <?php if (!empty($skills)): ?>
                <div class="bg-white shadow rounded-lg p-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Top Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach (array_slice($skills, 0, 8) as $skill): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <?= htmlspecialchars($skill['name']) ?>
                                <span class="ml-1 text-xs text-blue-600">(<?= $skill['skill_frequency'] ?>)</span>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Edit Profile Form -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-6">Edit Profile Information</h3>
                
                <form method="POST" action="/Talent-HUB/candidate/profile/update" class="space-y-6">
                    <!-- Personal Information -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-4">Personal Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" name="phone_number" value="<?= htmlspecialchars($user['phone_number'] ?? '') ?>" placeholder="+1 234 567 8900" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" value="<?= htmlspecialchars($user['location'] ?? '') ?>" placeholder="New York, NY" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-4">Professional Information</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Professional Summary</label>
                                <textarea name="summary" rows="4" placeholder="Brief description of your professional background and career goals..." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"><?= htmlspecialchars($user['summary'] ?? '') ?></textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Experience Level</label>
                                    <select name="experience_level" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select experience level</option>
                                        <option value="entry" <?= ($user['experience_level'] ?? '') === 'entry' ? 'selected' : '' ?>>Entry Level (0-2 years)</option>
                                        <option value="mid" <?= ($user['experience_level'] ?? '') === 'mid' ? 'selected' : '' ?>>Mid Level (2-5 years)</option>
                                        <option value="senior" <?= ($user['experience_level'] ?? '') === 'senior' ? 'selected' : '' ?>>Senior Level (5-10 years)</option>
                                        <option value="expert" <?= ($user['experience_level'] ?? '') === 'expert' ? 'selected' : '' ?>>Expert (10+ years)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Expected Salary</label>
                                    <input type="text" name="expected_salary" value="<?= htmlspecialchars($user['expected_salary'] ?? '') ?>" placeholder="$70,000 - $90,000" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-4">Skills</h4>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Technical Skills</label>
                            <textarea name="skills" rows="3" placeholder="PHP, JavaScript, React, MySQL, Git..." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"><?= htmlspecialchars($user['skills'] ?? '') ?></textarea>
                            <p class="mt-1 text-sm text-gray-500">Separate skills with commas</p>
                        </div>
                    </div>

                    <!-- Resume Upload -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-4">Resume</h4>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                            <p class="text-sm text-gray-600 mb-2">Upload your resume (PDF, DOC, DOCX)</p>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx" class="hidden" id="resume-upload">
                            <button type="button" onclick="document.getElementById('resume-upload').click()" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Choose File
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
