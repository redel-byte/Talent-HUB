<?php ob_start(); ?>

<!-- Privacy Policy Page Content -->
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Privacy Policy</h1>
                <p class="text-xl">Your privacy is important to us</p>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-4xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Information We Collect</h2>
                <p class="text-gray-600 mb-6">
                    We collect information you provide directly to us, such as when you create an account, fill out a form, or contact us. This includes:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Name and contact information</li>
                    <li>Professional profile information</li>
                    <li>Resume and work history</li>
                    <li>Job preferences and skills</li>
                    <li>Communication preferences</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">How We Use Your Information</h2>
                <p class="text-gray-600 mb-6">
                    We use the information we collect to:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Provide and maintain our service</li>
                    <li>Process job applications and recruitment</li>
                    <li>Communicate with you about our services</li>
                    <li>Improve our platform and user experience</li>
                    <li>Ensure security and prevent fraud</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Information Sharing</h2>
                <p class="text-gray-600 mb-6">
                    We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>To employers you've applied to</li>
                    <li>Service providers who assist in operating our platform</li>
                    <li>When required by law or to protect our rights</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Data Security</h2>
                <p class="text-gray-600 mb-6">
                    We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Rights</h2>
                <p class="text-gray-600 mb-6">
                    You have the right to:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Access and update your personal information</li>
                    <li>Delete your account and data</li>
                    <li>Opt-out of marketing communications</li>
                    <li>Request a copy of your data</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Cookies</h2>
                <p class="text-gray-600 mb-6">
                    We use cookies and similar tracking technologies to track activity on our service and hold certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Changes to This Policy</h2>
                <p class="text-gray-600 mb-6">
                    We may update our privacy policy from time to time. We will notify you of any changes by posting the new privacy policy on this page and updating the "Last Updated" date.
                </p>

                <div class="mt-8 p-4 bg-gray-100 rounded-lg">
                    <p class="text-sm text-gray-600">
                        <strong>Last Updated:</strong> January 23, 2026<br>
                        <strong>Contact Us:</strong> If you have any questions about this privacy policy, please contact us at privacy@talenthub.com
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
