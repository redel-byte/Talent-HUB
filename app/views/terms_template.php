<?php ob_start(); ?>

<!-- Terms of Service Page Content -->
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Terms of Service</h1>
                <p class="text-xl">Terms and conditions for using TalentHub</p>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-4xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Acceptance of Terms</h2>
                <p class="text-gray-600 mb-6">
                    By accessing and using TalentHub, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Description of Service</h2>
                <p class="text-gray-600 mb-6">
                    TalentHub is a platform that connects job seekers with employers. Our services include:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Job search and application tools</li>
                    <li>Candidate profile management</li>
                    <li>Employer job posting and candidate search</li>
                    <li>Communication tools between candidates and employers</li>
                    <li>Career resources and insights</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">User Responsibilities</h2>
                <p class="text-gray-600 mb-6">
                    As a user of TalentHub, you agree to:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Provide accurate and truthful information</li>
                    <li>Maintain the security of your account credentials</li>
                    <li>Use the service for legitimate professional purposes</li>
                    <li>Respect the rights of other users</li>
                    <li>Comply with all applicable laws and regulations</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Prohibited Activities</h2>
                <p class="text-gray-600 mb-6">
                    You may not:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Post false or misleading information</li>
                    <li>Use the service for fraudulent purposes</li>
                    <li>Harass or discriminate against other users</li>
                    <li>Violate intellectual property rights</li>
                    <li>Interfere with the operation of the service</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Account Termination</h2>
                <p class="text-gray-600 mb-6">
                    We reserve the right to suspend or terminate your account if you violate these terms or engage in prohibited activities. You may also terminate your account at any time through your account settings.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Intellectual Property</h2>
                <p class="text-gray-600 mb-6">
                    The content and features of TalentHub are owned by TalentHub and are protected by copyright, trademark, and other intellectual property laws. You may not use our content without our written permission.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Limitation of Liability</h2>
                <p class="text-gray-600 mb-6">
                    TalentHub is provided on an "as is" basis. We make no warranties regarding the accuracy or reliability of the service. We shall not be liable for any direct, indirect, or consequential damages arising from your use of the service.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Privacy</h2>
                <p class="text-gray-600 mb-6">
                    Your privacy is important to us. Please review our Privacy Policy, which also governs your use of the service, to understand our practices.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Changes to Terms</h2>
                <p class="text-gray-600 mb-6">
                    We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting. Your continued use of the service constitutes acceptance of any changes.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Information</h2>
                <p class="text-gray-600 mb-6">
                    If you have any questions about these terms, please contact us at legal@talenthub.com
                </p>

                <div class="mt-8 p-4 bg-gray-100 rounded-lg">
                    <p class="text-sm text-gray-600">
                        <strong>Last Updated:</strong> January 23, 2026<br>
                        <strong>Effective Date:</strong> January 23, 2026
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layouts/base.php';
?>
