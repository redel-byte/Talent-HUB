<?php ob_start(); ?>

<!-- Dashboard Content -->
<div class="px-4 py-6 sm:px-0">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Candidate Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome to your personal dashboard. Track your job applications and profile activity.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-file-alt text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Applications</dt>
                            <dd class="text-lg font-medium text-gray-900">12</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-eye text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Profile Views</dt>
                            <dd class="text-lg font-medium text-gray-900">48</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <i class="fas fa-star text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Saved Jobs</dt>
                            <dd class="text-lg font-medium text-gray-900">7</dd>
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
                            <dt class="text-sm font-medium text-gray-500 truncate">Profile Completion</dt>
                            <dd class="text-lg font-medium text-gray-900">85%</dd>
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
                                <i class="fas fa-building text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Senior Developer</p>
                                <p class="text-sm text-gray-500">Tech Corp • Applied 2 days ago</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Under Review</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-building text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Frontend Developer</p>
                                <p class="text-sm text-gray-500">StartupXYZ • Applied 5 days ago</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Interview</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-building text-red-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Full Stack Developer</p>
                                <p class="text-sm text-gray-500">Digital Agency • Applied 1 week ago</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Not Selected</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="/systemAuth/candidate/applications" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        View all applications <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recommended Jobs -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recommended Jobs</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">React Developer</h4>
                                <p class="text-sm text-gray-500">Innovation Labs • Remote</p>
                                <p class="text-xs text-gray-400 mt-1">Posted 3 days ago • $80k-$120k</p>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">PHP Backend Developer</h4>
                                <p class="text-sm text-gray-500">Web Solutions Inc • New York</p>
                                <p class="text-xs text-gray-400 mt-1">Posted 1 week ago • $70k-$100k</p>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">DevOps Engineer</h4>
                                <p class="text-sm text-gray-500">CloudTech • San Francisco</p>
                                <p class="text-xs text-gray-400 mt-1">Posted 2 weeks ago • $90k-$130k</p>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        Browse more jobs <i class="fas fa-arrow-right ml-1"></i>
                    </button>
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
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i> Search Jobs
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-upload mr-2"></i> Upload Resume
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-user-edit mr-2"></i> Update Profile
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-bell mr-2"></i> Notifications
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/layout.php'; ?>
