<?php

namespace Youcode\WorkshopMvc\Controllers;

use Youcode\WorkshopMvc\Core\Controller;
use Youcode\WorkshopMvc\Core\Database;
use Youcode\WorkshopMvc\Models\User;
use Youcode\WorkshopMvc\Core\Validator;
use Youcode\WorkshopMvc\Core\CSRFProtection;
use Youcode\WorkshopMvc\Core\Security;

class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new User(Database::connection());
        Security::setSecureHeaders();
    }

    public function loginForm()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }

        $error = $_SESSION['error'] ?? null;
        $old_email = $_SESSION['old_email'] ?? '';
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['old_email'], $_SESSION['success']);

        $this->view('auth/login', [
            'error' => $error,
            'old_email' => $old_email,
            'success' => $success,
            'show_signup' => false,
            'csrf_token' => CSRFProtection::getToken()
        ]);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        // Validate CSRF token
        if (!CSRFProtection::validateRequest()) {
            $_SESSION['error'] = 'Invalid request. Please try again.';
            Security::logSecurityEvent('CSRF token validation failed', ['email' => $_POST['email'] ?? '']);
            $this->redirect('/login');
        }

        // Rate limiting check
        $email = trim($_POST['email'] ?? '');
        if (!Security::checkRateLimit('login_' . $email, 5, 300)) {
            $_SESSION['error'] = 'Too many login attempts. Please try again later.';
            Security::logSecurityEvent('Rate limit exceeded', ['email' => $email]);
            $this->redirect('/login');
        }

        $password = $_POST['password'] ?? '';

        // Input validation
        if (empty($email) || empty($password) || !Security::isValidEmail($email)) {
            $_SESSION['error'] = 'Please provide a valid email and password.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/login');
        }

        // Authenticate user
        $user = $this->userModel->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'] ?? 'candidate';
            $_SESSION['last_activity'] = time();
            
            // Log successful login
            Security::logSecurityEvent('Successful login', [
                'user_id' => $user['id'],
                'email' => $email,
                'role' => $user['role']
            ]);
            
            // Clear CSRF token and redirect
            CSRFProtection::clearToken();
            
            // Role-based redirection
            switch ($_SESSION['role']) {
                case 'candidate':
                    $this->redirect('/candidate/dashboard');
                    break;
                case 'recruiter':
                    $this->redirect('/recruiter/dashboard');
                    break;
                case 'admin':
                    $this->redirect('/admin/dashboard');
                    break;
                default:
                    $this->redirect('/');
                    break;
            }
        }

        // Log failed login attempt
        Security::logSecurityEvent('Failed login attempt', [
            'email' => $email,
            'ip' => Security::getClientIP()
        ]);

        $_SESSION['error'] = 'Invalid email or password.';
        $_SESSION['old_email'] = $email;
        $this->redirect('/login');
    }

    public function registerForm()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }

        $error = $_SESSION['error'] ?? null;
        $old_email = $_SESSION['old_email'] ?? '';
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['old_email'], $_SESSION['success']);

        $this->view('auth/login', [
            'error' => $error,
            'old_email' => $old_email,
            'success' => $success,
            'show_signup' => true,
            'csrf_token' => CSRFProtection::getToken()
        ]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Talent-HUB/register');
        }

        // Validate CSRF token
        if (!CSRFProtection::validateRequest()) {
            $_SESSION['error'] = 'Invalid request. Please try again.';
            Security::logSecurityEvent('CSRF token validation failed during registration', ['email' => $_POST['email'] ?? '']);
            $this->redirect('/Talent-HUB/register');
        }

        $email = Security::sanitize(trim($_POST['email'] ?? ''));
        $firstName = Security::sanitize(trim($_POST['first_name'] ?? ''));
        $lastName = Security::sanitize(trim($_POST['last_name'] ?? ''));
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $role = Security::sanitize($_POST['role'] ?? 'candidate');

        // Rate limiting check
        if (!Security::checkRateLimit('register_' . Security::getClientIP(), 3, 3600)) {
            $_SESSION['error'] = 'Too many registration attempts. Please try again later.';
            Security::logSecurityEvent('Registration rate limit exceeded', ['ip' => Security::getClientIP()]);
            $this->redirect('/Talent-HUB/register');
        }

        // Input validation
        if (!Security::isValidEmail($email)) {
            $_SESSION['error'] = 'Please provide a valid email address.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/Talent-HUB/register');
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/Talent-HUB/register');
        }

        if (!Security::isStrongPassword($password)) {
            $_SESSION['error'] = 'Password must be at least 8 characters and contain letters and numbers.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/Talent-HUB/register');
        }

        // Validate role
        if (!in_array($role, ['candidate', 'recruiter'])) {
            $_SESSION['error'] = 'Invalid role selected.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/Talent-HUB/register');
        }

        // Check if email already exists
        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email already registered.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/Talent-HUB/register');
        }

        // Create user
        $created = $this->userModel->create($email, $password, $role, $firstName, $lastName);
        if ($created) {
            Security::logSecurityEvent('User registration successful', [
                'email' => $email,
                'role' => $role,
                'ip' => Security::getClientIP()
            ]);
            
            $_SESSION['success'] = 'Account created successfully. You can now log in.';
            CSRFProtection::clearToken();
            $this->redirect('/Talent-HUB/login');
        }

        Security::logSecurityEvent('User registration failed', [
            'email' => $email,
            'role' => $role,
            'ip' => Security::getClientIP()
        ]);

        $_SESSION['error'] = 'Failed to create account. Please try again.';
        $_SESSION['old_email'] = $email;
        $this->redirect('/Talent-HUB/register');
    }

    public function logout()
    {
        $_SESSION = [];
        if (session_id() !== '') {
            session_destroy();
        }
        $this->redirect('/Talent-HUB/login');
    }

    public function home()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/Talent-HUB/login');
        }

        // Redirect to role-specific dashboard
        $role = $_SESSION['role'] ?? 'candidate';
        switch ($role) {
            case 'candidate':
                $this->redirect('/Talent-HUB/candidate/dashboard');
                break;
            case 'recruiter':
                $this->redirect('/Talent-HUB/recruiter/dashboard');
                break;
            case 'admin':
                $this->redirect('/Talent-HUB/admin/dashboard');
                break;
            default:
                $this->redirect('/Talent-HUB/login');
                break;
        }
    }
}
