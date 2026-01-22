<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repository\UserRepository;

class AdminController extends Controller
{
    private UserRepository $userRepository;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->requireRole('admin');

        $this->userRepository = new UserRepository(Database::connection());
    }

    public function dashboard(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/dashboard', [
            'user'       => $user,
            'page_title' => 'Admin Dashboard - TalentHub'
        ]);
    }

    public function users(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/users', [
            'user'       => $user,
            'page_title' => 'Manage Users - TalentHub'
        ]);
    }

    public function roles(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/roles', [
            'user'       => $user,
            'page_title' => 'Manage Roles - TalentHub'
        ]);
    }

    public function system(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/system', [
            'user'       => $user,
            'page_title' => 'System Settings - TalentHub'
        ]);
    }

    public function logs(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/logs', [
            'user'       => $user,
            'page_title' => 'System Logs - TalentHub'
        ]);
    }

  

 
}
