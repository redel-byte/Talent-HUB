<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\TagRepository;
// use App\Repositories\CategoryRepository;

class AdminController extends Controller
{
    private User $userModel;
    private UserRepository $userRepo;
    private TagRepository $tagRepo;
    // private CategoryRepository $categoryRepo;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->userModel    = new User(Database::connection());
        $this->userRepo     = new UserRepository();
        $this->tagRepo      = new TagRepository();
        // $this->categoryRepo = new CategoryRepository();
    }

    public function dashboard(): void
    {
        $this->requireRole('admin');

        $user       = $this->getCurrentUser();
        $totalUsers = $this->userRepo->countAll();
        $roleCounts = $this->userRepo->countByRole();

        $totalTags       = count($this->tagRepo->all());
        // $totalCategories = count($this->categoryRepo->all());

        $this->view('admin/dashboard', [
            'user'            => $user,
            'page_title'      => 'Admin Dashboard - TalentHub',
            'totalUsers'      => $totalUsers,
            'roleCounts'      => $roleCounts,
            'totalTags'       => $totalTags,
            // 'totalCategories' => $totalCategories,
        ]);
    }

    public function users(): void
    {
        $this->requireRole('admin');

        $user  = $this->getCurrentUser();
        $users = $this->userRepo->findAllWithRole();

        $this->view('admin/users', [
            'user'       => $user,
            'page_title' => 'Manage Users - TalentHub',
            'users'      => $users,
        ]);
    }

    public function roles(): void
    {
        $this->requireRole('admin');

        $user = $this->getCurrentUser();

        $this->view('admin/roles', [
            'user'       => $user,
            'page_title' => 'Manage Roles - TalentHub',
        ]);
    }

    public function system(): void
    {
        $this->requireRole('admin');

        $user = $this->getCurrentUser();

        $this->view('admin/system', [
            'user'       => $user,
            'page_title' => 'System Settings - TalentHub',
        ]);
    }

    public function logs(): void
    {
        $this->requireRole('admin');

        $user = $this->getCurrentUser();

        $this->view('admin/logs', [
            'user'       => $user,
            'page_title' => 'System Logs - TalentHub',
        ]);
    }

    private function getCurrentUser(): ?array
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return $this->userModel->findById((int) $_SESSION['user_id']);
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
