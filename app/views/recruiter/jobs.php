<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Job Postings</h2>
        <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
            <i class="fas fa-plus mr-2"></i> Post New Job
        </button>
    </div>
    
    <div class="space-y-4">
        <!-- Sample Job 1 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Senior Full Stack Developer</h3>
                    <p class="text-gray-600">Remote • Full-time • $120k-$150k</p>
                    <p class="text-sm text-gray-500 mt-1">Posted on March 15, 2026</p>
                    <div class="mt-2 flex space-x-2">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">PHP</span>
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">JavaScript</span>
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">React</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="text-green-600 hover:text-green-800">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <span class="font-medium">45 applications</span> • 
                    <span class="text-green-600">12 shortlisted</span>
                </div>
                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Applications</button>
            </div>
        </div>
        
        <!-- Sample Job 2 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Frontend Developer</h3>
                    <p class="text-gray-600">New York, NY • Full-time • $80k-$100k</p>
                    <p class="text-sm text-gray-500 mt-1">Posted on March 10, 2026</p>
                    <div class="mt-2 flex space-x-2">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">HTML</span>
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">CSS</span>
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Vue.js</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="text-green-600 hover:text-green-800">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <span class="font-medium">32 applications</span> • 
                    <span class="text-green-600">8 shortlisted</span>
                </div>
                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Applications</button>
            </div>
        </div>
        
        <!-- Sample Job 3 -->
        <div class="border border-gray-200 rounded-lg p-4 opacity-75">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Backend Developer</h3>
                    <p class="text-gray-600">San Francisco, CA • Full-time • $100k-$130k</p>
                    <p class="text-sm text-gray-500 mt-1">Posted on March 1, 2026</p>
                    <div class="mt-2 flex space-x-2">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Python</span>
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Django</span>
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">PostgreSQL</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="text-green-600 hover:text-green-800">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <span class="font-medium">28 applications</span> • 
                    <span class="text-green-600">5 shortlisted</span>
                </div>
                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Applications</button>
            </div>
        </div>
    </div>
    
    <div class="mt-6">
        <nav class="flex justify-center">
            <div class="flex space-x-2">
                <button class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md">1</button>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">2</button>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">3</button>
            </div>
        </nav>
    </div>
</div>
