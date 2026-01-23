<?php ob_start(); ?>

<!-- Jobs Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Browse Jobs</h1>
        <p class="mt-2 text-gray-600">Discover opportunities that match your skills and experience.</p>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <form action="/Talent-HUB/candidate/jobs" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Job title, keywords...">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <input type="text" id="location" name="location" value="<?= htmlspecialchars($_GET['location'] ?? '') ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="City, or Remote">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        <!-- Categories will be populated dynamically -->
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search mr-2"></i> Search Jobs
                </button>
            </div>
        </form>
    </div>

    <!-- Job Listings -->
    <div class="space-y-4">
        <?php if (!empty($jobs)): ?>
            <?php foreach ($jobs as $job): ?>
                <?php 
                $company = $job['company_name'] ?? 'Company';
                $hasApplied = false; // TODO: Check if user has applied to this job
                ?>
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <h3 class="text-lg font-medium text-gray-900 mr-3"><?= htmlspecialchars($job['title']) ?></h3>
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                            </div>
                            <p class="text-gray-600 mb-3"><?= htmlspecialchars(substr($job['description'] ?? '', 0, 200)) ?>...</p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span><i class="fas fa-building mr-1"></i> <?= htmlspecialchars($company) ?></span>
                                <span><i class="fas fa-map-marker-alt mr-1"></i> <?= htmlspecialchars($job['location'] ?? 'Not specified') ?></span>
                                <span><i class="fas fa-dollar-sign mr-1"></i> <?= $job['salary'] > 0 ? '$' . number_format($job['salary']) : 'Not specified' ?></span>
                                <span><i class="fas fa-clock mr-1"></i> <?= htmlspecialchars($job['type'] ?? 'Full-time') ?></span>
                                <span><i class="fas fa-calendar mr-1"></i> Posted <?= date('M j, Y', strtotime($job['created_at'])) ?></span>
                            </div>
                        </div>
                        <div class="ml-6 flex flex-col space-y-2">
                            <?php if ($hasApplied): ?>
                                <span class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-800 rounded-full">Applied</span>
                            <?php else: ?>
                                <button onclick="showApplyModal(<?= $job['id'] ?>)" 
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Apply Now
                                </button>
                            <?php endif; ?>
                            <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-bookmark"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-12">
                <i class="fas fa-briefcase text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No jobs found</h3>
                <p class="text-gray-500">Try adjusting your search criteria or browse all available positions.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Apply Modal -->
<div id="applyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Apply for Position</h3>
            <form id="applyForm" action="/Talent-HUB/candidate/jobs/apply" method="POST">
                <input type="hidden" name="job_id" id="modalJobId">
                <div class="mb-4">
                    <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-2">Cover Letter</label>
                    <textarea id="cover_letter" name="cover_letter" rows="4" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Tell us why you're interested in this position..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideApplyModal()" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showApplyModal(jobId) {
    document.getElementById('modalJobId').value = jobId;
    document.getElementById('applyModal').classList.remove('hidden');
}

function hideApplyModal() {
    document.getElementById('applyModal').classList.add('hidden');
    document.getElementById('applyForm').reset();
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
