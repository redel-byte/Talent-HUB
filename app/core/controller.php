<?php

namespace App\Core;

class Controller
{
    public function view(string $view, array $data = []): void
    {
        extract($data);
        require_once __DIR__ . "/../views/{$view}.php";
    }

    protected function redirect(string $url): void
    {
        $baseUrl = '/Talent-HUB';
        $fullUrl = $baseUrl . $url;
        header("Location: {$fullUrl}");
        exit();
    }

    protected function isLoggedIn(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    protected function requireAuth(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
    }
}
