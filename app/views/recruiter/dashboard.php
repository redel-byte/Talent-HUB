<?php ob_start(); ?>

<!-- Dashboard Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Recruiter Dashboard</h1>
        <p class="mt-2 text-gray-600">Manage your job postings and track candidate applications.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-briefcase text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Active Jobs</dt>
                            <dd class="text-lg font-medium text-gray-900">8</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Applicants</dt>
                            <dd class="text-lg font-medium text-gray-900">156</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <i class="fas fa-eye text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Profile Views</dt>
                            <dd class="text-lg font-medium text-gray-900">1,247</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Interview Rate</dt>
                            <dd class="text-lg font-medium text-gray-900">23%</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Applications -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Applications</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">John Smith</p>
                                <p class="text-sm text-gray-500">Senior Developer • Applied 2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="text-green-600 hover:text-green-800">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                                <p class="text-sm text-gray-500">Frontend Developer • Applied 5 hours ago</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="text-green-600 hover:text-green-800">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Mike Davis</p>
                                <p class="text-sm text-gray-500">Full Stack Developer • Applied 1 day ago</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="text-green-600 hover:text-green-800">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="/systemAuth/recruiter/candidates" class="text-sm font-medium text-green-600 hover:text-green-500">
                        View all applications <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Job Postings -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Active Job Postings</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">Senior PHP Developer</h4>
                                <p class="text-sm text-gray-500">Posted 3 days ago • 24 applicants</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="text-xs text-gray-400"><i class="fas fa-map-marker-alt mr-1"></i> New York</span>
                                    <span class="text-xs text-gray-400"><i class="fas fa-dollar-sign mr-1"></i> $80k-$120k</span>
                                    <span class="text-xs text-gray-400"><i class="fas fa-clock mr-1"></i> Full-time</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">Frontend Developer</h4>
                                <p class="text-sm text-gray-500">Posted 1 week ago • 18 applicants</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="text-xs text-gray-400"><i class="fas fa-map-marker-alt mr-1"></i> Remote</span>
                                    <span class="text-xs text-gray-400"><i class="fas fa-dollar-sign mr-1"></i> $70k-$100k</span>
                                    <span class="text-xs text-gray-400"><i class="fas fa-clock mr-1"></i> Full-time</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">DevOps Engineer</h4>
                                <p class="text-sm text-gray-500">Posted 2 weeks ago • 31 applicants</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="text-xs text-gray-400"><i class="fas fa-map-marker-alt mr-1"></i> San Francisco</span>
                                    <span class="text-xs text-gray-400"><i class="fas fa-dollar-sign mr-1"></i> $90k-$130k</span>
                                    <span class="text-xs text-gray-400"><i class="fas fa-clock mr-1"></i> Full-time</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="/systemAuth/recruiter/jobs" class="text-sm font-medium text-green-600 hover:text-green-500">
                        Manage all postings <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button class="flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-md shadow-sm text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-plus mr-2"></i> Post New Job
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-search mr-2"></i> Search Candidates
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-building mr-2"></i> Update Company
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-chart-bar mr-2"></i> View Analytics
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
