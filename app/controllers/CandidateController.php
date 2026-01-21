<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repository\UserRepository;

class CandidateController extends Controller
{
    private UserRepository $userRepository;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->requireRole('candidate');

        $this->userRepository = new UserRepository(Database::connection());
    }

    public function dashboard(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('candidate/dashboard', [
            'user'       => $user,
            'page_title' => 'Candidate Dashboard - TalentHub'
        ]);
    }

    public function profile(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('candidate/profile', [
            'user'       => $user,
            'page_title' => 'My Profile - TalentHub'
        ]);
    }

    public function applications(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('candidate/applications', [
            'user'       => $user,
            'page_title' => 'My Applications - TalentHub'
        ]);
    }

    public function settings(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('candidate/settings', [
            'user'       => $user,
            'page_title' => 'Settings - TalentHub'
        ]);
    }

    /* =========================
       HELPERS
    ==========================*/

    // private function getCurrentUser(): ?array
    // {
    //     if (!isset($_SESSION['user_id'])) {
    //         return null;
    //     }

    //     return $this->userRepository->findById((int) $_SESSION['user_id']);
    // }
}
