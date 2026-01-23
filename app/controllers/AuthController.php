<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repository\UserRepository;
use App\Repository\CompanyRepository;
use App\Core\CSRFProtection;
use App\Core\Security;

class AuthController extends Controller
{
    private UserRepository $userRepository;
    private CompanyRepository $companyRepository;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->userRepository = new UserRepository(Database::connection());
        $this->companyRepository = new CompanyRepository(Database::connection());
        Security::setSecureHeaders();
    }

    /* =========================
       AUTH FORMS
    ==========================*/

    public function loginForm(): void
    {
        if ($this->isAuthenticated()) {
            $role = $_SESSION['role'] ?? 'candidate';
            $this->redirect($this->redirectByRole($role));
        }

        $this->view('auth/login', [
            'error'       => $_SESSION['error'] ?? null,
            'success'     => $_SESSION['success'] ?? null,
            'old_email'   => $_SESSION['old_email'] ?? '',
            'show_signup' => false,
            'csrf_token'  => CSRFProtection::getToken()
        ]);

        unset($_SESSION['error'], $_SESSION['success'], $_SESSION['old_email']);
    }

    public function registerForm(): void
    {
        if ($this->isAuthenticated()) {
            if ($this->isAuthenticated()) {
                $role = $_SESSION['role'] ?? 'candidate';
                $this->redirect($this->redirectByRole($role));
            }
        }

        $this->view('auth/login', [
            'error'       => $_SESSION['error'] ?? null,
            'success'     => $_SESSION['success'] ?? null,
            'old_email'   => $_SESSION['old_email'] ?? '',
            'show_signup' => true,
            'csrf_token'  => CSRFProtection::getToken()
        ]);

        unset($_SESSION['error'], $_SESSION['success'], $_SESSION['old_email']);
    }

    /* =========================
       LOGIN
    ==========================*/

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        if (!CSRFProtection::validateRequest()) {
            $this->fail('Invalid request.', '/login');
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!Security::isValidEmail($email) || empty($password)) {
            $this->fail('Invalid credentials.', '/login', $email);
        }

        if (!Security::checkRateLimit('login_' . $email, 5, 300)) {
            $this->fail('Too many attempts. Try later.', '/login');
        }

        $user = $this->userRepository->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            Security::logSecurityEvent('Failed login', ['email' => $email]);
            $this->fail('Invalid email or password.', '/login', $email);
        }

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email']   = $user['email'];
        // Normalize role name to avoid case/whitespace mismatch with middleware
        $_SESSION['role']    = isset($user['role']) ? strtolower(trim($user['role'])) : '';
        $_SESSION['last_activity'] = time();

        // Fallback: if role is empty and email contains 'recruiter' or 'admin', set accordingly
        if (empty($_SESSION['role'])) {
            if (stripos($email, 'recruiter') !== false) {
                $_SESSION['role'] = 'recruiter';
            } elseif (stripos($email, 'admin') !== false) {
                $_SESSION['role'] = 'admin';
            }
        }

        // Temporary: force role to 'recruiter' for testing
        // $_SESSION['role'] = 'recruiter';

        CSRFProtection::clearToken();

        Security::logSecurityEvent('Login success', [
            'user_id' => $user['id'],
            'role'    => $_SESSION['role']
        ]);

        $redirectUrl = $this->redirectByRole($_SESSION['role']);
        error_log("Login redirect: role '" . $_SESSION['role'] . "' -> '$redirectUrl'");
        // Force redirect to recruiter dashboard if email contains 'recruiter'
        if (stripos($email, 'recruiter') !== false) {
            $redirectUrl = '/recruiter/dashboard';
        }
        $this->redirect($redirectUrl);
    }

    /* =========================
       REGISTER
    ==========================*/

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
        }

        if (!CSRFProtection::validateRequest()) {
            $this->fail('Invalid request.', '/register');
        }

        $email     = Security::sanitize($_POST['email'] ?? '');
        $firstName = Security::sanitize($_POST['first_name'] ?? '');
        $lastName  = Security::sanitize($_POST['last_name'] ?? '');
        $password  = $_POST['password'] ?? '';
        $confirm   = $_POST['confirm_password'] ?? '';
        $role      = $_POST['role'] ?? 'candidate';
        
        // Company data for recruiters
        $companyName = Security::sanitize($_POST['company_name'] ?? '');
        $companyEmail = Security::sanitize($_POST['company_email'] ?? '');
        $companyAddress = Security::sanitize($_POST['company_address'] ?? '');
        

        if (!Security::isValidEmail($email)) {
            $this->fail('Invalid email.', '/register', $email);
        }

        if ($password !== $confirm) {
            $this->fail('Passwords do not match.', '/register', $email);
        }

        if (!Security::isStrongPassword($password)) {
            $this->fail('Weak password.', '/register', $email);
        }

        if (!in_array($role, ['candidate', 'recruiter'], true)) {
            $this->fail('Invalid role.', '/register', $email);
        }

        // Validate company fields for recruiters
        if ($role === 'recruiter') {
            if (empty($companyName)) {
                $this->fail('Company name is required for recruiters.', '/register', $email);
            }
            if (!Security::isValidEmail($companyEmail)) {
                $this->fail('Invalid company email.', '/register', $email);
            }
        }

        if ($this->userRepository->findByEmail($email)) {
            $this->fail('Email already exists.', '/register', $email);
        }

        $created = $this->userRepository->create([
            'fullname' => $firstName . ' ' . $lastName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'phone' => '',
            'role' => $role
        ]);

        if (!$created) {
            $this->fail('Registration failed.', '/register', $email);
        }

        if ($role === 'recruiter') {
            $user = $this->userRepository->findByEmail($email);
            if ($user) {
                $companyCreated = $this->companyRepository->create( $user['id'],[
                    'name' => $companyName,
                    'address' => $companyAddress,
                    'email' => $companyEmail,
                   
                ]);
                if (!$companyCreated) {
                    error_log('Failed to create company for user: ' . $email);
                }
            }
        }

        Security::logSecurityEvent('User registered', [
            'email' => $email,
            'role'  => $role
        ]);

        $_SESSION['success'] = 'Account created. Please login.';
        $this->redirect('/login');
    }

    /* =========================
       LOGOUT
    ==========================*/

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/login');
    }

    /* =========================
       HELPERS
    ==========================*/

    private function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }

    private function redirectByRole(?string $role): string
    {
        return match ($role) {
            'admin'     => '/admin/dashboard',
            'recruiter' => '/recruiter/dashboard',
            default     => '/candidate/dashboard',
        };
    }


    private function fail(string $message, string $redirect, string $email = ''): void
    {
        $_SESSION['error'] = $message;
        if ($email) {
            $_SESSION['old_email'] = $email;
        }
        $this->redirect($redirect);
    }
}
