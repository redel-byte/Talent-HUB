<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - Employer Registration</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="/Talent-HUB/app/views/assets/main.js"></script>
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        
        .btn {
            position: relative;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-green-600">TalentHub</h1>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="/Talent-HUB/" class="text-gray-700 hover:text-green-600 font-medium transition">Home</a>
                    <a href="/Talent-HUB/find-talent" class="text-gray-700 hover:text-green-600 font-medium transition">Find Talent</a>
                    <a href="/Talent-HUB/how-it-works" class="text-gray-700 hover:text-green-600 font-medium transition">How It Works</a>
                    <a href="/Talent-HUB/pricing" class="text-gray-700 hover:text-green-600 font-medium transition">Pricing</a>
                </div>
                
                <div class="flex space-x-4">
                    <a href="/Talent-HUB/login" class="text-green-600 border border-green-600 px-4 py-2 rounded-lg hover:bg-green-50 transition">Log In</a>
                    <a href="/Talent-HUB/register/candidate" class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">Register as Candidate</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Registration Container -->
    <div class="min-h-screen flex items-center justify-center px-4 py-12 gradient-bg">
        <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between">
            <!-- Left Side - Recruiter Focused Branding -->
            <div class="lg:w-1/2 mb-12 lg:mb-0 text-center lg:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 text-shadow leading-tight">
                    Find Top <span class="text-yellow-300">Talent</span>
                </h1>
                
                <p class="text-xl text-gray-100 mb-8 max-w-lg mx-auto lg:mx-0">
                    Connect with thousands of qualified candidates and build your dream team with TalentHub.
                </p>
                
                <!-- Recruiter Features List -->
                <div class="space-y-6 mb-10">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-yellow-300 text-xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-white font-bold">Access to Talent Pool</h3>
                            <p class="text-gray-200">Thousands of pre-screened candidates</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-filter text-yellow-300 text-xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-white font-bold">Smart Filtering</h3>
                            <p class="text-gray-200">Find candidates that match your exact requirements</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-yellow-300 text-xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-white font-bold">Hiring Analytics</h3>
                            <p class="text-gray-200">Track your recruitment pipeline and optimize hiring</p>
                        </div>
                    </div>
                </div>
                
                <!-- Recruiter Testimonial -->
                <div class="glass-effect p-6 rounded-xl max-w-md">
                    <p class="text-white italic mb-4">"TalentHub transformed our hiring process. We found our perfect team member in just 3 days!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-green-700 font-bold mr-3">
                            SA
                        </div>
                        <div>
                            <p class="text-white font-bold">Sarah Ahmed</p>
                            <p class="text-gray-200 text-sm">HR Manager at InnovateTech</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Registration Form -->
            <div class="lg:w-1/2 flex justify-center">
                <div class="w-full max-w-md">
                    <div class="bg-white rounded-2xl shadow-2xl p-8">
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-building text-green-600 text-3xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800">Join as Employer</h2>
                            <p class="text-gray-600 mt-2">Start finding amazing talent today</p>
                        </div>
                        
                        <form id="recruiterRegistrationForm" action="/Talent-HUB/register/recruiter" method="post">
                            <!-- CSRF Token -->
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                            <input type="hidden" name="role" value="recruiter">
                            
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="firstName" class="block text-gray-700 font-medium mb-2">First Name</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                            <input name="first_name" type="text" id="firstName" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 transition" placeholder="John" required>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="lastName" class="block text-gray-700 font-medium mb-2">Last Name</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                            <input name="last_name" type="text" id="lastName" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 transition" placeholder="Doe" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="signupEmail" class="block text-gray-700 font-medium mb-2">Work Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                        </div>
                                        <input name="email" type="email" id="signupEmail" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 transition" placeholder="john@company.com" required>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="phoneNumber" class="block text-gray-700 font-medium mb-2">Business Phone</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-phone text-gray-400"></i>
                                        </div>
                                        <input name="phoneNumber" type="tel" id="phoneNumber" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 transition" placeholder="+212645884913" required>
                                    </div>
                                </div>

                                <div>
                                    <label for="companyName" class="block text-gray-700 font-medium mb-2">Company Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-building text-gray-400"></i>
                                        </div>
                                        <input name="company_name" type="text" id="companyName" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 transition" placeholder="TechCorp Inc." required>
                                    </div>
                                </div>

                                <div>
                                    <label for="signupPassword" class="block text-gray-700 font-medium mb-2">Password</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                        <input name="password" type="password" id="signupPassword" class="form-input w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 transition" placeholder="••••••••" required>
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
                                        <input name="confirm_password" type="password" id="confirmPassword" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 transition" placeholder="••••••••" required>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <input type="checkbox" id="terms" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded mt-1" required>
                                    <label for="terms" class="ml-2 text-gray-700">
                                        I agree to the 
                                        <a href="#" class="text-green-600 hover:text-green-800">Terms of Service</a> 
                                        and 
                                        <a href="#" class="text-green-600 hover:text-green-800">Privacy Policy</a>
                                    </label>
                                </div>
                                
                                <div class="mt-4">
                                    <?php if ($error): ?>
                                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?php echo htmlspecialchars($error); ?></div>
                                    <?php endif; ?>
                                    <?php if ($success): ?>
                                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?php echo htmlspecialchars($success); ?></div>
                                    <?php endif; ?>
                                    <button type="submit" class="btn w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 pulse">
                                        <i class="fas fa-building mr-2"></i> Create Employer Account
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="mt-8 text-center">
                            <p class="text-gray-600">Already have an account? 
                                <a href="/Talent-HUB/login" class="text-green-600 hover:text-green-800 font-medium">Sign in here</a>
                            </p>
                            <p class="text-gray-600 mt-2">Looking for opportunities? 
                                <a href="/Talent-HUB/register/candidate" class="text-blue-600 hover:text-blue-800 font-medium">Register as Candidate</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password visibility toggle
        document.getElementById('toggleSignupPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('signupPassword');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Form validation
        document.getElementById('recruiterRegistrationForm').addEventListener('submit', function(e) {
            const password = document.getElementById('signupPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
            
            if (password.length < 8 || !/[A-Z]/.test(password) || !/\d/.test(password)) {
                e.preventDefault();
                alert('Password must be at least 8 characters with at least one uppercase letter and one number!');
                return false;
            }
        });
    </script>
</body>
</html>
