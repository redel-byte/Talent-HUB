<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'TalentHub') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-briefcase text-blue-600 text-2xl mr-3"></i>
                        <span class="text-xl font-bold text-gray-900">TalentHub</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Candidate Navigation -->
                    <div class="flex items-center space-x-4">
                        <a href="/systemAuth/candidate/dashboard" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-home mr-1"></i> Dashboard
                        </a>
                        <a href="/systemAuth/candidate/applications" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-file-alt mr-1"></i> Applications
                        </a>
                        <a href="/systemAuth/candidate/profile" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-user mr-1"></i> Profile
                        </a>
                        <a href="/systemAuth/candidate/settings" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-cog mr-1"></i> Settings
                        </a>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="relative">
                        <div class="flex items-center space-x-3">
                            <div class="text-sm">
                                <p class="text-gray-500">Welcome back,</p>
                                <p class="font-medium text-gray-900"><?= htmlspecialchars($user['email']) ?></p>
                            </div>
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium"><?= strtoupper(substr($user['email'], 0, 1)) ?></span>
                            </div>
                            <a href="/systemAuth/logout" class="text-red-600 hover:text-red-800 px-3 py-2 rounded-md text-sm font-medium">
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
                © 2026 TalentHub. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
