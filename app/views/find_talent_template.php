<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - Find Talent</title>
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
        
        .candidate-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        
        .skill-tag {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .filter-section {
            background: #f9fafb;
            border-radius: 12px;
            padding: 24px;
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
        
        .availability-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
        
        .available { background-color: #10b981; }
        .busy { background-color: #f59e0b; }
        .unavailable { background-color: #ef4444; }
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
                    <a href="find-talent" class="text-purple-600 font-medium border-b-2 border-purple-600 pb-1">Find Talent</a>
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
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6 text-shadow leading-tight">
                    Find the Perfect <span class="text-yellow-300">Talent</span> for Your Team
                </h1>
                <p class="text-xl mb-8 text-gray-100 max-w-3xl mx-auto">
                    Search through our database of 100,000+ verified professionals and find the perfect match for your company.
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-2">
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="flex-1 relative">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Search by skills, job title, or keywords..." class="w-full pl-12 pr-4 py-3 text-gray-700 focus:outline-none">
                        </div>
                        <div class="flex-1 relative">
                            <i class="fas fa-map-marker-alt absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Location (optional)" class="w-full pl-12 pr-4 py-3 text-gray-700 focus:outline-none">
                        </div>
                        <button class="btn-primary text-white font-semibold px-8 py-3 rounded-lg">
                            Search Candidates
                        </button>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-300">100K+</div>
                        <p class="text-gray-200">Active Candidates</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-300">500+</div>
                        <p class="text-gray-200">Job Categories</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-300">95%</div>
                        <p class="text-gray-200">Verified Profiles</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-300">24h</div>
                        <p class="text-gray-200">Avg. Response Time</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section-padding">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filters Sidebar -->
                <div class="lg:w-1/4">
                    <div class="filter-section">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Filters</h3>
                        
                        <!-- Job Type -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-3">Job Type</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Full-time</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Part-time</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Contract</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Freelance</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Experience Level -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-3">Experience Level</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Entry Level (0-2 years)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Mid Level (2-5 years)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Senior Level (5+ years)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Executive Level</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Skills -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-3">Top Skills</h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="skill-tag">JavaScript</span>
                                <span class="skill-tag">Python</span>
                                <span class="skill-tag">React</span>
                                <span class="skill-tag">Node.js</span>
                                <span class="skill-tag">Java</span>
                                <span class="skill-tag">PHP</span>
                                <span class="skill-tag">Design</span>
                                <span class="skill-tag">Marketing</span>
                            </div>
                        </div>
                        
                        <!-- Availability -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-3">Availability</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="availability-indicator available mr-2"></span>
                                    <span class="text-gray-600">Available Now</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="availability-indicator busy mr-2"></span>
                                    <span class="text-gray-600">Available Soon</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="availability-indicator unavailable mr-2"></span>
                                    <span class="text-gray-600">Not Available</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Candidates Grid -->
                <div class="lg:w-3/4">
                    <!-- Results Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Found 2,847 Candidates</h2>
                            <p class="text-gray-600">Matching your criteria</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-purple-500">
                                <option>Most Relevant</option>
                                <option>Most Recent</option>
                                <option>Experience (High to Low)</option>
                                <option>Experience (Low to High)</option>
                                <option>Rate (Low to High)</option>
                                <option>Rate (High to Low)</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Candidate Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Candidate 1 -->
                        <div class="candidate-card bg-white rounded-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white text-xl font-bold">JD</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">John Doe</h3>
                                        <p class="text-gray-600">Senior Full Stack Developer</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                            <span class="text-gray-600 text-sm">San Francisco, CA</span>
                                            <span class="availability-indicator available ml-3"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-semibold text-purple-600">$120/hr</div>
                                    <div class="text-sm text-gray-500">5 years exp</div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">
                                Experienced full-stack developer specializing in React, Node.js, and cloud technologies. Passionate about building scalable applications...
                            </p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="skill-tag">JavaScript</span>
                                <span class="skill-tag">React</span>
                                <span class="skill-tag">Node.js</span>
                                <span class="skill-tag">AWS</span>
                                <span class="skill-tag">MongoDB</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>4.8 (127 reviews)</span>
                                </div>
                                <div class="space-x-2">
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">View Profile</button>
                                    <button class="btn-primary text-white px-4 py-2 rounded text-sm">Contact</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Candidate 2 -->
                        <div class="candidate-card bg-white rounded-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white text-xl font-bold">AS</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Alice Smith</h3>
                                        <p class="text-gray-600">UX/UI Designer</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                            <span class="text-gray-600 text-sm">New York, NY</span>
                                            <span class="availability-indicator available ml-3"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-semibold text-purple-600">$85/hr</div>
                                    <div class="text-sm text-gray-500">3 years exp</div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">
                                Creative UX/UI designer with a passion for user-centered design. Expert in Figma, Adobe Creative Suite, and prototyping...
                            </p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="skill-tag">Figma</span>
                                <span class="skill-tag">Adobe XD</span>
                                <span class="skill-tag">Sketch</span>
                                <span class="skill-tag">Prototyping</span>
                                <span class="skill-tag">User Research</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>4.9 (89 reviews)</span>
                                </div>
                                <div class="space-x-2">
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">View Profile</button>
                                    <button class="btn-primary text-white px-4 py-2 rounded text-sm">Contact</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Candidate 3 -->
                        <div class="candidate-card bg-white rounded-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white text-xl font-bold">BJ</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Bob Johnson</h3>
                                        <p class="text-gray-600">Data Scientist</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                            <span class="text-gray-600 text-sm">Remote</span>
                                            <span class="availability-indicator busy ml-3"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-semibold text-purple-600">$150/hr</div>
                                    <div class="text-sm text-gray-500">7 years exp</div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">
                                Data scientist with expertise in machine learning, statistical analysis, and data visualization. PhD in Computer Science...
                            </p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="skill-tag">Python</span>
                                <span class="skill-tag">Machine Learning</span>
                                <span class="skill-tag">TensorFlow</span>
                                <span class="skill-tag">R</span>
                                <span class="skill-tag">SQL</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>4.7 (156 reviews)</span>
                                </div>
                                <div class="space-x-2">
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">View Profile</button>
                                    <button class="btn-primary text-white px-4 py-2 rounded text-sm">Contact</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Candidate 4 -->
                        <div class="candidate-card bg-white rounded-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white text-xl font-bold">EW</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Emma Wilson</h3>
                                        <p class="text-gray-600">Project Manager</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                            <span class="text-gray-600 text-sm">London, UK</span>
                                            <span class="availability-indicator available ml-3"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-semibold text-purple-600">$95/hr</div>
                                    <div class="text-sm text-gray-500">6 years exp</div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">
                                Certified PMP with experience managing cross-functional teams and delivering complex projects on time and budget...
                            </p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="skill-tag">Agile</span>
                                <span class="skill-tag">Scrum</span>
                                <span class="skill-tag">JIRA</span>
                                <span class="skill-tag">Risk Management</span>
                                <span class="skill-tag">Stakeholder Management</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>4.9 (203 reviews)</span>
                                </div>
                                <div class="space-x-2">
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">View Profile</button>
                                    <button class="btn-primary text-white px-4 py-2 rounded text-sm">Contact</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center">
                        <nav class="flex space-x-2">
                            <button class="px-4 py-2 text-gray-500 hover:text-gray-700">Previous</button>
                            <button class="px-4 py-2 bg-purple-600 text-white rounded">1</button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">2</button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">3</button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">4</button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">5</button>
                            <button class="px-4 py-2 text-gray-500 hover:text-gray-700">Next</button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg text-white section-padding">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-4">Can't Find the Right Talent?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Post your job and let qualified candidates come to you. Get access to our premium talent pool.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                <a href="#" class="btn-primary text-white font-semibold py-3 px-8 rounded-lg inline-block">
                    <i class="fas fa-briefcase mr-2"></i> Post a Job
                </a>
                <a href="#" class="glass-effect text-white font-semibold py-3 px-8 rounded-lg inline-block hover:bg-white hover:bg-opacity-20 transition">
                    <i class="fas fa-headset mr-2"></i> Contact Support
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
