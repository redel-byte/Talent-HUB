<?php ob_start(); ?>

<!-- About Page Content -->
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">About TalentHub</h1>
                <p class="text-xl">Connecting talent with opportunity since 2026</p>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <p class="text-gray-600 mb-4">
                    TalentHub is dedicated to revolutionizing the recruitment process by connecting talented individuals with their dream opportunities while helping companies find the perfect candidates to drive their success.
                </p>
                <p class="text-gray-600">
                    We believe that the right match between talent and opportunity can transform careers and businesses alike.
                </p>
            </div>
            
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Vision</h2>
                <p class="text-gray-600 mb-4">
                    To become the world's most trusted platform for talent acquisition and career development, leveraging cutting-edge technology to make recruitment more efficient, transparent, and successful for everyone involved.
                </p>
                <p class="text-gray-600">
                    We envision a future where every professional finds their ideal role and every company builds their dream team.
                </p>
            </div>
        </div>

        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Why Choose TalentHub?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Expert Matching</h3>
                    <p class="text-gray-600">AI-powered matching algorithms that connect the right talent with the right opportunities.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Secure & Trusted</h3>
                    <p class="text-gray-600">Industry-leading security measures to protect your data and privacy.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Proven Results</h3>
                    <p class="text-gray-600">Thousands of successful placements and career transitions powered by our platform.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layouts/base.php';
?>
