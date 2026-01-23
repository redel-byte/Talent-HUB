<?php ob_start(); ?>

<!-- Applications Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Applications</h1>
        <p class="mt-2 text-gray-600">Track the status of your job applications and manage your candidacy.</p>
    </div>

    <!-- Applications List -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <?php if (!empty($applications)): ?>
                <div class="text-center py-12">
                    <i class="fas fa-file-alt text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Applications tracking coming soon</h3>
                    <p class="text-gray-500 mb-4">Your application tracking feature is currently being developed.</p>
                    <a href="/Talent-HUB/candidate/jobs" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-search mr-2"></i> Browse Jobs
                    </a>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <i class="fas fa-file-alt text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No applications yet</h3>
                    <p class="text-gray-500 mb-4">Start applying to jobs to track your applications here.</p>
                    <a href="/Talent-HUB/candidate/jobs" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-search mr-2"></i> Browse Jobs
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
