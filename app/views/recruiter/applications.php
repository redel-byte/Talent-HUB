<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Applications for: <?php echo htmlspecialchars($job['title']); ?></h2>
            <p class="text-gray-600 mt-1">Manage candidate applications</p>
        </div>
        <a href="/Talent-HUB/recruiter/jobs" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
            <i class="fas fa-arrow-left mr-2"></i> Back to Jobs
        </a>
    </div>

    <?php if (empty($applications)): ?>
        <div class="text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No applications yet</h3>
            <p class="text-gray-600">Candidates will apply to this job posting soon.</p>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($applications as $application): ?>
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900"><?php echo htmlspecialchars($application['fullname']); ?></h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars($application['email']); ?></p>
                            <p class="text-sm text-gray-500 mt-1">Applied on <?php echo date('M d, Y', strtotime($application['created_at'])); ?></p>
                            <div class="mt-2">
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Status: <?php echo htmlspecialchars($application['status'] ?? 'pending'); ?></span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="/Talent-HUB/uploads/cvs/<?php echo htmlspecialchars($application['cv_upload']); ?>" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                <i class="fas fa-download mr-1"></i> CV
                            </a>
                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                <i class="fas fa-check mr-1"></i> Accept
                            </button>
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                <i class="fas fa-times mr-1"></i> Reject
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>