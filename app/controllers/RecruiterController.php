<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Middleware\Database;
use App\Models\UserModel;

class RecruiterController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new UserModel(\App\Middleware\Database::connection());
    }

    public function dashboard()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/dashboard', [
            'user' => $user,
            'page_title' => 'Recruiter Dashboard - TalentHub'
        ]);
    }

    public function jobs()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/jobs', [
            'user' => $user,
            'page_title' => 'Manage Job Postings - TalentHub'
        ]);
    }

    public function candidates()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/candidates', [
            'user' => $user,
            'page_title' => 'View Candidates - TalentHub'
        ]);
    }

    public function company()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/company', [
            'user' => $user,
            'page_title' => 'Company Profile - TalentHub'
        ]);
    }

    public function settings()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/settings', [
            'user' => $user,
            'page_title' => 'Settings - TalentHub'
        ]);
    }

    protected function getCurrentUser(): ?array
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return $this->userModel->findById($_SESSION['user_id']);
    }

    protected function requireRole(string $requiredRole): void
    {
        if (!$this->isLoggedIn()) {
            $_SESSION['error'] = 'Please login to access this page.';
            $this->redirect('/login');
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
            $_SESSION['error'] = 'Access denied. Insufficient permissions.';
            $this->redirect('/403');
        }
    }
}
