<?php ob_start(); ?>

<?php
function getStatusColor(string $status): string
{
    $colors = [
        'pending' => 'yellow',
        'reviewed' => 'blue',
        'accepted' => 'green',
        'rejected' => 'red',
        'interview' => 'purple'
    ];
    
    return $colors[$status] ?? 'gray';
}
?>

<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Applications</h1>
        <p class="mt-2 text-gray-600">Track the status of all your job applications in one place.</p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-file-alt text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Applications</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['total_applications'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Pending</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['pending_count'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-check text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Accepted</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['accepted_count'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                        <i class="fas fa-times text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Rejected</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['rejected_count'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications List -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <?php if (!empty($applications)): ?>
                <div class="space-y-4">
                    <?php foreach ($applications as $application): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($application['title']) ?></h3>
                                    <p class="text-gray-600"><?= htmlspecialchars($application['recruiter_name'] ?? 'Unknown Recruiter') ?></p>
                                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                        <span><i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($application['location'] ?? 'Remote') ?></span>
                                        <span><i class="fas fa-dollar-sign mr-1"></i><?= number_format($application['salary_min'] ?? $application['salary'] ?? 0) ?><?= $application['salary_max'] ? ' - ' . number_format($application['salary_max']) : '' ?></span>
                                        <span><i class="fas fa-calendar mr-1"></i><?= isset($application['applied_at']) ? date('M j, Y', strtotime($application['applied_at'])) : 'Recently' ?></span>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-xs font-medium bg-<?= getStatusColor($application['status']) ?>-100 text-<?= getStatusColor($application['status']) ?>-800 rounded-full">
                                    <?= ucfirst(htmlspecialchars($application['status'])) ?>
                                </span>
                            </div>
                            <div class="mt-4 flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium application-action" data-action="view" data-application-id="<?= $application['id'] ?>">View Details</button>
                                <?php if (in_array($application['status'], ['pending', 'reviewed'])): ?>
                                    <button class="text-gray-600 hover:text-gray-800 text-sm font-medium application-action" data-action="withdraw" data-application-id="<?= $application['id'] ?>">Withdraw</button>
                                <?php endif; ?>
                                <?php if ($application['status'] === 'accepted'): ?>
                                    <button class="text-green-600 hover:text-green-800 text-sm font-medium application-action" data-action="accept" data-application-id="<?= $application['id'] ?>">Accept Offer</button>
                                <?php endif; ?>
                                <?php if ($application['status'] === 'rejected'): ?>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium application-action" data-action="reapply" data-application-id="<?= $application['id'] ?>">Reapply</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <i class="fas fa-file-alt text-gray-400 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No applications yet</h3>
                    <p class="text-gray-500 mb-6">Start applying for jobs to see them here</p>
                    <a href="/Talent-HUB/find-jobs" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-search mr-2"></i> Browse Jobs
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
