<?php require_once __DIR__ . '/../candidate/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">My Profile</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" value="<?= htmlspecialchars($user['first_name'] ?? 'John') ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" value="<?= htmlspecialchars($user['email']) ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="tel" placeholder="+1 234 567 8900" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
            </div>
        </div>
        
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Professional Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input type="text" placeholder="Senior Developer" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Experience</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option>0-2 years</option>
                        <option>2-5 years</option>
                        <option>5-10 years</option>
                        <option>10+ years</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Skills</label>
                    <textarea placeholder="PHP, JavaScript, React..." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" rows="3"></textarea>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-6">
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
            Save Changes
        </button>
    </div>
</div>
