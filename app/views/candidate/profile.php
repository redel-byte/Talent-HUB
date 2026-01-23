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
                        
                        <?php if (!empty($user['resume_path'])): ?>
                            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-pdf text-green-600 text-xl mr-3"></i>
                                        <div>
                                            <p class="text-sm font-medium text-green-800">Resume Uploaded</p>
                                            <p class="text-xs text-green-600"><?= htmlspecialchars(basename($user['resume_path'])) ?></p>
                                        </div>
                                    </div>
                                    <a href="/Talent-HUB/public/uploads/resumes/<?= htmlspecialchars($user['resume_path']) ?>" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View Resume
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                            <p class="text-sm text-gray-600 mb-2">Upload your resume (PDF, DOC, DOCX) - Max 2MB</p>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx" class="hidden" id="resume-upload" onchange="handleFileSelect(this);">
                            <button type="button" onclick="document.getElementById('resume-upload').click()" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <?= !empty($user['resume_path']) ? 'Replace Resume' : 'Choose File' ?>
                            </button>
                        </div>
                        
                        <script>
                        function handleFileSelect(input) {
                            const file = input.files[0];
                            if (file) {
                                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                                const maxSize = 2 * 1024 * 1024; // 2MB to match PHP config
                                
                                if (!allowedTypes.includes(file.type)) {
                                    showNotification('Please upload a PDF, DOC, or DOCX file', 'error');
                                    input.value = '';
                                    return;
                                }
                                
                                if (file.size > maxSize) {
                                    showNotification('File size must be less than 2MB', 'error');
                                    input.value = '';
                                    return;
                                }
                                
                                uploadFileDirect(file);
                            }
                        }
                        
                        function uploadFileDirect(file) {
                            showNotification('Uploading resume...', 'info');
                            
                            const formData = new FormData();
                            formData.append('resume', file);
                            
                            fetch('/Talent-HUB/api/candidate/resume/upload', {
                                method: 'POST',
                                body: formData,
                                credentials: 'same-origin'
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showNotification('Resume uploaded successfully!', 'success');
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1500);
                                } else {
                                    showNotification('Upload failed: ' + (data.error || 'Unknown error'), 'error');
                                }
                            })
                            .catch(error => {
                                showNotification('Upload failed. Please try again.', 'error');
                            });
                        }
                        
                        function showNotification(message, type = 'info') {
                            // Remove existing notifications
                            const existingNotifications = document.querySelectorAll('.notification');
                            existingNotifications.forEach(notif => notif.remove());
                            
                            const notification = document.createElement('div');
                            const icons = {
                                success: 'check-circle',
                                error: 'exclamation-circle',
                                warning: 'exclamation-triangle',
                                info: 'info-circle'
                            };
                            
                            const colors = {
                                success: 'bg-green-500',
                                error: 'bg-red-500',
                                warning: 'bg-yellow-500',
                                info: 'bg-blue-500'
                            };
                            
                            notification.className = `notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white ${colors[type]} transform translate-x-full transition-all duration-300 max-w-sm backdrop-blur-sm`;
                            notification.innerHTML = `
                                <div class="flex items-start">
                                    <i class="fas fa-${icons[type]} mr-3 mt-0.5 flex-shrink-0 text-lg"></i>
                                    <div class="flex-1">
                                        <p class="font-medium">${message}</p>
                                        <button class="mt-2 text-xs opacity-75 hover:opacity-100 transition-opacity focus:outline-none" onclick="this.parentElement.parentElement.parentElement.remove()">Dismiss</button>
                                    </div>
                                </div>
                            `;
                            
                            document.body.appendChild(notification);
                            
                            // Animate in
                            setTimeout(() => {
                                notification.classList.remove('translate-x-full');
                                notification.classList.add('translate-x-0');
                            }, 100);
                            
                            // Auto remove after 5 seconds
                            setTimeout(() => {
                                notification.classList.add('translate-x-full');
                                notification.classList.remove('translate-x-0');
                                setTimeout(() => {
                                    notification.remove();
                                }, 300);
                            }, 5000);
                        }
                        </script>
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
