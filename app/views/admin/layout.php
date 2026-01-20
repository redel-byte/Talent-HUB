<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'TalentHub Admin') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-red-600 shadow-lg border-b border-red-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-shield-alt text-white text-2xl mr-3"></i>
                        <span class="text-xl font-bold text-white">TalentHub Admin</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Admin Navigation -->
                    <div class="flex items-center space-x-4">
                        <a href="/systemAuth/admin/dashboard" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-home mr-1"></i> Dashboard
                        </a>
                        <a href="/systemAuth/admin/users" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-users mr-1"></i> Users
                        </a>
                        <a href="/systemAuth/admin/roles" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-user-tag mr-1"></i> Roles
                        </a>
                        <a href="/systemAuth/admin/system" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-cogs mr-1"></i> System
                        </a>
                        <a href="/systemAuth/admin/logs" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-list-alt mr-1"></i> Logs
                        </a>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="relative">
                        <div class="flex items-center space-x-3">
                            <div class="text-sm text-white">
                                <p class="text-red-200">Administrator</p>
                                <p class="font-medium"><?= htmlspecialchars($user['email']) ?></p>
                            </div>
                            <div class="w-8 h-8 bg-red-800 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium">A</span>
                            </div>
                            <a href="/systemAuth/logout" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-sm text-gray-500">
                © 2026 TalentHub Admin Panel. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
