<?php ob_start(); ?>

<!-- Candidates Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Candidates</h1>
        <p class="mt-2 text-gray-600">Browse and connect with talented professionals.</p>
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

    <!-- Search and Filters -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <form action="/Talent-HUB/recruiter/candidates" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Name, skills...">
                </div>
                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                    <select id="experience" name="experience" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Levels</option>
                        <option value="0-2" <?= (($_GET['experience'] ?? '') === '0-2') ? 'selected' : '' ?>>Entry Level (0-2 years)</option>
                        <option value="2-5" <?= (($_GET['experience'] ?? '') === '2-5') ? 'selected' : '' ?>>Mid Level (2-5 years)</option>
                        <option value="5-10" <?= (($_GET['experience'] ?? '') === '5-10') ? 'selected' : '' ?>>Senior Level (5-10 years)</option>
                        <option value="10+" <?= (($_GET['experience'] ?? '') === '10+') ? 'selected' : '' ?>>Expert Level (10+ years)</option>
                    </select>
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <input type="text" id="location" name="location" value="<?= htmlspecialchars($_GET['location'] ?? '') ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="City, or Remote">
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search mr-2"></i> Search Candidates
                </button>
            </div>
        </form>
    </div>

    <!-- Candidates List -->
    <div class="space-y-4">
        <?php if (!empty($candidates)): ?>
            <?php foreach ($candidates as $candidate): ?>
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-medium"><?= strtoupper(substr($candidate['fullname'], 0, 1)) ?></span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($candidate['fullname']) ?></h3>
                                <p class="text-gray-600">Candidate</p>
                                <p class="text-sm text-gray-500">
                                    <?= !empty($candidate['phone']) ? 'Phone: ' . htmlspecialchars($candidate['phone']) : 'Phone not specified' ?>
                                </p>
                                <p class="text-sm text-gray-500">Member since <?= !empty($candidate['created_at']) ? date('F Y', strtotime($candidate['created_at'])) : 'Unknown' ?></p>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <a href="/Talent-HUB/recruiter/candidates/view?id=<?= $candidate['id'] ?>" 
                               class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 text-center">
                                <i class="fas fa-eye mr-1"></i> View Profile
                            </a>
                            <a href="mailto:<?= htmlspecialchars($candidate['email']) ?>" 
                               class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 text-center">
                                <i class="fas fa-envelope mr-1"></i> Contact
                            </a>
                            <button onclick="confirmDelete(<?= $candidate['id'] ?>, '<?= htmlspecialchars($candidate['fullname']) ?>')" 
                                    class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">
                                <i class="fas fa-trash mr-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-12">
                <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No candidates found</h3>
                <p class="text-gray-500">Try adjusting your search criteria or check back later for new candidates.</p>
            </div>
        <?php endif; ?>
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
