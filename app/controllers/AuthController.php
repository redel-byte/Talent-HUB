<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Middleware\Database;
use App\Models\UserModel;
use App\Middleware\CSRFProtection;
use App\Middleware\Security;

class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new UserModel(\App\Middleware\Database::connection());
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
            $this->redirect('/login');
        }

        // Rate limiting check
        $email = trim($_POST['email'] ?? '');
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

    public function candidateRegisterForm()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }

        $error = $_SESSION['error'] ?? null;
        $old_email = $_SESSION['old_email'] ?? '';
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['old_email'], $_SESSION['success']);

        $this->view('auth/register_candidate', [
            'error' => $error,
            'old_email' => $old_email,
            'success' => $success,
            'csrf_token' => CSRFProtection::getToken()
        ]);
    }

    public function recruiterRegisterForm()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }

        $error = $_SESSION['error'] ?? null;
        $old_email = $_SESSION['old_email'] ?? '';
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['old_email'], $_SESSION['success']);

        $this->view('auth/register_recruiter', [
            'error' => $error,
            'old_email' => $old_email,
            'success' => $success,
            'csrf_token' => CSRFProtection::getToken()
        ]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
        }

        // Validate CSRF token
        if (!CSRFProtection::validateRequest()) {
            $_SESSION['error'] = 'Invalid request. Please try again.';
            $this->redirect('/register');
        }

        $email = Security::sanitize(trim($_POST['email'] ?? ''));
        $firstName = Security::sanitize(trim($_POST['first_name'] ?? ''));
        $lastName = Security::sanitize(trim($_POST['last_name'] ?? ''));
        $password = $_POST['password'] ?? '';
        $phoneNumber = trim($_POST['phoneNumber'] ?? '');
        $confirm = $_POST['confirm_password'] ?? '';
        $role = $_POST['role'] ?? 'candidate';

        // Input validation
        if (!Security::isValidEmail($email)) {
            $_SESSION['error'] = 'Please provide a valid email address.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register');
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register');
        }

        if (!Security::isStrongPassword($password)) {
            $_SESSION['error'] = 'Password must be at least 8 characters and contain letters and numbers.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register');
        }

        // Validate role
        if (!in_array($role, ['candidate', 'recruiter'])) {
            $_SESSION['error'] = 'Invalid role selected.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register');
        }

        // Check if email already exists
        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email already registered.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register');
        }

        // Create user
        $created = $this->userModel->create($email, $password, $phoneNumber, $role, $firstName, $lastName);
        if ($created) {
            $_SESSION['success'] = 'Account created successfully. You can now log in.';
            CSRFProtection::clearToken();
            $this->redirect('/login');
        }
        $_SESSION['error'] = 'Failed to create account. Please try again.';
        $_SESSION['old_email'] = $email;
        $this->redirect('/register');
    }

    public function candidateRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register/candidate');
        }

        // Validate CSRF token
        if (!CSRFProtection::validateRequest()) {
            $_SESSION['error'] = 'Invalid request. Please try again.';
            $this->redirect('/register/candidate');
        }

        $email = Security::sanitize(trim($_POST['email'] ?? ''));
        $firstName = Security::sanitize(trim($_POST['first_name'] ?? ''));
        $lastName = Security::sanitize(trim($_POST['last_name'] ?? ''));
        $password = $_POST['password'] ?? '';
        $phoneNumber = trim($_POST['phoneNumber'] ?? '');
        $confirm = $_POST['confirm_password'] ?? '';
        $role = 'candidate';

        // Input validation
        if (!Security::isValidEmail($email)) {
            $_SESSION['error'] = 'Please provide a valid email address.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/candidate');
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/candidate');
        }

        if (!Security::isStrongPassword($password)) {
            $_SESSION['error'] = 'Password must be at least 8 characters and contain letters and numbers.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/candidate');
        }

        // Check if email already exists
        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email already registered.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/candidate');
        }

        // Create user
        $created = $this->userModel->create($email, $password, $phoneNumber, $role, $firstName, $lastName);
        if ($created) {
            $_SESSION['success'] = 'Candidate account created successfully. You can now log in.';
            CSRFProtection::clearToken();
            $this->redirect('/login');
        }
        $_SESSION['error'] = 'Failed to create account. Please try again.';
        $_SESSION['old_email'] = $email;
        $this->redirect('/register/candidate');
    }

    public function recruiterRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register/recruiter');
        }

        // Validate CSRF token
        if (!CSRFProtection::validateRequest()) {
            $_SESSION['error'] = 'Invalid request. Please try again.';
            $this->redirect('/register/recruiter');
        }

        $email = Security::sanitize(trim($_POST['email'] ?? ''));
        $firstName = Security::sanitize(trim($_POST['first_name'] ?? ''));
        $lastName = Security::sanitize(trim($_POST['last_name'] ?? ''));
        $password = $_POST['password'] ?? '';
        $phoneNumber = trim($_POST['phoneNumber'] ?? '');
        $confirm = $_POST['confirm_password'] ?? '';
        $role = 'recruiter';
        $companyName = Security::sanitize(trim($_POST['company_name'] ?? ''));

        // Input validation
        if (!Security::isValidEmail($email)) {
            $_SESSION['error'] = 'Please provide a valid work email address.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/recruiter');
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/recruiter');
        }

        if (!Security::isStrongPassword($password)) {
            $_SESSION['error'] = 'Password must be at least 8 characters and contain letters and numbers.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/recruiter');
        }

        if (empty($companyName)) {
            $_SESSION['error'] = 'Company name is required.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/recruiter');
        }

        // Check if email already exists
        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email already registered.';
            $_SESSION['old_email'] = $email;
            $this->redirect('/register/recruiter');
        }

        // Create user (note: company_name would need to be stored in a separate company table)
        $created = $this->userModel->create($email, $password, $phoneNumber, $role, $firstName, $lastName);
        if ($created) {
            $_SESSION['success'] = 'Employer account created successfully. You can now log in.';
            CSRFProtection::clearToken();
            $this->redirect('/login');
        }
        $_SESSION['error'] = 'Failed to create account. Please try again.';
        $_SESSION['old_email'] = $email;
        $this->redirect('/register/recruiter');
    }

    public function logout()
    {
        $_SESSION = [];
        if (session_id() !== '') {
            session_destroy();
        }
        $this->redirect('/login');
    }

    public function home()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        // Redirect to role-specific dashboard
        $role = $_SESSION['role'] ?? 'candidate';
        switch ($role) {
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
                $this->redirect('/login');
                break;
        }
    }
}
