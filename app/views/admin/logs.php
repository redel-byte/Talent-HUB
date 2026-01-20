<?php require_once __DIR__ . '/../admin/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">System Logs</h2>
        <div class="flex space-x-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded">
                <i class="fas fa-download mr-2"></i> Export Logs
            </button>
            <button class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium py-2 px-4 rounded">
                <i class="fas fa-trash mr-2"></i> Clear Logs
            </button>
        </div>
    </div>
    
    <!-- Filter Options -->
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Log Level</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option>All Levels</option>
                    <option>Error</option>
                    <option>Warning</option>
                    <option>Info</option>
                    <option>Debug</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Date Range</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option>Last 24 hours</option>
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>Last 3 months</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">User</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option>All Users</option>
                    <option>Admin</option>
                    <option>System</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" placeholder="Search logs..." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
        </div>
    </div>
    
    <!-- Logs Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-03-19 14:32:15</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Error</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">john.doe@example.com</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Failed login attempt</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">192.168.1.100</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Invalid password provided</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-03-19 14:30:22</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Info</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">alice.smith@example.com</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">User login</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">192.168.1.105</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Successful authentication</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-03-19 14:25:18</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Warning</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">bob.johnson@example.com</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Password reset requested</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">192.168.1.110</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Password reset email sent</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-03-19 14:20:45</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Info</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">System</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Database backup completed</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">127.0.0.1</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Backup file: backup_20260319_142045.sql</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-03-19 14:15:30</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Info</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">new.user@example.com</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">User registration</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">192.168.1.115</td>
                    <td class="px-6 py-4 text-sm text-gray-500">New candidate account created</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-03-19 14:10:12</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Error</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">System</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Email sending failed</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">127.0.0.1</td>
                    <td class="px-6 py-4 text-sm text-gray-500">SMTP connection timeout</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        <nav class="flex justify-center">
            <div class="flex space-x-2">
                <button class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md">1</button>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">2</button>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">3</button>
            </div>
        </nav>
    </div>
</div>
