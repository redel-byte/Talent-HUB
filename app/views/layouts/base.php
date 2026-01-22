<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'TalentHub') ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <base href="/Talent-HUB/">
    <!-- Main JavaScript -->
    <script src="/Talent-HUB/app/views/assets/main.js" defer></script>
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
    <?php require_once __DIR__ . '/../components/navigation.php'; ?>

    <!-- Main Content -->
    <main>
        <?= $content ?? '' ?>
    </main>

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
                        <li><a href="/Talent-HUB/find-jobs" class="hover:text-white transition">Browse Jobs</a></li>
                        <li><a href="/Talent-HUB/candidate/profile" class="hover:text-white transition">Resume Builder</a></li>
                        <li><a href="/Talent-HUB/blog" class="hover:text-white transition">Career Advice</a></li>
                        <li><a href="/Talent-HUB/pricing" class="hover:text-white transition">Skill Tests</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">For Employers</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/Talent-HUB/find-talent" class="hover:text-white transition">Post Jobs</a></li>
                        <li><a href="/Talent-HUB/recruiter/dashboard" class="hover:text-white transition">Search Candidates</a></li>
                        <li><a href="/Talent-HUB/pricing" class="hover:text-white transition">Pricing Plans</a></li>
                        <li><a href="/Talent-HUB/how-it-works" class="hover:text-white transition">Recruitment Tools</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/Talent-HUB/about" class="hover:text-white transition">About Us</a></li>
                        <li><a href="/Talent-HUB/contact" class="hover:text-white transition">Contact</a></li>
                        <li><a href="/Talent-HUB/privacy" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="/Talent-HUB/terms" class="hover:text-white transition">Terms of Service</a></li>
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
