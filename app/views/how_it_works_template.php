<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - How It Works</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <base href="/Talent-HUB/">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .step-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .timeline-line {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
            100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-purple-600">TalentHub</h1>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-700 hover:text-purple-600 font-medium transition">Home</a>
                    <a href="/find-talent" class="text-gray-700 hover:text-purple-600 font-medium transition">Find Talent</a>
                    <a href="/find-jobs" class="text-gray-700 hover:text-purple-600 font-medium transition">Find Jobs</a>
                    <a href="/how-it-works" class="text-purple-600 border-b-2 border-purple-600 font-medium transition">How It Works</a>
                    <a href="/pricing" class="text-gray-700 hover:text-purple-600 font-medium transition">Pricing</a>
                    <a href="/blog" class="text-gray-700 hover:text-purple-600 font-medium transition">Blog</a>
                </div>
                
                <div class="flex space-x-4">
                    <a href="/login" class="text-purple-600 border border-purple-600 px-4 py-2 rounded-lg hover:bg-purple-50 transition">Log In</a>
                    <a href="/register" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="gradient-bg py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 text-shadow fade-in">
                How TalentHub Works
            </h1>
            <p class="text-xl text-gray-100 mb-8 max-w-3xl mx-auto fade-in">
                Connecting talent with opportunity has never been easier. Discover our simple yet powerful platform designed to help you find your perfect match.
            </p>
            <div class="flex justify-center space-x-4 fade-in">
                <a href="/register" class="bg-white text-purple-600 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition pulse">
                    Get Started Now
                </a>
                <a href="#process" class="border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-purple-600 transition">
                    Learn More
                </a>
            </div>
        </div>
    </section>
    
    <!-- For Job Seekers Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">For Job Seekers</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Find your dream job in three simple steps. Our intelligent matching system connects you with opportunities that fit your skills and aspirations.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="step-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                            1
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Create Your Profile</h3>
                    <p class="text-gray-600 mb-4">
                        Sign up and build your professional profile. Highlight your skills, experience, and career preferences to stand out to recruiters.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Upload your resume
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Showcase your portfolio
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Set job preferences
                        </li>
                    </ul>
                </div>
                
                <!-- Step 2 -->
                <div class="step-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                            2
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Get Matched</h3>
                    <p class="text-gray-600 mb-4">
                        Our AI-powered matching algorithm analyzes your profile and connects you with relevant job opportunities from top companies.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Smart job recommendations
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Company insights
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Salary estimates
                        </li>
                    </ul>
                </div>
                
                <!-- Step 3 -->
                <div class="step-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                            3
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Apply & Connect</h3>
                    <p class="text-gray-600 mb-4">
                        Apply with one click and connect directly with hiring managers. Track your applications and communicate seamlessly through our platform.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            One-click applications
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Direct messaging
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Application tracking
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!-- For Employers Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">For Employers</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Find the perfect talent for your team. Post jobs, review candidates, and hire the best fit for your organization.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="step-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            1
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Post Your Jobs</h3>
                    <p class="text-gray-600 mb-4">
                        Create detailed job postings and reach thousands of qualified candidates. Use our templates or customize your own.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Job description templates
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Company branding
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Multi-job posting
                        </li>
                    </ul>
                </div>
                
                <!-- Step 2 -->
                <div class="step-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            2
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Review Candidates</h3>
                    <p class="text-gray-600 mb-4">
                        Access our curated talent pool and review applications. Use advanced filters to find candidates that match your requirements.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Advanced search filters
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Skills assessment
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Video interviews
                        </li>
                    </ul>
                </div>
                
                <!-- Step 3 -->
                <div class="step-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            3
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Hire & Onboard</h3>
                    <p class="text-gray-600 mb-4">
                        Connect with top candidates, schedule interviews, and manage the hiring process all in one place.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Interview scheduling
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Offer management
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Onboarding tools
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Why Choose TalentHub?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Discover the features that make TalentHub the preferred choice for millions of job seekers and employers worldwide.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-robot text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">AI-Powered Matching</h3>
                    <p class="text-gray-600 text-sm">Smart algorithms that connect the right talent with the right opportunities</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Secure & Verified</h3>
                    <p class="text-gray-600 text-sm">All profiles and companies are thoroughly verified for your safety</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bolt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Instant Results</h3>
                    <p class="text-gray-600 text-sm">Get matched and apply to jobs in minutes, not days or weeks</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">24/7 Support</h3>
                    <p class="text-gray-600 text-sm">Our dedicated support team is always here to help you succeed</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="gradient-bg py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Join thousands of professionals and companies who have already found success on TalentHub.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="/register" class="bg-white text-purple-600 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition pulse">
                    Sign Up Free
                </a>
                <a href="/pricing" class="border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-purple-600 transition">
                    View Pricing
                </a>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">TalentHub</h3>
                    <p class="text-gray-400">Connecting talent with opportunity worldwide.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">For Job Seekers</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/find-jobs" class="hover:text-white transition">Browse Jobs</a></li>
                        <li><a href="/candidate/dashboard" class="hover:text-white transition">Dashboard</a></li>
                        <li><a href="#" class="hover:text-white transition">Career Advice</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">For Employers</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/find-talent" class="hover:text-white transition">Find Talent</a></li>
                        <li><a href="/recruiter/dashboard" class="hover:text-white transition">Post Jobs</a></li>
                        <li><a href="/pricing" class="hover:text-white transition">Pricing</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/how-it-works" class="hover:text-white transition">How It Works</a></li>
                        <li><a href="/blog" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 TalentHub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
