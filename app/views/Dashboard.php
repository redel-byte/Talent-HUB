<!
    <div id="loggedInDashboard" class="min-h-screen bg-gray-50">
        <!-- Dashboard Navigation -->
        <nav class="gradient-bg py-4 px-6 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Logo -->
                <a href="#" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-purple-600 text-xl"></i>
                    </div>
                    <span class="text-white text-2xl font-bold">Talent<span class="text-yellow-300">Hub</span></span>
                </a>
                
                <!-- User Menu -->
                <div class="flex items-center space-x-6">
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="text-white text-right">
                            <p class="font-bold">John Doe</p>
                            <p class="text-sm text-gray-200">Frontend Developer</p>
                        </div>
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-purple-700 font-bold">
                            JD
                        </div>
                    </div>
                    
                    <!-- Logout Button -->
                    <button id="logoutBtn" class="bg-white text-purple-700 font-semibold py-2 px-6 rounded-lg transition duration-300 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </div>
            </div>
        </nav>
        
        <!-- Dashboard Content -->
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex items-center mb-8">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mr-6">
                        <i class="fas fa-user-tie text-purple-600 text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Welcome back, John!</h1>
                        <p class="text-gray-600">Here's what's happening with your TalentHub account today.</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-600 text-sm">Profile Views</p>
                                <p class="text-2xl font-bold text-gray-800">1,248</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-eye text-purple-600"></i>
                            </div>
                        </div>
                        <p class="text-green-600 text-sm mt-2"><i class="fas fa-arrow-up mr-1"></i> 12% from last week</p>
                    </div>
                    
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-600 text-sm">Job Matches</p>
                                <p class="text-2xl font-bold text-gray-800">24</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-briefcase text-blue-600"></i>
                            </div>
                        </div>
                        <p class="text-green-600 text-sm mt-2"><i class="fas fa-arrow-up mr-1"></i> 3 new today</p>
                    </div>
                    
                    <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-600 text-sm">Applications</p>
                                <p class="text-2xl font-bold text-gray-800">8</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-paper-plane text-green-600"></i>
                            </div>
                        </div>
                        <p class="text-green-600 text-sm mt-2">2 pending responses</p>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Recent Activity</h2>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-bell text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">New job match: Senior UX Designer at TechCorp</p>
                                <p class="text-gray-500 text-sm">2 hours ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Your application was viewed by DesignStudio Inc.</p>
                                <p class="text-gray-500 text-sm">1 day ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Profile completeness increased to 92%</p>
                                <p class="text-gray-500 text-sm">2 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
