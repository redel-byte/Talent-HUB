<?php

namespace App\Controllers;

// use App\Core\Controller;
// use App\Core\Database;
// use App\Models\User;

// class AdminController extends Controller
// {
//     private User $userModel;

//     public function __construct()
//     {
//         if (session_status() == PHP_SESSION_NONE) {
//             session_start();
//         }
//         $this->userModel = new User(Database::connection());
//         $this->requireRole('admin');
//     }

//     public function dashboard()
//     {
//         $user = $this->getCurrentUser();
//         if (!$user) {
//             $this->redirect('/Talent-HUB/login');
//         }

//         $this->view('admin/dashboard', [
//             'user' => $user,
//             'page_title' => 'Admin Dashboard - TalentHub'
//         ]);
//     }

//     public function users()
//     {
//         $user = $this->getCurrentUser();
//         if (!$user) {
//             $this->redirect('/Talent-HUB/login');
//         }

//         $this->view('admin/users', [
//             'user' => $user,
//             'page_title' => 'Manage Users - TalentHub'
//         ]);
//     }

//     public function roles()
//     {
//         $user = $this->getCurrentUser();
//         if (!$user) {
//             $this->redirect('/Talent-HUB/login');
//         }

//         $this->view('admin/roles', [
//             'user' => $user,
//             'page_title' => 'Manage Roles - TalentHub'
//         ]);
//     }

//     public function system()
//     {
//         $user = $this->getCurrentUser();
//         if (!$user) {
//             $this->redirect('/Talent-HUB/login');
//         }

//         $this->view('admin/system', [
//             'user' => $user,
//             'page_title' => 'System Settings - TalentHub'
//         ]);
//     }

//     public function logs()
//     {
//         $user = $this->getCurrentUser();
//         if (!$user) {
//             $this->redirect('/Talent-HUB/login');
//         }

//         $this->view('admin/logs', [
//             'user' => $user,
//             'page_title' => 'System Logs - TalentHub'
//         ]);
//     }

//     private function getCurrentUser(): ?array
//     {
//         if (!isset($_SESSION['user_id'])) {
//             return null;
//         }

//         return $this->userModel->findById($_SESSION['user_id']);
//     }

//     protected function requireRole(string $requiredRole): void
//     {
//         if (!$this->isLoggedIn()) {
//             $_SESSION['error'] = 'Please login to access this page.';
//             $this->redirect('/Talent-HUB/login');
//         }

//         if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
//             $_SESSION['error'] = 'Access denied. Insufficient permissions.';
//             $this->redirect('/Talent-HUB/403');
//         }
//     }
// }
