<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Company Profile</h2>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Company Info -->
        <div class="lg:col-span-2 space-y-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Company Name</label>
                        <input type="text" value="TechCorp Inc." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Industry</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            <option>Technology</option>
                            <option>Finance</option>
                            <option>Healthcare</option>
                            <option>Education</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Company Size</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            <option>1-10 employees</option>
                            <option>11-50 employees</option>
                            <option>51-200 employees</option>
                            <option>201-500 employees</option>
                            <option>500+ employees</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Website</label>
                        <input type="url" value="https://techcorp.com" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Company Description</label>
                <textarea rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Tell us about your company...">We are a leading technology company specializing in innovative software solutions that help businesses transform their digital presence.</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Company Benefits</label>
                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Health Insurance</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">401(k) Plan</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Remote Work</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Flexible Hours</span>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Company Logo -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Company Logo</h3>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-building text-gray-400 text-2xl"></i>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded">
                    Upload Logo
                </button>
                <p class="text-xs text-gray-500 mt-2">PNG, JPG up to 2MB</p>
            </div>
        </div>
    </div>
    
    <div class="mt-8">
        <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
            Save Company Profile
        </button>
    </div>
</div>
