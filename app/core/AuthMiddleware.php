<?php

namespace Youcode\WorkshopMvc\Core;

/**
 * Middleware for role-based route protection
 * Ensures users are authenticated and have appropriate roles
 */
class AuthMiddleware
{
    private array $publicRoutes = [
        '/' => ['GET'],
        '/home' => ['GET'],
        '/find-talent' => ['GET'],
        '/find-jobs' => ['GET'],
        '/login' => ['GET', 'POST'],
        '/register' => ['GET', 'POST'],
        '/logout' => ['GET'],
        '/403' => ['GET'],
        '/404' => ['GET']
    ];

    private array $roleRoutes = [
        'candidate' => [
            '/candidate' => ['GET'],
            '/candidate/dashboard' => ['GET'],
            '/candidate/profile' => ['GET'],
            '/candidate/applications' => ['GET'],
            '/candidate/settings' => ['GET']
        ],
        'recruiter' => [
            '/recruiter' => ['GET'],
            '/recruiter/dashboard' => ['GET'],
            '/recruiter/jobs' => ['GET'],
            '/recruiter/candidates' => ['GET'],
            '/recruiter/company' => ['GET'],
            '/recruiter/settings' => ['GET']
        ],
        'admin' => [
            '/admin' => ['GET'],
            '/admin/dashboard' => ['GET'],
            '/admin/users' => ['GET'],
            '/admin/roles' => ['GET'],
            '/admin/system' => ['GET'],
            '/admin/logs' => ['GET']
        ]
    ];

    public function handle(string $uri, string $method): bool
    {
        // Normalize URI
        $uri = rtrim($uri, '/');
        if ($uri === '') $uri = '/';

        // Check if route is public
        if ($this->isPublicRoute($uri, $method)) {
            return true;
        }

        // Check if user is authenticated
        if (!$this->isAuthenticated()) {
            $_SESSION['error'] = 'Please login to access this page.';
            $this->redirect('/login');
            return false;
        }

        // Check role-based access
        $userRole = $_SESSION['role'] ?? null;
        if (!$userRole || !$this->hasRoleAccess($userRole, $uri, $method)) {
            $_SESSION['error'] = 'Access denied. Insufficient permissions.';
            $this->redirect('/403');
            return false;
        }

        return true;
    }

    private function isPublicRoute(string $uri, string $method): bool
    {
        if (!isset($this->publicRoutes[$uri])) {
            return false;
        }

        return in_array($method, $this->publicRoutes[$uri]);
    }

    private function isAuthenticated(): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    private function hasRoleAccess(string $role, string $uri, string $method): bool
    {
        if (!isset($this->roleRoutes[$role])) {
            return false;
        }

        $roleRoutes = $this->roleRoutes[$role];
        
        // Check exact route match
        if (isset($roleRoutes[$uri])) {
            return in_array($method, $roleRoutes[$uri]);
        }

        // Check prefix matches (for routes like /candidate/*)
        foreach ($roleRoutes as $route => $allowedMethods) {
            if ($this->isPrefixMatch($route, $uri)) {
                return in_array($method, $allowedMethods);
            }
        }

        return false;
    }

    private function isPrefixMatch(string $pattern, string $uri): bool
    {
        // Handle wildcard patterns like /candidate/*
        if (str_ends_with($pattern, '/*')) {
            $prefix = substr($pattern, 0, -2);
            return str_starts_with($uri, $prefix);
        }

        return false;
    }

    private function redirect(string $url): void
    {
        $baseUrl = '/systemAuth';
        $fullUrl = $baseUrl . $url;
        header("Location: {$fullUrl}");
        exit();
    }

    public function getRequiredRole(string $uri): ?string
    {
        foreach ($this->roleRoutes as $role => $routes) {
            foreach ($routes as $route => $methods) {
                if ($this->isPrefixMatch($route, $uri) || $route === $uri) {
                    return $role;
                }
            }
        }

        return null;
    }
}
