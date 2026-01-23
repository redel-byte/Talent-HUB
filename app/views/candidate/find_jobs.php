<?php ob_start(); ?>

<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Find Jobs</h1>
        <p class="mt-2 text-gray-600">Discover opportunities that match your skills and career goals.</p>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <form method="GET" action="/Talent-HUB/find-jobs" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Jobs</label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="<?= htmlspecialchars($filters['search'] ?? '') ?>" 
                               placeholder="Job title, keywords..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Categories</option>
                        <option value="Technology" <?= ($filters['category'] ?? '') === 'Technology' ? 'selected' : '' ?>>Technology</option>
                        <option value="Marketing" <?= ($filters['category'] ?? '') === 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                        <option value="Sales" <?= ($filters['category'] ?? '') === 'Sales' ? 'selected' : '' ?>>Sales</option>
                        <option value="Finance" <?= ($filters['category'] ?? '') === 'Finance' ? 'selected' : '' ?>>Finance</option>
                        <option value="HR" <?= ($filters['category'] ?? '') === 'HR' ? 'selected' : '' ?>>HR</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Min Salary</label>
                    <input type="number" name="min_salary" value="<?= htmlspecialchars($filters['min_salary'] ?? '') ?>" 
                           placeholder="e.g. 50000" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-search mr-2"></i>Search Jobs
                </button>
            </div>
        </form>
    </div>

    <!-- Results Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                <?= count($jobs) ?> Jobs Found
                <?php if (!empty($filters['search']) || !empty($filters['category']) || !empty($filters['min_salary'])): ?>
                    <span class="text-sm text-gray-500 font-normal">matching your criteria</span>
                <?php endif; ?>
            </h2>
        </div>
    </div>

    <!-- Jobs List -->
    <?php if (!empty($jobs)): ?>
        <div class="space-y-6">
            <?php foreach ($jobs as $job): ?>
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2"><?= htmlspecialchars($job['title']) ?></h3>
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="fas fa-building mr-2"></i>
                                <span><?= htmlspecialchars($job['company_name'] ?? 'Unknown Company') ?></span>
                            </div>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-dollar-sign mr-1"></i>
                                    $<?= number_format($job['salary']) ?>
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-tag mr-1"></i>
                                    <?= htmlspecialchars($job['category_name'] ?? 'General') ?>
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-clock mr-1"></i>
                                    <?= date('M j, Y', strtotime($job['created_at'])) ?>
                                </span>
                            </div>
                        </div>
                        
                        <?php if ($user && $user['role'] === 'candidate'): ?>
                            <div class="ml-4">
                                <?php if (in_array($job['id'], $appliedJobs ?? [])): ?>
                                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">
                                        <i class="fas fa-check mr-1"></i>Applied
                                    </span>
                                <?php else: ?>
                                    <button onclick="applyForJob(<?= $job['id'] ?>)" 
                                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                        <i class="fas fa-paper-plane mr-1"></i>Apply Now
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="ml-4">
                                <a href="/Talent-HUB/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-sign-in-alt mr-1"></i>Login to Apply
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="text-gray-600 mb-4">
                        <?= nl2br(htmlspecialchars(substr($job['description'], 0, 300))) ?>
                        <?= strlen($job['description']) > 300 ? '...' : '' ?>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-envelope mr-1"></i>
                            <?= htmlspecialchars($job['company_email'] ?? 'contact@company.com') ?>
                        </div>
                        <button onclick="viewJobDetails(<?= $job['id'] ?>)" 
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            <i class="fas fa-eye mr-1"></i>View Details
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-12">
            <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No jobs found</h3>
            <p class="text-gray-500 mb-6">
                <?php if (!empty($filters['search']) || !empty($filters['category']) || !empty($filters['min_salary'])): ?>
                    Try adjusting your search criteria or browse all available jobs.
                <?php else: ?>
                    No jobs are currently available. Check back later!
                <?php endif; ?>
            </p>
            <?php if (!empty($filters['search']) || !empty($filters['category']) || !empty($filters['min_salary'])): ?>
                <a href="/Talent-HUB/find-jobs" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-redo mr-2"></i>Clear Filters
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script>
function applyForJob(jobId) {
    if (confirm('Are you sure you want to apply for this job?')) {
        fetch('/Talent-HUB/api/candidate/job/apply', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                job_id: jobId
            }),
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Application submitted successfully!', 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showNotification(data.error || 'Failed to submit application', 'error');
            }
        })
        .catch(error => {
            showNotification('An error occurred. Please try again.', 'error');
        });
    }
}

function viewJobDetails(jobId) {
    // This could open a modal or navigate to a detail page
    alert('Job details feature coming soon!');
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
