<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - Pricing Plans</title>
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
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .pricing-card {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            border-color: #667eea;
        }
        
        .popular-badge {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            position: absolute;
            top: -12px;
            right: 20px;
        }
        
        .feature-check {
            color: #10b981;
            margin-right: 8px;
        }
        
        .feature-cross {
            color: #ef4444;
            margin-right: 8px;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
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
                    <a href="/Talent-HUB/" class="text-gray-700 hover:text-purple-600 font-medium transition">Home</a>
                    <a href="/Talent-HUB/find-talent" class="text-gray-700 hover:text-purple-600 font-medium transition">Find Talent</a>
                    <a href="/Talent-HUB/find-jobs" class="text-gray-700 hover:text-purple-600 font-medium transition">Find Jobs</a>
                    <a href="/Talent-HUB/how-it-works" class="text-gray-700 hover:text-purple-600 font-medium transition">How It Works</a>
                    <a href="/Talent-HUB/pricing" class="text-purple-600 font-medium border-b-2 border-purple-600 pb-1">Pricing</a>
                    <a href="/Talent-HUB/blog" class="text-gray-700 hover:text-purple-600 font-medium transition">Blog</a>
                </div>
                
                <div class="flex space-x-4">
                    <a href="/Talent-HUB/login" class="text-purple-600 border border-purple-600 px-4 py-2 rounded-lg hover:bg-purple-50 transition">Log In</a>
                    <a href="/Talent-HUB/register" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="gradient-bg py-20 px-4">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 text-shadow">
                Choose Your Perfect Plan
            </h1>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Flexible pricing options designed for individuals, teams, and enterprises. Start free and scale as you grow.
            </p>
            
            <!-- Billing Toggle -->
            <div class="flex justify-center items-center mb-12">
                <span class="text-white mr-3">Monthly</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="billingToggle" class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                </label>
                <span class="text-white ml-3">Annual <span class="text-yellow-300 font-bold">(Save 20%)</span></span>
            </div>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="py-16 px-4">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <!-- Starter Plan -->
                <div class="pricing-card bg-white rounded-2xl p-8 relative">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-rocket text-gray-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Starter</h3>
                        <p class="text-gray-600">Perfect for individuals getting started</p>
                    </div>
                    
                    <div class="text-center mb-8">
                        <div class="text-4xl font-bold text-gray-800">
                            <span class="monthly-price">$0</span>
                            <span class="annual-price hidden">$0</span>
                            <span class="text-lg text-gray-600">/month</span>
                        </div>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Basic profile creation</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Up to 5 job applications/month</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Basic search filters</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Email support</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-times feature-cross"></i>
                            <span>Advanced analytics</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-times feature-cross"></i>
                            <span>Priority support</span>
                        </li>
                    </ul>
                    
                    <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg transition duration-300">
                        Get Started Free
                    </button>
                </div>

                <!-- Professional Plan -->
                <div class="pricing-card bg-white rounded-2xl p-8 relative transform scale-105 shadow-2xl">
                    <div class="popular-badge">MOST POPULAR</div>
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-star text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Professional</h3>
                        <p class="text-gray-600">Ideal for growing professionals</p>
                    </div>
                    
                    <div class="text-center mb-8">
                        <div class="text-4xl font-bold text-gray-800">
                            <span class="monthly-price">$29</span>
                            <span class="annual-price hidden">$23</span>
                            <span class="text-lg text-gray-600">/month</span>
                        </div>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Advanced profile features</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Unlimited job applications</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Advanced search & filters</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Profile visibility boost</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Basic analytics dashboard</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Priority email support</span>
                        </li>
                    </ul>
                    
                    <button class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                        Start Free Trial
                    </button>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card bg-white rounded-2xl p-8 relative">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-building text-yellow-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Enterprise</h3>
                        <p class="text-gray-600">Complete solution for organizations</p>
                    </div>
                    
                    <div class="text-center mb-8">
                        <div class="text-4xl font-bold text-gray-800">
                            <span class="monthly-price">$99</span>
                            <span class="annual-price hidden">$79</span>
                            <span class="text-lg text-gray-600">/month</span>
                        </div>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Everything in Professional</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Team collaboration tools</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Custom branding options</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>Advanced analytics & reports</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>API access</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check feature-check"></i>
                            <span>24/7 phone & chat support</span>
                        </li>
                    </ul>
                    
                    <button class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                        Contact Sales
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Comparison -->
    <section class="py-16 px-4 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Compare Features</h2>
            
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-4 gap-4 p-6 bg-gray-50 font-semibold">
                    <div>Feature</div>
                    <div class="text-center">Starter</div>
                    <div class="text-center">Professional</div>
                    <div class="text-center">Enterprise</div>
                </div>
                
                <div class="grid grid-cols-4 gap-4 p-6 border-t">
                    <div>Job Postings</div>
                    <div class="text-center">0/month</div>
                    <div class="text-center">10/month</div>
                    <div class="text-center">Unlimited</div>
                </div>
                
                <div class="grid grid-cols-4 gap-4 p-6 border-t bg-gray-50">
                    <div>Talent Search</div>
                    <div class="text-center"><i class="fas fa-check text-green-500"></i></div>
                    <div class="text-center"><i class="fas fa-check text-green-500"></i></div>
                    <div class="text-center"><i class="fas fa-check text-green-500"></i></div>
                </div>
                
                <div class="grid grid-cols-4 gap-4 p-6 border-t">
                    <div>Resume Database Access</div>
                    <div class="text-center"><i class="fas fa-times text-red-500"></i></div>
                    <div class="text-center"><i class="fas fa-check text-green-500"></i></div>
                    <div class="text-center"><i class="fas fa-check text-green-500"></i></div>
                </div>
                
                <div class="grid grid-cols-4 gap-4 p-6 border-t bg-gray-50">
                    <div>Team Members</div>
                    <div class="text-center">1</div>
                    <div class="text-center">5</div>
                    <div class="text-center">Unlimited</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 px-4">
        <div class="container mx-auto max-w-3xl">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Frequently Asked Questions</h2>
            
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-800">Can I change my plan anytime?</h3>
                        <i class="fas fa-chevron-down text-gray-600 transition-transform"></i>
                    </button>
                    <div class="faq-content hidden mt-4 text-gray-600">
                        Yes, you can upgrade or downgrade your plan at any time. Changes take effect immediately, and we'll prorate any billing adjustments.
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-800">Is there a free trial?</h3>
                        <i class="fas fa-chevron-down text-gray-600 transition-transform"></i>
                    </button>
                    <div class="faq-content hidden mt-4 text-gray-600">
                        Yes! We offer a 14-day free trial for our Professional plan. No credit card required to start your trial.
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-800">What payment methods do you accept?</h3>
                        <i class="fas fa-chevron-down text-gray-600 transition-transform"></i>
                    </button>
                    <div class="faq-content hidden mt-4 text-gray-600">
                        We accept all major credit cards, PayPal, and bank transfers for enterprise accounts.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg py-16 px-4">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Join thousands of professionals and companies who trust TalentHub for their recruitment needs.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-white text-purple-700 hover:bg-gray-100 font-semibold py-3 px-8 rounded-lg transition duration-300">
                    Start Free Trial
                </button>
                <button class="glass-effect text-white hover:bg-white hover:bg-opacity-20 font-semibold py-3 px-8 rounded-lg transition duration-300">
                    Schedule Demo
                </button>
            </div>
        </div>
    </section>

    <script>
        // Billing toggle functionality
        const billingToggle = document.getElementById('billingToggle');
        const monthlyPrices = document.querySelectorAll('.monthly-price');
        const annualPrices = document.querySelectorAll('.annual-price');

        billingToggle.addEventListener('change', function() {
            if (this.checked) {
                monthlyPrices.forEach(el => el.classList.add('hidden'));
                annualPrices.forEach(el => el.classList.remove('hidden'));
            } else {
                monthlyPrices.forEach(el => el.classList.remove('hidden'));
                annualPrices.forEach(el => el.classList.add('hidden'));
            }
        });

        // FAQ toggle functionality
        function toggleFAQ(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
</body>
</html>
