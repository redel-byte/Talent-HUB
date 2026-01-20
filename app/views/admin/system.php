<?php require_once __DIR__ . '/../admin/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">System Settings</h2>
    
    <div class="space-y-8">
        <!-- General Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">General Settings</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Site Name</label>
                    <input type="text" value="TalentHub" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Site Email</label>
                    <input type="email" value="noreply@talenthub.com" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Timezone</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option>UTC</option>
                        <option>EST</option>
                        <option>PST</option>
                        <option>CST</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Default Language</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option>English</option>
                        <option>Spanish</option>
                        <option>French</option>
                        <option>German</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Registration Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Registration Settings</h3>
            <div class="space-y-4">
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Allow new user registrations</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Require email verification</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Admin approval required for new accounts</span>
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Default User Role</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option>Candidate</option>
                        <option>Recruiter</option>
                        <option>Pending Approval</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Email Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Email Configuration</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">SMTP Host</label>
                    <input type="text" value="smtp.gmail.com" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">SMTP Port</label>
                    <input type="number" value="587" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">SMTP Username</label>
                    <input type="text" value="admin@talenthub.com" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">SMTP Password</label>
                    <input type="password" value="••••••••" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
            </div>
            <div class="mt-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded">
                    Test Email Configuration
                </button>
            </div>
        </div>
        
        <!-- Security Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Security Settings</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Session Timeout (minutes)</label>
                    <input type="number" value="30" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Enable two-factor authentication</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Require strong passwords</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Enable login attempt logging</span>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Backup Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Backup Settings</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Backup Frequency</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                    </select>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Automatic backups enabled</span>
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Backup Retention (days)</label>
                    <input type="number" value="30" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <button class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded">
                        Create Backup Now
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-8">
        <button class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
            Save System Settings
        </button>
    </div>
</div>
