<?php require_once __DIR__ . '/../admin/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Roles</h2>
        <button class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
            <i class="fas fa-plus mr-2"></i> Create New Role
        </button>
    </div>
    
    <!-- Roles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Admin Role -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-medium text-gray-900">Administrator</h3>
                <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded">System</span>
            </div>
            <p class="text-sm text-gray-600 mb-4">Full system access including user management, system settings, and all content.</p>
            <div class="space-y-2">
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    User Management
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    System Settings
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Content Management
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Analytics & Reports
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <span class="text-sm text-gray-500">2 users assigned</span>
            </div>
        </div>
        
        <!-- Recruiter Role -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-medium text-gray-900">Recruiter</h3>
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Standard</span>
            </div>
            <p class="text-sm text-gray-600 mb-4">Can post jobs, review applications, and manage company profile.</p>
            <div class="space-y-2">
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Job Posting Management
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Application Review
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Candidate Search
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Company Profile
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <span class="text-sm text-gray-500">15 users assigned</span>
            </div>
        </div>
        
        <!-- Candidate Role -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-medium text-gray-900">Candidate</h3>
                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Standard</span>
            </div>
            <p class="text-sm text-gray-600 mb-4">Can create profile, search jobs, and submit applications.</p>
            <div class="space-y-2">
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Profile Management
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Job Search
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Application Tracking
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Settings Management
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <span class="text-sm text-gray-500">156 users assigned</span>
            </div>
        </div>
        
        <!-- Moderator Role -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-medium text-gray-900">Moderator</h3>
                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Custom</span>
            </div>
            <p class="text-sm text-gray-600 mb-4">Can moderate content and review flagged items.</p>
            <div class="space-y-2">
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Content Moderation
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    User Flagging
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Report Review
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-times text-red-500 mr-2"></i>
                    User Management
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <span class="text-sm text-gray-500">3 users assigned</span>
            </div>
        </div>
        
        <!-- HR Manager Role -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-medium text-gray-900">HR Manager</h3>
                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Custom</span>
            </div>
            <p class="text-sm text-gray-600 mb-4">Enhanced recruiter capabilities with team management.</p>
            <div class="space-y-2">
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Team Management
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Advanced Analytics
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Budget Management
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <i class="fas fa-times text-red-500 mr-2"></i>
                    System Settings
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <span class="text-sm text-gray-500">8 users assigned</span>
            </div>
        </div>
    </div>
    
    <!-- Role Statistics -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-purple-50 p-4 rounded-lg">
            <div class="text-purple-600 text-2xl font-bold">2</div>
            <div class="text-purple-900 text-sm font-medium">Administrators</div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg">
            <div class="text-green-600 text-2xl font-bold">15</div>
            <div class="text-green-900 text-sm font-medium">Recruiters</div>
        </div>
        <div class="bg-blue-50 p-4 rounded-lg">
            <div class="text-blue-600 text-2xl font-bold">156</div>
            <div class="text-blue-900 text-sm font-medium">Candidates</div>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg">
            <div class="text-yellow-600 text-2xl font-bold">11</div>
            <div class="text-yellow-900 text-sm font-medium">Custom Roles</div>
        </div>
    </div>
</div>
