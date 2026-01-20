<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - Home</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <base href="/systemAuth/">
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
        
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        
        .section-padding {
            padding: 80px 0;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
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
                    <a href="" class="text-gray-700 hover:text-purple-600 font-medium transition">Home</a>
                    <a href="find-talent" class="text-gray-700 hover:text-purple-600 font-medium transition">Find Talent</a>
                    <a href="find-jobs" class="text-gray-700 hover:text-purple-600 font-medium transition">Find Jobs</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition">How It Works</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition">Pricing</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition">Blog</a>
                </div>
                
                <div class="flex space-x-4">
                    <a href="login" class="text-purple-600 border border-purple-600 px-4 py-2 rounded-lg hover:bg-purple-50 transition">Log In</a>
                    <a href="register" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg text-white section-padding">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-10 lg:mb-0">
                    <h1 class="text-5xl font-bold mb-6 text-shadow leading-tight">
                        Find Your Dream <span class="text-yellow-300">Career</span> or Perfect <span class="text-yellow-300">Talent</span>
                    </h1>
                    <p class="text-xl mb-8 text-gray-100">
                        Connect thousands of talented professionals with top companies worldwide. Your next opportunity is just a click away.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="find-jobs" class="btn-primary text-white font-semibold py-3 px-8 rounded-lg inline-block">
                            <i class="fas fa-search mr-2"></i> Find Jobs
                        </a>
                        <a href="find-talent" class="glass-effect text-white font-semibold py-3 px-8 rounded-lg inline-block hover:bg-white hover:bg-opacity-20 transition">
                            <i class="fas fa-briefcase mr-2"></i> Post Jobs
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <div class="bg-white bg-opacity-10 rounded-2xl p-8 glass-effect">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="text-center">
                                    <div class="stat-number">50K+</div>
                                    <p class="text-gray-200">Active Jobs</p>
                                </div>
                                <div class="text-center">
                                    <div class="stat-number">25K+</div>
                                    <p class="text-gray-200">Companies</p>
                                </div>
                                <div class="text-center">
                                    <div class="stat-number">100K+</div>
                                    <p class="text-gray-200">Candidates</p>
                                </div>
                                <div class="text-center">
                                    <div class="stat-number">95%</div>
                                    <p class="text-gray-200">Success Rate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section-padding bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Why Choose TalentHub?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We provide the best platform for both job seekers and employers with advanced features and tools.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-user-tie text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Verified Profiles</h3>
                    <p class="text-gray-600 mb-4">
                        All candidates and companies go through our verification process to ensure authenticity and quality.
                    </p>
                    <ul class="text-gray-600 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Identity verification</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Skills assessment</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Background checks</li>
                    </ul>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-robot text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">AI-Powered Matching</h3>
                    <p class="text-gray-600 mb-4">
                        Our advanced AI algorithms match candidates with the perfect job opportunities based on skills, experience, and preferences.
                    </p>
                    <ul class="text-gray-600 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Smart recommendations</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Skill matching</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Culture fit analysis</li>
                    </ul>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Secure & Private</h3>
                    <p class="text-gray-600 mb-4">
                        Your data is protected with enterprise-grade security and privacy controls.
                    </p>
                    <ul class="text-gray-600 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>End-to-end encryption</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>GDPR compliant</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Privacy controls</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="section-padding bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">How It Works</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Get started in minutes and find your perfect match
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Create Profile</h3>
                    <p class="text-gray-600">
                        Sign up and create your detailed profile with skills, experience, and preferences.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Get Matched</h3>
                    <p class="text-gray-600">
                        Our AI system matches you with the best opportunities or candidates based on your profile.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Connect & Hire</h3>
                    <p class="text-gray-600">
                        Connect with your matches, schedule interviews, and make hiring decisions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section-padding bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Success Stories</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Hear from our satisfied users who found their perfect match
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold">JD</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">John Doe</h4>
                            <p class="text-gray-600 text-sm">Software Developer</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">
                        "TalentHub helped me find my dream job in just 2 weeks! The AI matching was incredibly accurate."
                    </p>
                </div>
                
                <div class="testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold">AS</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Alice Smith</h4>
                            <p class="text-gray-600 text-sm">HR Manager</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">
                        "We've hired 5 amazing developers through TalentHub. The quality of candidates is outstanding!"
                    </p>
                </div>
                
                <div class="testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold">BJ</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Bob Johnson</h4>
                            <p class="text-gray-600 text-sm">Product Designer</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">
                        "The platform is intuitive and the matching algorithm really understands what I'm looking for."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg text-white section-padding">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Join thousands of professionals and companies who are already finding success on TalentHub.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                <a href="/systemAuth/register" class="btn-primary text-white font-semibold py-3 px-8 rounded-lg inline-block">
                    <i class="fas fa-user-plus mr-2"></i> Sign Up Now
                </a>
                <a href="#" class="glass-effect text-white font-semibold py-3 px-8 rounded-lg inline-block hover:bg-white hover:bg-opacity-20 transition">
                    <i class="fas fa-play-circle mr-2"></i> Watch Demo
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">TalentHub</h3>
                    <p class="text-gray-400">
                        Connecting talent with opportunity worldwide.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">For Candidates</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Browse Jobs</a></li>
                        <li><a href="#" class="hover:text-white transition">Career Advice</a></li>
                        <li><a href="#" class="hover:text-white transition">Resume Builder</a></li>
                        <li><a href="#" class="hover:text-white transition">Skill Tests</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">For Employers</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Post Jobs</a></li>
                        <li><a href="#" class="hover:text-white transition">Search Candidates</a></li>
                        <li><a href="#" class="hover:text-white transition">Pricing Plans</a></li>
                        <li><a href="#" class="hover:text-white transition">Recruitment Tools</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 TalentHub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
