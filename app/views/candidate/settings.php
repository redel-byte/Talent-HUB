<?php require_once __DIR__ . '/../candidate/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Settings</h2>
    
    <div class="space-y-8">
        <!-- Account Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Account Settings</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Notifications</label>
                    <div class="mt-2 space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Job application updates</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">New job recommendations</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Marketing emails</span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Profile Visibility</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option>Public - Anyone can view my profile</option>
                        <option>Private - Only recruiters can view my profile</option>
                        <option>Hidden - My profile is not visible</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Security Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Security</h3>
            <div class="space-y-4">
                <div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                        Change Password
                    </button>
                </div>
                <div>
                    <button class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md">
                        Enable Two-Factor Authentication
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Privacy Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Privacy</h3>
            <div class="space-y-4">
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Allow recruiters to contact me</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Show my online status</span>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Danger Zone -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-lg font-medium text-red-600 mb-4">Danger Zone</h3>
            <div class="space-y-4">
                <div>
                    <button class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
                        Delete Account
                    </button>
                    <p class="mt-2 text-sm text-gray-500">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-8">
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
            Save All Settings
        </button>
    </div>
</div>
