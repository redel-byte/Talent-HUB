<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - Find Your Dream Talent</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
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
    <!-- Hero Section -->
    <section class="gradient-bg min-h-screen flex items-center justify-center px-4 py-16">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <!-- Left Content -->
                <div class="lg:w-1/2 mb-12 lg:mb-0 text-center lg:text-left">
                    <!-- Logo -->
                    <div class="flex items-center justify-center lg:justify-start mb-6">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-purple-600 text-xl"></i>
                            </div>
                            <span class="text-white text-2xl font-bold">Talent<span class="text-yellow-300">Hub</span></span>
                        </div>
                    </div>
                    
                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 text-shadow leading-tight">
                        Find Your Dream <span class="text-yellow-300">Talent</span> or <span class="text-yellow-300">Opportunity</span>
                    </h1>
                    
                    <!-- Subheading -->
                    <p class="text-lg md:text-xl text-gray-100 mb-10 max-w-lg mx-auto lg:mx-0">
                        Connect with top professionals or discover exciting career opportunities. TalentHub is the premier platform for talent acquisition and career growth.
                    </p>
                    
                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center lg:justify-start gap-6 mb-10">
                        <div class="glass-effect px-5 py-3 text-center">
                            <p class="text-2xl font-bold text-white">50K+</p>
                            <p class="text-gray-200 text-sm">Talents Hired</p>
                        </div>
                        <div class="glass-effect px-5 py-3 text-center">
                            <p class="text-2xl font-bold text-white">10K+</p>
                            <p class="text-gray-200 text-sm">Companies</p>
                        </div>
                        <div class="glass-effect px-5 py-3 text-center">
                            <p class="text-2xl font-bold text-white">95%</p>
                            <p class="text-gray-200 text-sm">Success Rate</p>
                        </div>
                    </div>
                    
                    <!-- Call to Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <button class="bg-white text-purple-700 hover:bg-gray-100 font-semibold py-3 px-8 rounded-lg transition duration-300 transform hover:-translate-y-1 flex items-center justify-center space-x-2 pulse">
                            <i class="fas fa-user-plus"></i>
                            <span>Sign Up Free</span>
                        </button>
                        
                        <button class="glass-effect text-white hover:bg-white hover:bg-opacity-20 font-semibold py-3 px-8 rounded-lg transition duration-300 transform hover:-translate-y-1 flex items-center justify-center space-x-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Sign In</span>
                        </button>
                    </div>
                    
                    <!-- Additional Info -->
                    <p class="text-gray-200 text-sm mt-8">
                        <i class="fas fa-check-circle text-yellow-300 mr-2"></i>
                        No credit card required • 14-day free trial • Cancel anytime
                    </p>
                </div>
                
                <!-- Right Content (Visual) -->
                <div class="lg:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-lg">
                        <!-- Main Illustration -->
                        <div class="relative z-10">
                            <div class="bg-white rounded-2xl shadow-2xl p-6 floating">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-search text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">Find Talent</h3>
                                            <p class="text-sm text-gray-600">Search and filter candidates</p>
                                        </div>
                                    </div>
                                    <div class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">
                                        Active
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-bold mr-3">
                                                JD
                                            </div>
                                            <div>
                                                <p class="font-medium">John Doe</p>
                                                <p class="text-xs text-gray-500">Frontend Developer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-purple-600">4.9/5</p>
                                            <p class="text-xs text-gray-500">Rating</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm font-bold mr-3">
                                                SJ
                                            </div>
                                            <div>
                                                <p class="font-medium">Sarah Johnson</p>
                                                <p class="text-xs text-gray-500">UX Designer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-purple-600">4.8/5</p>
                                            <p class="text-xs text-gray-500">Rating</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white text-sm font-bold mr-3">
                                                MR
                                            </div>
                                            <div>
                                                <p class="font-medium">Michael Roberts</p>
                                                <p class="text-xs text-gray-500">Full Stack Dev</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-purple-600">5.0/5</p>
                                            <p class="text-xs text-gray-500">Rating</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <button class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 rounded-lg transition duration-300">
                                        View All Candidates
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating elements -->
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-300 rounded-full opacity-20 floating" style="animation-delay: 0.5s;"></div>
                        <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-blue-300 rounded-full opacity-20 floating" style="animation-delay: 1s;"></div>
                    </div>
                </div>
            </div>
            
            <!-- Scroll indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-center">
                <p class="text-white text-sm mb-2">Discover More</p>
                <i class="fas fa-chevron-down text-white text-xl animate-bounce"></i>
            </div>
        </div>
    </section>
    
    <!-- Features Section (Additional content) -->
    <section class="py-16 px-4 bg-white">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Why Choose TalentHub?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-2xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bolt text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Matching</h3>
                    <p class="text-gray-600">Our AI-powered algorithm matches talent with opportunities in minutes, not days.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-2xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Verified Profiles</h3>
                    <p class="text-gray-600">Every talent and company is thoroughly vetted to ensure quality and reliability.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-2xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Growth Focused</h3>
                    <p class="text-gray-600">Tools and resources to help talents grow and companies build successful teams.</p>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="bg-gray-800 text-white py-8 px-4 text-center">
        <p class="mb-2">© 2023 TalentHub. All rights reserved.</p>
        <p class="text-gray-400">Connecting talent with opportunity since 2020.</p>
    </footer>

    <script>
        // Simple interactive button effects
        document.addEventListener('DOMContentLoaded', function() {
            const signUpBtn = document.querySelector('.bg-white');
            const signInBtn = document.querySelector('.glass-effect');
            
            // Add click effects to buttons
            [signUpBtn, signInBtn].forEach(button => {
                button.addEventListener('click', function() {
                    // Add a ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = event.clientX - rect.left - size/2;
                    const y = event.clientY - rect.top - size/2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    // Remove any existing ripple
                    const existingRipple = this.querySelector('.ripple');
                    if (existingRipple) {
                        existingRipple.remove();
                    }
                    
                    this.appendChild(ripple);
                    
                    // Remove ripple after animation
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                    
                    // Show alert for demo purposes
                    const btnText = this.textContent.trim();
                    if (btnText.includes('Sign Up')) {
                        alert('Sign Up form would open here. Welcome to TalentHub!');
                    } else {
                        alert('Sign In form would open here. Welcome back to TalentHub!');
                    }
                });
            });
            
            // Add ripple effect CSS
            const style = document.createElement('style');
            style.textContent = `
                .ripple {
                    position: absolute;
                    border-radius: 50%;
                    background-color: rgba(255, 255, 255, 0.7);
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                }
                
                @keyframes ripple-animation {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
                
                button {
                    position: relative;
                    overflow: hidden;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>
