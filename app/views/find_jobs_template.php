<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - Find Jobs</title>
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
        
        .job-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-color: #667eea;
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
        
        .job-type-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .full-time { background-color: #dcfce7; color: #166534; }
        .part-time { background-color: #fef3c7; color: #92400e; }
        .contract { background-color: #e0e7ff; color: #3730a3; }
        .remote { background-color: #f3e8ff; color: #6b21a8; }
        
        .company-logo {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
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
                    <a href="find-jobs" class="text-purple-600 font-medium border-b-2 border-purple-600 pb-1">Find Jobs</a>
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
                    Find Your Dream <span class="text-yellow-300">Job</span>
                </h1>
                <p class="text-xl mb-8 text-gray-100 max-w-3xl mx-auto">
                    Discover 50,000+ job opportunities from top companies worldwide. Your next career move starts here.
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-2">
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="flex-1 relative">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Job title, keywords, or company..." class="w-full pl-12 pr-4 py-3 text-gray-700 focus:outline-none">
                        </div>
                        <div class="flex-1 relative">
                            <i class="fas fa-map-marker-alt absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Location or 'Remote'" class="w-full pl-12 pr-4 py-3 text-gray-700 focus:outline-none">
                        </div>
                        <button class="btn-primary text-white font-semibold px-8 py-3 rounded-lg">
                            Search Jobs
                        </button>
                    </div>
                </div>
                
                <!-- Popular Searches -->
                <div class="mt-6">
                    <p class="text-gray-200 mb-3">Popular searches:</p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="glass-effect px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-white hover:bg-opacity-20 transition">Software Developer</span>
                        <span class="glass-effect px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-white hover:bg-opacity-20 transition">Data Scientist</span>
                        <span class="glass-effect px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-white hover:bg-opacity-20 transition">UX Designer</span>
                        <span class="glass-effect px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-white hover:bg-opacity-20 transition">Product Manager</span>
                        <span class="glass-effect px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-white hover:bg-opacity-20 transition">Remote Jobs</span>
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
                                    <span class="text-gray-600">Internship</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Remote</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Experience Level -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-3">Experience Level</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Entry Level</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Mid Level</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Senior Level</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Executive</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Salary Range -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-3">Salary Range</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">$0 - $50k</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">$50k - $100k</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">$100k - $150k</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">$150k+</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Industry -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-3">Industry</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Technology</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Healthcare</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Finance</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Education</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-purple-600">
                                    <span class="text-gray-600">Marketing</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Date Posted -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-3">Date Posted</h4>
                            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-purple-500">
                                <option>Any time</option>
                                <option>Last 24 hours</option>
                                <option>Last 3 days</option>
                                <option>Last week</option>
                                <option>Last month</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Jobs Grid -->
                <div class="lg:w-3/4">
                    <!-- Results Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Found 3,421 Jobs</h2>
                            <p class="text-gray-600">Based on your search criteria</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-purple-500">
                                <option>Most Relevant</option>
                                <option>Most Recent</option>
                                <option>Salary (High to Low)</option>
                                <option>Salary (Low to High)</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Job Cards -->
                    <div class="space-y-6">
                        <!-- Job 1 -->
                        <div class="job-card bg-white rounded-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="company-logo bg-purple-600 mr-4">
                                        <span class="text-xl">TC</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Senior Full Stack Developer</h3>
                                        <p class="text-gray-600">TechCorp Inc.</p>
                                        <div class="flex items-center mt-2 space-x-4">
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span class="text-sm">San Francisco, CA</span>
                                            </div>
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-clock mr-2"></i>
                                                <span class="text-sm">2 days ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xl font-semibold text-purple-600">$120k - $180k</div>
                                    <div class="flex space-x-2 mt-2">
                                        <span class="job-type-badge full-time">Full-time</span>
                                        <span class="job-type-badge remote">Remote</span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">
                                We're looking for an experienced Full Stack Developer to join our growing team. You'll work on cutting-edge projects using React, Node.js, and cloud technologies...
                            </p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">JavaScript</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">React</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Node.js</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">AWS</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">MongoDB</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>50-200 employees</span>
                                </div>
                                <div class="space-x-2">
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">View Details</button>
                                    <button class="btn-primary text-white px-4 py-2 rounded text-sm">Apply Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job 2 -->
                        <div class="job-card bg-white rounded-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="company-logo bg-green-600 mr-4">
                                        <span class="text-xl">DA</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">UX/UI Designer</h3>
                                        <p class="text-gray-600">Digital Agency</p>
                                        <div class="flex items-center mt-2 space-x-4">
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span class="text-sm">New York, NY</span>
                                            </div>
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-clock mr-2"></i>
                                                <span class="text-sm">1 day ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xl font-semibold text-purple-600">$80k - $120k</div>
                                    <div class="flex space-x-2 mt-2">
                                        <span class="job-type-badge full-time">Full-time</span>
                                        <span class="job-type-badge contract">Contract</span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">
                                Creative UX/UI Designer needed for exciting projects with top brands. Must have strong portfolio and experience with modern design tools...
                            </p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Figma</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Adobe XD</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Sketch</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Prototyping</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>20-50 employees</span>
                                </div>
                                <div class="space-x-2">
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">View Details</button>
                                    <button class="btn-primary text-white px-4 py-2 rounded text-sm">Apply Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job 3 -->
                        <div class="job-card bg-white rounded-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="company-logo bg-blue-600 mr-4">
                                        <span class="text-xl">SX</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Data Scientist</h3>
                                        <p class="text-gray-600">StartupXYZ</p>
                                        <div class="flex items-center mt-2 space-x-4">
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span class="text-sm">Remote</span>
                                            </div>
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-clock mr-2"></i>
                                                <span class="text-sm">3 hours ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xl font-semibold text-purple-600">$130k - $160k</div>
                                    <div class="flex space-x-2 mt-2">
                                        <span class="job-type-badge full-time">Full-time</span>
                                        <span class="job-type-badge remote">Remote</span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">
                                Join our data science team to work on cutting-edge ML projects. Experience with Python, TensorFlow, and statistical analysis required...
                            </p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Python</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Machine Learning</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">TensorFlow</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">R</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">SQL</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>10-25 employees</span>
                                </div>
                                <div class="space-x-2">
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">View Details</button>
                                    <button class="btn-primary text-white px-4 py-2 rounded text-sm">Apply Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job 4 -->
                        <div class="job-card bg-white rounded-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="company-logo bg-purple-600 mr-4">
                                        <span class="text-xl">FM</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Product Manager</h3>
                                        <p class="text-gray-600">FinTech Company</p>
                                        <div class="flex items-center mt-2 space-x-4">
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span class="text-sm">London, UK</span>
                                            </div>
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-clock mr-2"></i>
                                                <span class="text-sm">5 days ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xl font-semibold text-purple-600">$100k - $140k</div>
                                    <div class="flex space-x-2 mt-2">
                                        <span class="job-type-badge full-time">Full-time</span>
                                        <span class="job-type-badge part-time">Part-time</span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">
                                Experienced Product Manager needed to lead our mobile app development. Strong background in agile methodologies and user research...
                            </p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Product Strategy</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Agile</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Scrum</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">User Research</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>100-500 employees</span>
                                </div>
                                <div class="space-x-2">
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">View Details</button>
                                    <button class="btn-primary text-white px-4 py-2 rounded text-sm">Apply Now</button>
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
            <h2 class="text-4xl font-bold mb-4">Get Job Alerts</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Stay updated with the latest job opportunities matching your skills and preferences.
            </p>
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-lg p-2 flex">
                    <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 text-gray-700 focus:outline-none">
                    <button class="btn-primary text-white font-semibold px-6 py-3 rounded">
                        Subscribe
                    </button>
                </div>
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
