<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub - Blog & Insights</title>
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
        
        .blog-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        
        .category-tag {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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
                    <a href="/Talent-HUB/pricing" class="text-gray-700 hover:text-purple-600 font-medium transition">Pricing</a>
                    <a href="/Talent-HUB/blog" class="text-purple-600 font-medium border-b-2 border-purple-600 pb-1">Blog</a>
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
                TalentHub Blog
            </h1>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Insights, tips, and trends in recruitment, career development, and the future of work.
            </p>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text" placeholder="Search articles..." class="w-full py-4 px-6 pr-12 rounded-full text-gray-800 bg-white shadow-lg focus:outline-none focus:ring-4 focus:ring-purple-300">
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-purple-600 text-white p-3 rounded-full hover:bg-purple-700 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Filter -->
    <section class="py-8 px-4 bg-white border-b">
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-center gap-3">
                <button class="category-tag bg-purple-600 text-white">All Posts</button>
                <button class="category-tag bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition">Career Tips</button>
                <button class="category-tag bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition">Recruitment</button>
                <button class="category-tag bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition">Remote Work</button>
                <button class="category-tag bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition">Tech Trends</button>
                <button class="category-tag bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition">Interview Tips</button>
                <button class="category-tag bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition">Company Culture</button>
            </div>
        </div>
    </section>

    <!-- Featured Post -->
    <section class="py-16 px-4">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Featured Article</h2>
            
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Featured post" class="w-full h-64 md:h-96 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="category-tag">Career Tips</span>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="author-avatar mr-3">
                        <div>
                            <p class="font-semibold text-gray-800">Sarah Johnson</p>
                            <p class="text-sm text-gray-600">Career Coach • 5 min read</p>
                        </div>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">The Future of Remote Work: Trends Shaping 2024</h1>
                    <p class="text-gray-600 mb-6 text-lg">
                        As we navigate through 2024, remote work continues to evolve. Discover the key trends that are reshaping how we work, collaborate, and build successful distributed teams.
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">March 15, 2024</span>
                        <button class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                            Read Full Article
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-16 px-4 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Latest Articles</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Article 1 -->
                <article class="blog-card bg-white rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="category-tag">Interview Tips</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">10 Common Interview Mistakes to Avoid</h3>
                        <p class="text-gray-600 mb-4">
                            Learn the most common pitfalls that candidates make during interviews and how to avoid them to land your dream job.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="author-avatar mr-2">
                                <span class="text-sm text-gray-600">Mike Chen</span>
                            </div>
                            <span class="text-sm text-gray-500">3 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Article 2 -->
                <article class="blog-card bg-white rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="category-tag">Recruitment</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Building a Diverse and Inclusive Workplace</h3>
                        <p class="text-gray-600 mb-4">
                            Strategies for creating an inclusive recruitment process that attracts diverse talent and fosters belonging.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b332c1ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="author-avatar mr-2">
                                <span class="text-sm text-gray-600">Emily Davis</span>
                            </div>
                            <span class="text-sm text-gray-500">7 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Article 3 -->
                <article class="blog-card bg-white rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="category-tag">Tech Trends</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">AI in Recruitment: Friend or Foe?</h3>
                        <p class="text-gray-600 mb-4">
                            Exploring how artificial intelligence is transforming the recruitment landscape and what it means for job seekers.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://images.unsplash.com/photo-1507591064344-4c6ce005b128?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="author-avatar mr-2">
                                <span class="text-sm text-gray-600">Alex Kumar</span>
                            </div>
                            <span class="text-sm text-gray-500">5 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Article 4 -->
                <article class="blog-card bg-white rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1559028006-44a36f1a5b0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="category-tag">Remote Work</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Productivity Tips for Remote Teams</h3>
                        <p class="text-gray-600 mb-4">
                            Proven strategies to maintain high productivity and team cohesion while working remotely.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="author-avatar mr-2">
                                <span class="text-sm text-gray-600">Lisa Park</span>
                            </div>
                            <span class="text-sm text-gray-500">4 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Article 5 -->
                <article class="blog-card bg-white rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="category-tag">Company Culture</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Creating a Culture of Continuous Learning</h3>
                        <p class="text-gray-600 mb-4">
                            How organizations can foster an environment where employees are encouraged to grow and develop new skills.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="author-avatar mr-2">
                                <span class="text-sm text-gray-600">Tom Wilson</span>
                            </div>
                            <span class="text-sm text-gray-500">6 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Article 6 -->
                <article class="blog-card bg-white rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1603732554016-7c717f735089?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="category-tag">Career Tips</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Negotiating Your Salary: A Complete Guide</h3>
                        <p class="text-gray-600 mb-4">
                            Master the art of salary negotiation with these proven techniques and strategies.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="author-avatar mr-2">
                                <span class="text-sm text-gray-600">Maria Garcia</span>
                            </div>
                            <span class="text-sm text-gray-500">8 min read</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 px-4 gradient-bg">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Stay Updated</h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Get the latest insights, career tips, and industry trends delivered straight to your inbox.
            </p>
            
            <div class="max-w-md mx-auto">
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Enter your email" class="flex-1 py-3 px-6 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-purple-300">
                    <button type="submit" class="bg-white text-purple-700 hover:bg-gray-100 font-semibold py-3 px-8 rounded-full transition duration-300">
                        Subscribe
                    </button>
                </form>
                <p class="text-sm text-gray-200 mt-4">
                    Join 10,000+ subscribers. No spam, unsubscribe anytime.
                </p>
            </div>
        </div>
    </section>

    <!-- Load More -->
    <section class="py-12 px-4">
        <div class="container mx-auto text-center">
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                Load More Articles
            </button>
        </div>
    </section>

    <script>
        // Category filter functionality
        document.querySelectorAll('.category-tag').forEach(tag => {
            tag.addEventListener('click', function() {
                // Remove active state from all tags
                document.querySelectorAll('.category-tag').forEach(t => {
                    t.classList.remove('bg-purple-600', 'text-white');
                    t.classList.add('bg-gray-200', 'text-gray-700');
                });
                
                // Add active state to clicked tag
                this.classList.remove('bg-gray-200', 'text-gray-700');
                this.classList.add('bg-purple-600', 'text-white');
                
                // Here you would typically filter the articles
                console.log('Filter by category:', this.textContent);
            });
        });

        // Search functionality
        document.querySelector('input[placeholder="Search articles..."]').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // Here you would typically implement search logic
            console.log('Search for:', searchTerm);
        });
    </script>
</body>
</html>
