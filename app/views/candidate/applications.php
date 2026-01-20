<?php require_once __DIR__ . '/../candidate/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">My Applications</h2>
    
    <div class="space-y-4">
        <!-- Sample Application 1 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Senior Full Stack Developer</h3>
                    <p class="text-gray-600">TechCorp Inc.</p>
                    <p class="text-sm text-gray-500 mt-1">Applied on March 15, 2026</p>
                </div>
                <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                    Under Review
                </span>
            </div>
            <div class="mt-4 flex space-x-2">
                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Details</button>
                <button class="text-gray-600 hover:text-gray-800 text-sm font-medium">Withdraw</button>
            </div>
        </div>
        
        <!-- Sample Application 2 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Frontend Developer</h3>
                    <p class="text-gray-600">Digital Agency</p>
                    <p class="text-sm text-gray-500 mt-1">Applied on March 10, 2026</p>
                </div>
                <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                    Interview Scheduled
                </span>
            </div>
            <div class="mt-4 flex space-x-2">
                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Details</button>
                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Schedule Interview</button>
            </div>
        </div>
        
        <!-- Sample Application 3 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">PHP Developer</h3>
                    <p class="text-gray-600">StartupXYZ</p>
                    <p class="text-sm text-gray-500 mt-1">Applied on March 5, 2026</p>
                </div>
                <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                    Not Selected
                </span>
            </div>
            <div class="mt-4 flex space-x-2">
                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Details</button>
                <button class="text-gray-600 hover:text-gray-800 text-sm font-medium">Reapply</button>
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
