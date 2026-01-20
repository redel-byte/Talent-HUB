<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - TalentHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8">
        <div class="text-center">
            <!-- 404 Icon -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                <i class="fas fa-search text-yellow-600 text-2xl"></i>
            </div>
            
            <!-- Error Title -->
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Page Not Found</h1>
            <p class="text-gray-600 mb-6">The page you're looking for doesn't exist or has been moved.</p>
            
            <!-- Error Details -->
            <div class="bg-gray-50 rounded-md p-4 mb-6">
                <p class="text-sm text-gray-600">
                    <strong>Requested URL:</strong><br>
                    <code class="text-xs bg-gray-200 px-2 py-1 rounded">
                        <?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? 'Unknown') ?>
                    </code>
                </p>
            </div>
            
            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="/systemAuth/" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-home mr-2"></i>
                    Go to Homepage
                </a>
                
                <button onclick="history.back()" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Go Back
                </button>
            </div>
            
            <!-- Popular Links -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-3">Popular Pages:</p>
                <div class="flex flex-wrap justify-center gap-2">
                    <a href="/systemAuth/login" class="text-xs text-blue-600 hover:text-blue-500">Login</a>
                    <span class="text-xs text-gray-400">•</span>
                    <a href="/systemAuth/register" class="text-xs text-blue-600 hover:text-blue-500">Register</a>
                    <span class="text-xs text-gray-400">•</span>
                    <a href="/systemAuth/candidate/dashboard" class="text-xs text-blue-600 hover:text-blue-500">Candidates</a>
                    <span class="text-xs text-gray-400">•</span>
                    <a href="/systemAuth/recruiter/dashboard" class="text-xs text-blue-600 hover:text-blue-500">Recruiters</a>
                </div>
            </div>
            
            <!-- Help Information -->
            <div class="mt-6">
                <p class="text-xs text-gray-500">
                    If you need assistance, please contact 
                    <a href="mailto:support@talenthub.com" class="text-blue-600 hover:text-blue-500">support@talenthub.com</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Background Pattern -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 -right-40 h-80 w-80 rounded-full bg-yellow-200 opacity-20"></div>
        <div class="absolute -bottom-40 -left-40 h-80 w-80 rounded-full bg-blue-200 opacity-20"></div>
    </div>

    <!-- Easter Egg: 404 Animation -->
    <script>
        // Add a little fun interaction
        document.addEventListener('DOMContentLoaded', function() {
            const icon = document.querySelector('.fa-search');
            let rotation = 0;
            
            setInterval(() => {
                rotation += 360;
                icon.style.transform = `rotate(${rotation}deg)`;
                icon.style.transition = 'transform 2s ease-in-out';
            }, 5000);
        });
    </script>
</body>
</html>
