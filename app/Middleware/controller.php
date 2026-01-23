<?php

namespace App\Middleware;

class Controller
{
   
    public function view(string $view, array $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . "/../views/{$view}.php";
        
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "<h1>View Not Found</h1>";
            echo "<p>The view file '{$view}.php' could not be found.</p>";
            return;
        }
        
        require_once $viewPath;
    }

    
    protected function redirect($url)
    {
        // Check if URL already includes the base path
        if (strpos($url, '/Talent-HUB') === 0) {
            header("Location: {$url}");
        } else {
            $baseUrl = '/Talent-HUB';
            $fullUrl = $baseUrl . $url;
            header("Location: {$fullUrl}");
        }
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
        $userModel = new \App\Models\UserModel(\App\Middleware\Database::connection());
        return $userModel->findById($userId);
    }
}
