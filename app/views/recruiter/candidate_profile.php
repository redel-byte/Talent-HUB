<?php ob_start(); ?>

<!-- Candidate Profile Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <a href="/Talent-HUB/recruiter/candidates" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Candidates
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Candidate Profile</h1>
        <p class="mt-2 text-gray-600">Detailed view of candidate information and qualifications.</p>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Personal Information</h2>
                <div class="flex items-center mb-6">
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mr-6">
                        <span class="text-white text-2xl font-medium"><?= strtoupper(substr($candidate['fullname'], 0, 1)) ?></span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($candidate['fullname']) ?></h3>
                        <p class="text-gray-600">Candidate</p>
                        <p class="text-sm text-gray-500 mt-1">Member since <?= !empty($candidate['created_at']) ? date('F Y', strtotime($candidate['created_at'])) : 'Unknown' ?></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Email</h4>
                        <p class="text-gray-900"><?= htmlspecialchars($candidate['email']) ?></p>
                    </div>
                    <?php if (!empty($candidate['phone'])): ?>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Phone</h4>
                            <p class="text-gray-900"><?= htmlspecialchars($candidate['phone']) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Note: Professional Summary and Skills sections removed as these fields don't exist in current database schema -->
        </div>

        <!-- Actions Sidebar -->
        <div class="space-y-6">
            <!-- Contact Actions -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Candidate</h3>
                <div class="space-y-3">
                    <a href="mailto:<?= htmlspecialchars($candidate['email']) ?>" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-green-600 text-white font-medium rounded-md hover:bg-green-700">
                        <i class="fas fa-envelope mr-2"></i> Send Email
                    </a>
                    <button class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                        <i class="fas fa-calendar mr-2"></i> Schedule Interview
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50">
                        <i class="fas fa-download mr-2"></i> Download Resume
                    </button>
                    <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50">
                        <i class="fas fa-bookmark mr-2"></i> Save Candidate
                    </button>
                    <button onclick="confirmDelete(<?= $candidate['id'] ?>, '<?= htmlspecialchars($candidate['fullname']) ?>')" 
                            class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white font-medium rounded-md hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i> Delete Candidate
                    </button>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Candidate Statistics</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Profile Views</span>
                        <span class="font-medium">0</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Applications Sent</span>
                        <span class="font-medium">0</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Interview Requests</span>
                        <span class="font-medium">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Confirm Delete</h3>
            <p class="text-sm text-gray-500 mb-4">Are you sure you want to delete <span id="candidateName" class="font-medium"></span>? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="hideDeleteModal()" 
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                    Cancel
                </button>
                <a id="confirmDeleteBtn" href="#" 
                   class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Delete
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(candidateId, candidateName) {
    document.getElementById('candidateName').textContent = candidateName;
    document.getElementById('confirmDeleteBtn').href = '/Talent-HUB/recruiter/candidates/delete?id=' + candidateId;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function hideDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
