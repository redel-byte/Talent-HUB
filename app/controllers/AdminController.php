<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Middleware\Database;
use App\Models\UserModel;

class AdminController extends Controller
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

        $this->view('admin/dashboard', [
            'user' => $user,
            'page_title' => 'Admin Dashboard - TalentHub'
        ]);
    }

    public function users()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/users', [
            'user' => $user,
            'page_title' => 'Manage Users - TalentHub'
        ]);
    }

    public function roles()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/roles', [
            'user' => $user,
            'page_title' => 'Manage Roles - TalentHub'
        ]);
    }

    public function system()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/system', [
            'user' => $user,
            'page_title' => 'System Settings - TalentHub'
        ]);
    }

    public function logs()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('admin/logs', [
            'user' => $user,
            'page_title' => 'System Logs - TalentHub'
        ]);
    }

    protected function getCurrentUser(): ?array
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return $this->userModel->findById($_SESSION['user_id']);
    }
}
