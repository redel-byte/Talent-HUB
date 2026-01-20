<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

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
                            <input type="checkbox" checked class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">New candidate applications</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Application status updates</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Marketing emails</span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Default Application Response</label>
                    <textarea rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Thank you for your application. We will review your profile and get back to you soon.">Thank you for your interest in joining our team. We appreciate the time you took to apply and will review your application carefully.</textarea>
                </div>
            </div>
        </div>
        
        <!-- Job Posting Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Job Posting Settings</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Auto-renew Job Postings</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option>Never</option>
                        <option>After 30 days</option>
                        <option>After 60 days</option>
                        <option>After 90 days</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Application Deadline</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option>No deadline</option>
                        <option>30 days after posting</option>
                        <option>60 days after posting</option>
                        <option>90 days after posting</option>
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
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Require email verification for new team members</span>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Billing Settings -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Billing</h3>
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900">Current Plan: Professional</p>
                            <p class="text-sm text-gray-600">$299/month • 10 active job postings</p>
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded">
                            Upgrade Plan
                        </button>
                    </div>
                </div>
                <div>
                    <button class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md">
                        View Billing History
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-8">
        <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
            Save All Settings
        </button>
    </div>
</div>
