<?php ob_start(); ?>

<!-- Dashboard Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="mt-2 text-gray-600">System overview and administrative controls.</p>
    </div>

    <!-- System Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                            <dd class="text-lg font-medium text-gray-900">1,847</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-briefcase text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Active Jobs</dt>
                            <dd class="text-lg font-medium text-gray-900">423</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <i class="fas fa-file-alt text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Applications</dt>
                            <dd class="text-lg font-medium text-gray-900">8,234</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">System Alerts</dt>
                            <dd class="text-lg font-medium text-gray-900">3</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">User Distribution by Role</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-500 rounded mr-3"></div>
                            <span class="text-sm font-medium text-gray-900">Candidates</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 mr-2">1,234</span>
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 67%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded mr-3"></div>
                            <span class="text-sm font-medium text-gray-900">Recruiters</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 mr-2">598</span>
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 32%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-red-500 rounded mr-3"></div>
                            <span class="text-sm font-medium text-gray-900">Admins</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 mr-2">15</span>
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 1%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent System Activity</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-plus text-green-600 text-xs"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">New user registration</p>
                            <p class="text-sm text-gray-500">sarah.johnson@email.com registered as Candidate</p>
                            <p class="text-xs text-gray-400">2 minutes ago</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-briefcase text-blue-600 text-xs"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">New job posting</p>
                            <p class="text-sm text-gray-500">Tech Corp posted "Senior Developer" position</p>
                            <p class="text-xs text-gray-400">15 minutes ago</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-file-alt text-yellow-600 text-xs"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">New application submitted</p>
                            <p class="text-sm text-gray-500">John Doe applied to "Frontend Developer" at StartupXYZ</p>
                            <p class="text-xs text-gray-400">1 hour ago</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-red-600 text-xs"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">System alert</p>
                            <p class="text-sm text-gray-500">Database backup completed successfully</p>
                            <p class="text-xs text-gray-400">2 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Actions -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Administrative Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <button class="flex items-center justify-center px-4 py-3 bg-red-600 text-white rounded-md shadow-sm text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-user-plus mr-2"></i> Create User
                </button>
                <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-download mr-2"></i> Export Data
                </button>
                <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-database mr-2"></i> Backup System
                </button>
                <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-cog mr-2"></i> System Settings
                </button>
            </div>
        </div>
    </div>

    <!-- System Health -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">System Health</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Database</span>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Healthy</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">API Server</span>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Online</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Storage</span>
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">78% Used</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Memory</span>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">45% Used</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Logins</h3>
                <div class="space-y-2">
                    <div class="text-sm">
                        <p class="font-medium text-gray-900">admin@talenthub.com</p>
                        <p class="text-gray-500">Admin • 5 min ago</p>
                    </div>
                    <div class="text-sm">
                        <p class="font-medium text-gray-900">recruiter@techcorp.com</p>
                        <p class="text-gray-500">Recruiter • 12 min ago</p>
                    </div>
                    <div class="text-sm">
                        <p class="font-medium text-gray-900">candidate@email.com</p>
                        <p class="text-gray-500">Candidate • 1 hour ago</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Stats</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Today's Signups</span>
                        <span class="text-sm font-medium text-gray-900">23</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Active Sessions</span>
                        <span class="text-sm font-medium text-gray-900">147</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Failed Logins</span>
                        <span class="text-sm font-medium text-gray-900">8</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Server Load</span>
                        <span class="text-sm font-medium text-gray-900">0.42</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
