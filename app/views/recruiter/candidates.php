<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Candidates</h2>
        <div class="flex space-x-2">
            <input type="text" placeholder="Search candidates..." class="border border-gray-300 rounded-md shadow-sm p-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Skills</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option>All Skills</option>
                    <option>PHP</option>
                    <option>JavaScript</option>
                    <option>Python</option>
                    <option>React</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Experience</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option>All Levels</option>
                    <option>Entry Level (0-2 years)</option>
                    <option>Mid Level (2-5 years)</option>
                    <option>Senior Level (5+ years)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option>All Locations</option>
                    <option>Remote</option>
                    <option>New York</option>
                    <option>San Francisco</option>
                    <option>London</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="space-y-4">
        <!-- Sample Candidate 1 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-medium">JD</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">John Doe</h3>
                        <p class="text-gray-600">Senior Full Stack Developer</p>
                        <p class="text-sm text-gray-500">5 years experience • New York, NY</p>
                        <div class="mt-2 flex space-x-2">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">PHP</span>
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">JavaScript</span>
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">React</span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-1 px-3 rounded">
                        View Profile
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-1 px-3 rounded">
                        Contact
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Sample Candidate 2 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-medium">AS</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Alice Smith</h3>
                        <p class="text-gray-600">Frontend Developer</p>
                        <p class="text-sm text-gray-500">3 years experience • Remote</p>
                        <div class="mt-2 flex space-x-2">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">HTML</span>
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">CSS</span>
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Vue.js</span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-1 px-3 rounded">
                        View Profile
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-1 px-3 rounded">
                        Contact
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Sample Candidate 3 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-medium">BJ</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Bob Johnson</h3>
                        <p class="text-gray-600">Backend Developer</p>
                        <p class="text-sm text-gray-500">7 years experience • San Francisco, CA</p>
                        <div class="mt-2 flex space-x-2">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Python</span>
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Django</span>
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">PostgreSQL</span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-1 px-3 rounded">
                        View Profile
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-1 px-3 rounded">
                        Contact
                    </button>
                </div>
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
