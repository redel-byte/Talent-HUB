<?php ob_start(); ?>

<!-- Dashboard Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Recruiter Dashboard</h1>
        <p class="mt-2 text-gray-600">Manage your job postings and track candidate applications.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-briefcase text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Active Jobs</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= htmlspecialchars($stats['active_jobs'] ?? 0) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Applicants</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= htmlspecialchars($stats['total_applicants'] ?? 0) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
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
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Interview Rate</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= htmlspecialchars($stats['interview_rate'] ?? 0) ?>%</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="/Talent-HUB/recruiter/company/create" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                <i class="fas fa-building text-2xl text-blue-600 mb-2"></i>
                <h3 class="font-medium">Create Company</h3>
                <p class="text-sm text-gray-600">Set up your company profile</p>
            </a>
            <a href="/Talent-HUB/recruiter/jobs/create" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                <i class="fas fa-plus text-2xl text-green-600 mb-2"></i>
                <h3 class="font-medium">Post New Job</h3>
                <p class="text-sm text-gray-600">Create a new job posting</p>
            </a>
            <a href="/Talent-HUB/recruiter/jobs" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                <i class="fas fa-list text-2xl text-purple-600 mb-2"></i>
                <h3 class="font-medium">Manage Jobs</h3>
                <p class="text-sm text-gray-600">View and edit your job postings</p>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Applications -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Applications</h3>
                <div class="space-y-3">
                    <?php if (!empty($recent_applications)): ?>
                        <?php foreach ($recent_applications as $application): ?>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($application['candidate_name'] ?? 'Unknown Candidate') ?></p>
                                        <p class="text-sm text-gray-500"><?= htmlspecialchars($application['job_title'] ?? 'Unknown Job') ?> • Applied <?= date('M j, Y', strtotime($application['created_at'])) ?></p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <form action="/Talent-HUB/recruiter/applications/update-status" method="POST" class="inline">
                                        <input type="hidden" name="application_id" value="<?= $application['id'] ?>">
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="text-green-600 hover:text-green-800" title="Approve" onclick="return confirm('Approve this application?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="/Talent-HUB/recruiter/applications/update-status" method="POST" class="inline">
                                        <input type="hidden" name="application_id" value="<?= $application['id'] ?>">
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Reject" onclick="return confirm('Reject this application?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3"></i>
                            <p>No applications yet</p>
                            <p class="text-sm">Applications will appear here when candidates apply to your jobs</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-4">
                    <a href="/Talent-HUB/recruiter/candidates" class="text-sm font-medium text-green-600 hover:text-green-500">
                        View all applications <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Job Postings -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Active Job Postings</h3>
                <div class="space-y-3">
                    <?php if (!empty($recent_jobs)): ?>
                        <?php foreach ($recent_jobs as $job): ?>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900"><?= htmlspecialchars($job['title']) ?></h4>
                                        <p class="text-sm text-gray-500">Posted <?= date('M j, Y', strtotime($job['created_at'])) ?> • <?= $job['applicant_count'] ?> applicants</p>
                                        <div class="flex items-center mt-2 space-x-4">
                                            <span class="text-xs text-gray-400"><i class="fas fa-map-marker-alt mr-1"></i> <?= htmlspecialchars($job['location'] ?? 'Not specified') ?></span>
                                            <span class="text-xs text-gray-400"><i class="fas fa-dollar-sign mr-1"></i> <?= $job['salary'] > 0 ? '$' . number_format($job['salary']) : 'Not specified' ?></span>
                                            <span class="text-xs text-gray-400"><i class="fas fa-clock mr-1"></i> <?= htmlspecialchars($job['type'] ?? 'Full-time') ?></span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="/Talent-HUB/recruiter/jobs/edit?id=<?= $job['id'] ?>" class="text-blue-600 hover:text-blue-800 text-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/Talent-HUB/recruiter/jobs/delete?id=<?= $job['id'] ?>" class="text-red-600 hover:text-red-800 text-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this job posting?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-briefcase text-4xl mb-3"></i>
                            <p>No job postings yet</p>
                            <p class="text-sm">Create your first job posting to start attracting candidates</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-4">
                    <a href="/Talent-HUB/recruiter/jobs" class="text-sm font-medium text-green-600 hover:text-green-500">
                        Manage all postings <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button class="flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-md shadow-sm text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-plus mr-2"></i> Post New Job
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-search mr-2"></i> Search Candidates
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-building mr-2"></i> Update Company
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-chart-bar mr-2"></i> View Analytics
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$page_title = $page_title ?? 'Recruiter Dashboard - TalentHub';
require __DIR__ . '/layout.php';
