<?php
// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $_SESSION['role'] ?? '';
$userEmail = $_SESSION['email'] ?? '';
?>

<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-purple-600">TalentHub</h1>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-8">
                <?php if (!$isLoggedIn): ?>
                    <!-- Public navigation -->
                    <a href="/Talent-HUB/" class="text-gray-700 hover:text-purple-600 font-medium transition">Home</a>
                    <a href="/Talent-HUB/find-talent" class="text-gray-700 hover:text-purple-600 font-medium transition">Find Talent</a>
                    <a href="/Talent-HUB/find-jobs" class="text-gray-700 hover:text-purple-600 font-medium transition">Find Jobs</a>
                    <a href="/Talent-HUB/how-it-works" class="text-gray-700 hover:text-purple-600 font-medium transition">How It Works</a>
                    <a href="/Talent-HUB/pricing" class="text-gray-700 hover:text-purple-600 font-medium transition">Pricing</a>
                    <a href="/Talent-HUB/blog" class="text-gray-700 hover:text-purple-600 font-medium transition">Blog</a>
                <?php else: ?>
                    <!-- Authenticated navigation -->
                    <a href="/Talent-HUB/" class="text-gray-700 hover:text-purple-600 font-medium transition">Home</a>
                    <?php if ($userRole === 'candidate'): ?>
                        <a href="/Talent-HUB/candidate/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition">Dashboard</a>
                        <a href="/Talent-HUB/candidate/applications" class="text-gray-700 hover:text-purple-600 font-medium transition">Applications</a>
                        <a href="/Talent-HUB/candidate/profile" class="text-gray-700 hover:text-purple-600 font-medium transition">Profile</a>
                        <a href="/Talent-HUB/candidate/settings" class="text-gray-700 hover:text-purple-600 font-medium transition">Settings</a>
                    <?php elseif ($userRole === 'recruiter'): ?>
                        <a href="/Talent-HUB/recruiter/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition">Dashboard</a>
                        <a href="/Talent-HUB/recruiter/jobs" class="text-gray-700 hover:text-purple-600 font-medium transition">My Jobs</a>
                        <a href="/Talent-HUB/recruiter/candidates" class="text-gray-700 hover:text-purple-600 font-medium transition">Candidates</a>
                        <a href="/Talent-HUB/recruiter/company" class="text-gray-700 hover:text-purple-600 font-medium transition">Company</a>
                        <a href="/Talent-HUB/recruiter/settings" class="text-gray-700 hover:text-purple-600 font-medium transition">Settings</a>
                    <?php elseif ($userRole === 'admin'): ?>
                        <a href="/Talent-HUB/admin/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition">Dashboard</a>
                        <a href="/Talent-HUB/admin/users" class="text-gray-700 hover:text-purple-600 font-medium transition">Users</a>
                        <a href="/Talent-HUB/admin/roles" class="text-gray-700 hover:text-purple-600 font-medium transition">Roles</a>
                        <a href="/Talent-HUB/admin/system" class="text-gray-700 hover:text-purple-600 font-medium transition">System</a>
                        <a href="/Talent-HUB/admin/logs" class="text-gray-700 hover:text-purple-600 font-medium transition">Logs</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            
            <!-- Authentication Section -->
            <div class="nav-auth-container">
                <?php if (!$isLoggedIn): ?>
                    <!-- Not logged in -->
                    <div class="flex space-x-4">
                        <a href="/Talent-HUB/login" class="text-purple-600 border border-purple-600 px-4 py-2 rounded-lg hover:bg-purple-50 transition">Log In</a>
                        <a href="/Talent-HUB/register" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Sign Up</a>
                    </div>
                <?php else: ?>
                    <!-- Logged in - Show user menu -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 px-3 py-2 rounded-lg hover:bg-purple-50 transition">
                            <i class="fas fa-user-circle"></i>
                            <span class="hidden md:block"><?= htmlspecialchars($userEmail) ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <a href="/Talent-HUB/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                <i class="fas fa-home mr-2"></i>Home
                            </a>
                            <?php if ($userRole === 'candidate'): ?>
                                <a href="/Talent-HUB/candidate/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <a href="/Talent-HUB/candidate/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <a href="/Talent-HUB/candidate/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-cog mr-2"></i>Settings
                                </a>
                            <?php elseif ($userRole === 'recruiter'): ?>
                                <a href="/Talent-HUB/recruiter/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <a href="/Talent-HUB/recruiter/jobs" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-briefcase mr-2"></i>My Jobs
                                </a>
                                <a href="/Talent-HUB/recruiter/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-cog mr-2"></i>Settings
                                </a>
                            <?php elseif ($userRole === 'admin'): ?>
                                <a href="/Talent-HUB/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <a href="/Talent-HUB/admin/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-cog mr-2"></i>Settings
                                </a>
                            <?php endif; ?>
                            <div class="border-t border-gray-200">
                                <a href="/Talent-HUB/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button class="mobile-menu-btn text-gray-700 hover:text-purple-600 p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div class="mobile-menu hidden fixed inset-0 bg-black bg-opacity-50 z-50 md:hidden">
            <div class="bg-white w-64 h-full shadow-lg">
                <div class="p-4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-purple-600">Menu</h2>
                        <button class="mobile-menu-close text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <?php if (!$isLoggedIn): ?>
                        <!-- Public mobile menu -->
                        <div class="space-y-2">
                            <a href="/Talent-HUB/" class="block py-2 text-gray-700 hover:text-purple-600">Home</a>
                            <a href="/Talent-HUB/find-talent" class="block py-2 text-gray-700 hover:text-purple-600">Find Talent</a>
                            <a href="/Talent-HUB/find-jobs" class="block py-2 text-gray-700 hover:text-purple-600">Find Jobs</a>
                            <a href="/Talent-HUB/how-it-works" class="block py-2 text-gray-700 hover:text-purple-600">How It Works</a>
                            <a href="/Talent-HUB/pricing" class="block py-2 text-gray-700 hover:text-purple-600">Pricing</a>
                            <a href="/Talent-HUB/blog" class="block py-2 text-gray-700 hover:text-purple-600">Blog</a>
                            <div class="border-t border-gray-200 pt-4 mt-4">
                                <a href="/Talent-HUB/login" class="block py-2 text-purple-600 font-medium">Log In</a>
                                <a href="/Talent-HUB/register" class="block py-2 bg-purple-600 text-white text-center rounded-lg font-medium">Sign Up</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Authenticated mobile menu -->
                        <div class="space-y-2">
                            <a href="/Talent-HUB/" class="block py-2 text-gray-700 hover:text-purple-600">Home</a>
                            <div class="border-b border-gray-200 pb-4 mb-4">
                                <p class="text-sm text-gray-600"><?= htmlspecialchars($userEmail) ?></p>
                                <p class="text-xs text-gray-500 capitalize"><?= htmlspecialchars($userRole) ?></p>
                            </div>
                            <?php if ($userRole === 'candidate'): ?>
                                <a href="/Talent-HUB/candidate/dashboard" class="block py-2 text-gray-700 hover:text-purple-600">Dashboard</a>
                                <a href="/Talent-HUB/candidate/applications" class="block py-2 text-gray-700 hover:text-purple-600">Applications</a>
                                <a href="/Talent-HUB/candidate/profile" class="block py-2 text-gray-700 hover:text-purple-600">Profile</a>
                                <a href="/Talent-HUB/candidate/settings" class="block py-2 text-gray-700 hover:text-purple-600">Settings</a>
                            <?php elseif ($userRole === 'recruiter'): ?>
                                <a href="/Talent-HUB/recruiter/dashboard" class="block py-2 text-gray-700 hover:text-purple-600">Dashboard</a>
                                <a href="/Talent-HUB/recruiter/jobs" class="block py-2 text-gray-700 hover:text-purple-600">My Jobs</a>
                                <a href="/Talent-HUB/recruiter/candidates" class="block py-2 text-gray-700 hover:text-purple-600">Candidates</a>
                                <a href="/Talent-HUB/recruiter/company" class="block py-2 text-gray-700 hover:text-purple-600">Company</a>
                                <a href="/Talent-HUB/recruiter/settings" class="block py-2 text-gray-700 hover:text-purple-600">Settings</a>
                            <?php elseif ($userRole === 'admin'): ?>
                                <a href="/Talent-HUB/admin/dashboard" class="block py-2 text-gray-700 hover:text-purple-600">Dashboard</a>
                                <a href="/Talent-HUB/admin/users" class="block py-2 text-gray-700 hover:text-purple-600">Users</a>
                                <a href="/Talent-HUB/admin/roles" class="block py-2 text-gray-700 hover:text-purple-600">Roles</a>
                                <a href="/Talent-HUB/admin/system" class="block py-2 text-gray-700 hover:text-purple-600">System</a>
                                <a href="/Talent-HUB/admin/logs" class="block py-2 text-gray-700 hover:text-purple-600">Logs</a>
                            <?php endif; ?>
                            <div class="border-t border-gray-200 pt-4 mt-4">
                                <a href="/Talent-HUB/logout" class="block py-2 text-red-600">Logout</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileMenuClose = document.querySelector('.mobile-menu-close');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
        
        if (mobileMenuClose && mobileMenu) {
            mobileMenuClose.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenu && !mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>
