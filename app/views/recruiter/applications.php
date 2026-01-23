<?php ob_start(); ?>

<!-- Applications Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Job Applications</h1>
        <p class="mt-2 text-gray-600">Manage applications for <span class="font-medium"><?= htmlspecialchars($job['title']) ?></span>.</p>
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

    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <?php if (!empty($applications)): ?>
                <div class="space-y-4">
                    <?php foreach ($applications as $application): ?>
                        <?php 
                        $statusClass = match($application['status'] ?? 'pending') {
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'accepted' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                            'interview' => 'bg-blue-100 text-blue-800',
                            default => 'bg-gray-100 text-gray-800'
                        };
                        $statusText = match($application['status'] ?? 'pending') {
                            'pending' => 'Under Review',
                            'accepted' => 'Accepted',
                            'rejected' => 'Rejected',
                            'interview' => 'Interview Scheduled',
                            default => 'Unknown'
                        };
                        ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($application['fullname']) ?></h3>
                                    <p class="text-gray-600"><?= htmlspecialchars($application['email']) ?></p>
                                    <p class="text-sm text-gray-500 mt-1">Applied on <?= date('F j, Y', strtotime($application['created_at'])) ?></p>
                                    
                                    <?php if (!empty($application['cover_letter'])): ?>
                                        <div class="mt-3 p-3 bg-gray-50 rounded-md">
                                            <p class="text-sm text-gray-700"><strong>Cover Letter:</strong> <?= htmlspecialchars(substr($application['cover_letter'], 0, 200)) ?>...</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-4">
                                    <span class="px-3 py-1 text-xs font-medium <?= $statusClass ?> rounded-full">
                                        <?= $statusText ?>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium" onclick="showApplicationDetails(<?= $application['id'] ?>)">
                                        <i class="fas fa-eye mr-1"></i> View Details
                                    </button>
                                    <a href="mailto:<?= htmlspecialchars($application['email']) ?>" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                        <i class="fas fa-envelope mr-1"></i> Contact
                                    </a>
                                </div>
                                
                                <?php if ($application['status'] === 'pending'): ?>
                                    <form action="/Talent-HUB/recruiter/applications/update" method="POST" class="flex space-x-2">
                                        <input type="hidden" name="application_id" value="<?= $application['id'] ?>">
                                        <button type="submit" name="status" value="accepted" 
                                                class="px-3 py-1 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
                                            <i class="fas fa-check mr-1"></i> Accept
                                        </button>
                                        <button type="submit" name="status" value="rejected" 
                                                class="px-3 py-1 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
                                            <i class="fas fa-times mr-1"></i> Reject
                                        </button>
                                        <button type="submit" name="status" value="interview" 
                                                class="px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                            <i class="fas fa-calendar mr-1"></i> Interview
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form action="/Talent-HUB/recruiter/applications/update" method="POST" class="flex space-x-2">
                                        <input type="hidden" name="application_id" value="<?= $application['id'] ?>">
                                        <select name="status" class="px-3 py-1 border border-gray-300 text-sm rounded" onchange="this.form.submit()">
                                            <option value="pending" <?= $application['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="accepted" <?= $application['status'] === 'accepted' ? 'selected' : '' ?>>Accepted</option>
                                            <option value="rejected" <?= $application['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                            <option value="interview" <?= $application['status'] === 'interview' ? 'selected' : '' ?>>Interview</option>
                                        </select>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <i class="fas fa-file-alt text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No applications yet</h3>
                    <p class="text-gray-500">Candidates haven't applied to this job yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="mt-6">
        <a href="/Talent-HUB/recruiter/jobs" class="text-blue-600 hover:text-blue-800 font-medium">
            <i class="fas fa-arrow-left mr-2"></i> Back to Jobs
        </a>
    </div>
</div>

<!-- Application Details Modal -->
<div id="detailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-2/3 max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Application Details</h3>
                <button onclick="hideDetailsModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="applicationDetails" class="space-y-4">
                <!-- Details will be populated dynamically -->
            </div>
        </div>
    </div>
</div>

<script>
function showApplicationDetails(applicationId) {
    // In a real application, this would fetch details via AJAX
    // For now, we'll show a simple message
    document.getElementById('applicationDetails').innerHTML = `
        <div class="bg-gray-50 p-4 rounded-md">
            <p class="text-gray-700">Full application details would be shown here in a complete implementation.</p>
            <p class="text-sm text-gray-500 mt-2">Application ID: ${applicationId}</p>
        </div>
    `;
    document.getElementById('detailsModal').classList.remove('hidden');
}

function hideDetailsModal() {
    document.getElementById('detailsModal').classList.add('hidden');
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>