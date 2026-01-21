<?php

namespace App\Core;

class Controller
{
   
    public function view(string $view, array $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../views/{$view}.php";
    }

    
    protected function redirect($url)
    {
        $baseUrl = '/Talent-HUB';
        $fullUrl = $baseUrl . $url;
        header("Location: {$fullUrl}");
        exit();
    }

    protected function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    protected function requireAuth(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
    }

    protected function requireRole(string $role): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
            exit();
        }
        
        $userRole = $_SESSION['role'] ?? '';
        if ($userRole !== $role) {
            $this->redirect('/403');
            exit();
        }
    }

    protected function getCurrentUser(): ?array
    {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        $userId = $_SESSION['user_id'];
        $userModel = new \App\Models\UserModel(\App\Core\Database::connection());
        return $userModel->findById($userId);
    }
}
