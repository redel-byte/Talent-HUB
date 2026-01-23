<?php ob_start(); ?>

<!-- Dashboard Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Candidate Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome to your personal dashboard. Track your job applications and profile activity.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-file-alt text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Applications</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= htmlspecialchars($stats['total_applications'] ?? 0) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-eye text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Profile Views</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= number_format($stats['profile_views'] ?? 0) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <i class="fas fa-star text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Saved Jobs</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= htmlspecialchars($stats['saved_jobs'] ?? 0) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Profile Completion</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= htmlspecialchars($stats['profile_completion'] ?? 0) ?>%</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommended Jobs -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recommended Jobs</h3>
            <div class="space-y-3">
                <?php if (!empty($recommended_jobs)): ?>
                    <?php foreach ($recommended_jobs as $job): ?>
                        <?php 
                        $company = $job['company_name'] ?? 'Company';
                        ?>
                        <div class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors" onclick="window.location.href='/Talent-HUB/candidate/jobs'">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900"><?= htmlspecialchars($job['title']) ?></h4>
                                    <p class="text-sm text-gray-500"><?= htmlspecialchars($company) ?> • <?= htmlspecialchars($job['location'] ?? 'Not specified') ?></p>
                                    <p class="text-xs text-gray-400 mt-1">Posted <?= date('M j, Y', strtotime($job['created_at'])) ?> • <?= $job['salary'] > 0 ? '$' . number_format($job['salary']) : 'Not specified' ?></p>
                                </div>
                                <button class="text-blue-600 hover:text-blue-800" onclick="event.stopPropagation(); window.location.href='/Talent-HUB/candidate/jobs'">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-briefcase text-4xl mb-3"></i>
                        <p>No jobs available</p>
                        <p class="text-sm">Check back later for new opportunities</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="mt-4">
                <button class="text-sm font-medium text-blue-600 hover:text-blue-500" onclick="window.location.href='/Talent-HUB/candidate/jobs'">
                    Browse more jobs <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i> Search Jobs
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-upload mr-2"></i> Upload Resume
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-user-edit mr-2"></i> Update Profile
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-bell mr-2"></i> Notifications
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
