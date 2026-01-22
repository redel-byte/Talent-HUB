<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Middleware\Database;
use App\Models\User;
use App\Models\UserModel;

class CandidateController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new UserModel(Database::connection());
        $this->requireRole('candidate');
    }

    public function dashboard()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $this->view('candidate/dashboard', [
            'user' => $user,
            'page_title' => 'Candidate Dashboard - TalentHub'
        ]);
    }

    public function profile()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $this->view('candidate/profile', [
            'user' => $user,
            'page_title' => 'My Profile - TalentHub'
        ]);
    }

    public function applications()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $this->view('candidate/applications', [
            'user' => $user,
            'page_title' => 'My Applications - TalentHub'
        ]);
    }

    public function settings()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $this->view('candidate/settings', [
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
            $this->redirect('/Talent-HUB/login');
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
            $_SESSION['error'] = 'Access denied. Insufficient permissions.';
            $this->redirect('/Talent-HUB/403');
        }
    }
}
