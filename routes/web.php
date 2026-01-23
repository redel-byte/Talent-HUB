<?php

use App\Core\Router;
use App\Middleware\AuthMiddleware;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\CandidateController;
use App\Controllers\RecruiterController;
use App\Controllers\AdminController;

// Initialize middleware
$authMiddleware = new AuthMiddleware();

// Get current request info
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Apply middleware protection
$router = new Router();
$uri = $router->getUri();
if (!$authMiddleware->handle($uri, $method)) {
    exit(); // Middleware handled redirect
}

// Public Routes - Main Home Page
$router->addRouter('GET', '/', [HomeController::class, 'index']);
$router->addRouter('GET', '/home', [HomeController::class, 'index']);
$router->addRouter('GET', '/find-talent', [HomeController::class, 'findTalent']);
$router->addRouter('GET', '/find-jobs', [HomeController::class, 'findJobs']);
$router->addRouter('GET', '/pricing', [HomeController::class, 'pricing']);
$router->addRouter('GET', '/blog', [HomeController::class, 'blog']);
$router->addRouter('GET', '/how-it-works', [HomeController::class, 'howItWorks']);
$router->addRouter('GET', '/about', [HomeController::class, 'about']);
$router->addRouter('GET', '/contact', [HomeController::class, 'contact']);
$router->addRouter('GET', '/privacy', [HomeController::class, 'privacy']);
$router->addRouter('GET', '/terms', [HomeController::class, 'terms']);

// Authentication Routes
$router->addRouter('GET', '/login', [AuthController::class, 'loginForm']);
$router->addRouter('POST', '/login', [AuthController::class, 'login']);
$router->addRouter('GET', '/register', [AuthController::class, 'registerForm']);
$router->addRouter('POST', '/register', [AuthController::class, 'register']);
$router->addRouter('GET', '/register/candidate', [AuthController::class, 'candidateRegisterForm']);
$router->addRouter('POST', '/register/candidate', [AuthController::class, 'candidateRegister']);
$router->addRouter('GET', '/register/recruiter', [AuthController::class, 'recruiterRegisterForm']);
$router->addRouter('POST', '/register/recruiter', [AuthController::class, 'recruiterRegister']);
$router->addRouter('GET', '/logout', [AuthController::class, 'logout']);
$router->addRouter('GET', '/clear-session', [AuthController::class, 'logout']);

// Candidate Routes
$router->addRouter('GET', '/candidate', [CandidateController::class, 'dashboard']);
$router->addRouter('GET', '/candidate/dashboard', [CandidateController::class, 'dashboard']);
$router->addRouter('GET', '/candidate/profile', [CandidateController::class, 'profile']);
$router->addRouter('POST', '/candidate/profile/update', [CandidateController::class, 'profileUpdate']);
$router->addRouter('GET', '/candidate/applications', [CandidateController::class, 'applications']);
$router->addRouter('GET', '/candidate/settings', [CandidateController::class, 'settings']);

// Candidate API Routes
$router->addRouter('GET', '/api/candidate/application/details', [CandidateController::class, 'getApplicationDetails']);
$router->addRouter('POST', '/api/candidate/application/withdraw', [CandidateController::class, 'withdrawApplication']);
$router->addRouter('POST', '/api/candidate/application/accept', [CandidateController::class, 'acceptOffer']);
$router->addRouter('POST', '/api/candidate/application/reapply', [CandidateController::class, 'reapplyJob']);
$router->addRouter('POST', '/api/candidate/job/save', [CandidateController::class, 'saveJob']);
$router->addRouter('POST', '/api/candidate/job/unsave', [CandidateController::class, 'unsaveJob']);
$router->addRouter('POST', '/api/candidate/resume/upload', [CandidateController::class, 'uploadResume']);
$router->addRouter('POST', '/api/candidate/job/apply', [CandidateController::class, 'applyForJob']);

// Recruiter Routes
$router->addRouter('GET', '/recruiter', [RecruiterController::class, 'dashboard']);
$router->addRouter('GET', '/recruiter/dashboard', [RecruiterController::class, 'dashboard']);
$router->addRouter('GET', '/recruiter/jobs', [RecruiterController::class, 'jobs']);
$router->addRouter('GET', '/recruiter/candidates', [RecruiterController::class, 'candidates']);
$router->addRouter('GET', '/recruiter/company', [RecruiterController::class, 'company']);
$router->addRouter('GET', '/recruiter/settings', [RecruiterController::class, 'settings']);

// Admin Routes
$router->addRouter('GET', '/admin', [AdminController::class, 'dashboard']);
$router->addRouter('GET', '/admin/dashboard', [AdminController::class, 'dashboard']);
$router->addRouter('GET', '/admin/users', [AdminController::class, 'users']);
$router->addRouter('GET', '/admin/roles', [AdminController::class, 'roles']);
$router->addRouter('GET', '/admin/system', [AdminController::class, 'system']);
$router->addRouter('GET', '/admin/logs', [AdminController::class, 'logs']);

// Error Routes
$router->addRouter('GET', '/403', function() {
    http_response_code(403);
    require_once __DIR__ . '/../app/views/errors/403.php';
});

$router->addRouter('GET', '/404', function() {
    http_response_code(404);
    require_once __DIR__ . '/../app/views/errors/404.php';
});

$router->dispatch();
