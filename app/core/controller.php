<?php

namespace App\Core;

use App\Repository\UserRepository;

class Controller
{
    /* =========================
       VIEW
    ==========================*/
    protected function view(string $view, array $data = []): void
    {
        $file = __DIR__ . "/../views/{$view}.php";

        if (!file_exists($file)) {
            throw new \RuntimeException("View not found: {$view}");
        }

        extract($data);
        require $file;
    }

    /* =========================
       REDIRECT
    ==========================*/
    protected function redirect(string $path): void
    {
        header('Location: /Talent-HUB' . $path);
        exit;
    }

    /* =========================
       AUTH
    ==========================*/
    protected function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    protected function requireAuth(): void
    {
        if (!$this->isLoggedIn()) {
            $_SESSION['error'] = 'Please login to continue.';
            $this->redirect('/login');
        }
    }

    protected function requireRole(string $role): void
    {
        if (!$this->isLoggedIn()) {
            $_SESSION['error'] = 'Please login to access this page.';
            $this->redirect('/login');
        }

        if (($_SESSION['role'] ?? null) !== $role) {
            $_SESSION['error'] = 'Access denied.';
            $this->redirect('/403');
        }
    }

    /* =========================
       USER
    ==========================*/
    protected function getCurrentUser(): ?array
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        $repo = new UserRepository(Database::connection());
        return $repo->findById((int) $_SESSION['user_id']);
    }
}
