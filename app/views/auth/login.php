<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - Authentication</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="/systemAuth/app/views/assets/main.js"></script>
    <!-- Font Awesome -->
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
            50% { transform: translateY(-10px); }
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
        
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
        
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
        
        .btn {
            position: relative;
            overflow: hidden;
        }
        
        /* Toggle between forms */
        .form-container {
            transition: transform 0.5s ease-in-out;
        }
        
        .hidden-form {
            transform: translateX(100%);
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        
        .active-form {
            transform: translateX(0);
            opacity: 1;
            position: relative;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="gradient-bg py-4 px-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
                <span class="text-white text-2xl font-bold">Talent<span class="text-yellow-300">Hub</span></span>
            </a>
            
            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-white hover:text-yellow-300 transition">Home</a>
                <a href="#" class="text-white hover:text-yellow-300 transition">Find Talent</a>
                <a href="#" class="text-white hover:text-yellow-300 transition">Find Jobs</a>
                <a href="#" class="text-white hover:text-yellow-300 transition">How It Works</a>
            </div>
            
            <!-- Auth Buttons (for logged out state) -->
            <div class="flex space-x-4">
                <a href="/systemAuth/login" class="bg-white text-purple-700 font-semibold py-2 px-6 rounded-lg transition duration-300 hover:bg-gray-100">
                    Sign In
                </a>
                <a href="/systemAuth/register" class="glass-effect text-white font-semibold py-2 px-6 rounded-lg transition duration-300 hover:bg-white hover:bg-opacity-20">
                    Sign Up
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    
    <!-- Main Authentication Container -->
    <div class="min-h-screen flex items-center justify-center px-4 py-12 gradient-bg">
        <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between">
            <!-- Left Side - Branding & Info -->
            <div class="lg:w-1/2 mb-12 lg:mb-0 text-center lg:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 text-shadow leading-tight">
                    Welcome to <span class="text-yellow-300">TalentHub</span>
                </h1>
                
                <p class="text-xl text-gray-100 mb-8 max-w-lg mx-auto lg:mx-0">
                    Join thousands of professionals and companies who are already finding success on our platform.
                </p>
                
                <!-- Features List -->
                <div class="space-y-6 mb-10">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-yellow-300 text-xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-white font-bold">Verified Profiles</h3>
                            <p class="text-gray-200">All users and companies are thoroughly verified</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-shield-alt text-yellow-300 text-xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-white font-bold">Secure & Private</h3>
                            <p class="text-gray-200">Your data is protected with enterprise-grade security</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-bolt text-yellow-300 text-xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-white font-bold">Quick Matching</h3>
                            <p class="text-gray-200">Find opportunities or talent in minutes</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial -->
                <div class="glass-effect p-6 rounded-xl max-w-md">
                    <p class="text-white italic mb-4">"TalentHub helped me find my dream job in just 2 weeks. The platform is intuitive and the matching is spot on!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-purple-700 font-bold mr-3">
                            SJ
                        </div>
                        <div>
                            <p class="text-white font-bold">Sarah Johnson</p>
                            <p class="text-gray-200 text-sm">UX Designer at TechCorp</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Forms Container -->
            <div class="lg:w-1/2 flex justify-center">
                <div class="w-full max-w-md relative overflow-hidden">
                    <?php
                    $error = $error ?? null;
                    $old_email = $old_email ?? '';
                    $success = $success ?? null;
                    $show_signup = $show_signup ?? false;
                    ?>
                    <!-- Login Form -->
                    <div id="loginForm" class="<?php echo $show_signup ? 'form-container hidden-form' : 'form-container active-form'; ?>">
                        <div class="bg-white rounded-2xl shadow-2xl p-8">
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
                                <p class="text-gray-600 mt-2">Sign in to your TalentHub account</p>
                            </div>
                            
                            <?php
                            $error = $error ?? null;
                            $old_email = $old_email ?? '';
                            $success = $success ?? null;
                            $show_signup = $show_signup ?? false;
                            ?>
                            <form id="loginFormElement" action="/systemAuth/login" method="post">
                                <!-- CSRF Token -->
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                                
                                <div class="space-y-6">
                                    <div>
                                        <label for="loginEmail" class="block text-gray-700 font-medium mb-2">Email Address</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-envelope text-gray-400"></i>
                                            </div>
                                            <input name="email" value="<?php echo htmlspecialchars($old_email); ?>" type="email" id="loginEmail" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="you@example.com" required>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label  for="loginPassword" class="block text-gray-700 font-medium mb-2">Password</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-lock text-gray-400"></i>
                                            </div>
                                            <input name="password" type="password" id="loginPassword" class="form-input w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="••••••••" required>
                                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="toggleLoginPassword">
                                                <i class="fas fa-eye text-gray-400"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="rememberMe" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <label for="rememberMe" class="ml-2 text-gray-700">Remember me</label>
                                        </div>
                                        <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Forgot password?</a>
                                    </div>
                                    
                                    <button type="submit" class="btn w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 pulse">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                                    </button>
                                </div>
                            </form>
                            
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <p class="text-center text-gray-600">Or sign in with</p>
                                <div class="flex justify-center space-x-4 mt-4">
                                    <button class="w-12 h-12 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-full flex items-center justify-center transition">
                                        <i class="fab fa-facebook-f text-lg"></i>
                                    </button>
                                    <button class="w-12 h-12 bg-red-100 hover:bg-red-200 text-red-600 rounded-full flex items-center justify-center transition">
                                        <i class="fab fa-google text-lg"></i>
                                    </button>
                                    <button class="w-12 h-12 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full flex items-center justify-center transition">
                                        <i class="fab fa-linkedin-in text-lg"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <?php if ($error): ?>
                                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?php echo htmlspecialchars($error); ?></div>
                                <?php endif; ?>
                                <?php if ($success): ?>
                                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?php echo htmlspecialchars($success); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mt-8 text-center">
                                <p class="text-gray-600">Don't have an account? 
                                    <button id="switchToSignup" class="text-purple-600 hover:text-purple-800 font-medium">Sign up here</button>
                                    <span> or </span>
                                    <a href="/systemAuth/register" class="text-purple-600 hover:text-purple-800 font-medium">Go to registration page</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Signup Form -->
                    <div id="signupForm" class="form-container <?php echo $show_signup ? 'active-form' : 'hidden-form'; ?>">
                        <div class="bg-white rounded-2xl shadow-2xl p-8">
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-800">Join TalentHub</h2>
                                <p class="text-gray-600 mt-2">Create your account in less than 2 minutes</p>
                            </div>
                            
                            <form id="signupFormElement" action="/systemAuth/register" method="post">
                                <!-- CSRF Token -->
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                                
                                <div class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="firstName" class="block text-gray-700 font-medium mb-2">First Name</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fas fa-user text-gray-400"></i>
                                                </div>
                                                <input name="first_name" type="text" id="firstName" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="John" required>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label for="lastName" class="block text-gray-700 font-medium mb-2">Last Name</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fas fa-user text-gray-400"></i>
                                                </div>
                                                <input name="last_name" type="text" id="lastName" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="Doe" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="signupEmail" class="block text-gray-700 font-medium mb-2">Email Address</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-envelope text-gray-400"></i>
                                            </div>
                                            <input name="email" type="email" id="signupEmail" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="you@example.com" required>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="userType" class="block text-gray-700 font-medium mb-2">I am a</label>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <input type="radio" id="jobSeeker" name="role" value="candidate" class="hidden peer" checked>
                                                <label for="jobSeeker" class="flex items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer peer-checked:border-purple-500 peer-checked:bg-purple-50 transition">
                                                    <i class="fas fa-user-tie text-gray-600 mr-2"></i>
                                                    <span>Job Seeker</span>
                                                </label>
                                            </div>
                                            <div>
                                                <input type="radio" id="employer" name="role" value="recruiter" class="hidden peer">
                                                <label for="employer" class="flex items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer peer-checked:border-purple-500 peer-checked:bg-purple-50 transition">
                                                    <i class="fas fa-building text-gray-600 mr-2"></i>
                                                    <span>Employer</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="signupPassword" class="block text-gray-700 font-medium mb-2">Password</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-lock text-gray-400"></i>
                                            </div>
                                                <input name="password" type="password" id="signupPassword" class="form-input w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="••••••••" required>
                                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="toggleSignupPassword">
                                                <i class="fas fa-eye text-gray-400"></i>
                                            </button>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-2">Must be at least 8 characters with a number and uppercase letter</p>
                                    </div>
                                    
                                    <div>
                                        <label for="confirmPassword" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-lock text-gray-400"></i>
                                            </div>
                                            <input name="confirm_password" type="password" id="confirmPassword" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="••••••••" required>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start">
                                        <input type="checkbox" id="terms" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded mt-1" required>
                                        <label for="terms" class="ml-2 text-gray-700">
                                            I agree to the 
                                            <a href="#" class="text-purple-600 hover:text-purple-800">Terms of Service</a> 
                                            and 
                                            <a href="#" class="text-purple-600 hover:text-purple-800">Privacy Policy</a>
                                        </label>
                                    </div>
                                    
                                    <button type="submit" class="btn w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 pulse">
                                        <i class="fas fa-user-plus mr-2"></i> Create Account
                                    </button>
                                </div>
                            </form>
                            
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <p class="text-center text-gray-600">Or sign up with</p>
                                <div class="flex justify-center space-x-4 mt-4">
                                    <button class="w-12 h-12 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-full flex items-center justify-center transition">
                                        <i class="fab fa-facebook-f text-lg"></i>
                                    </button>
                                    <button class="w-12 h-12 bg-red-100 hover:bg-red-200 text-red-600 rounded-full flex items-center justify-center transition">
                                        <i class="fab fa-google text-lg"></i>
                                    </button>
                                    <button class="w-12 h-12 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full flex items-center justify-center transition">
                                        <i class="fab fa-linkedin-in text-lg"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mt-8 text-center">
                                <p class="text-gray-600">Already have an account? 
                                    <button id="switchToLogin" class="text-purple-600 hover:text-purple-800 font-medium">Sign in here</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Success Message (hidden by default) -->
                    <div id="successMessage" class="hidden">
                        <div class="bg-white rounded-2xl shadow-2xl p-8 text-center">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-check text-green-600 text-3xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-4">Account Created!</h2>
                            <p class="text-gray-600 mb-8">Your TalentHub account has been successfully created. Please check your email to verify your account.</p>
                            <button id="backToLogin" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                                Go to Login
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
