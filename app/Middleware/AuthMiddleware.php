<?php

namespace App\Middleware;

class AuthMiddleware
{
    private array $publicRoutes = [
        '/' => ['GET'],
        '/home' => ['GET'],
        '/find-talent' => ['GET'],
        '/find-jobs' => ['GET'],
        '/pricing' => ['GET'],
        '/blog' => ['GET'],
        '/how-it-works' => ['GET'],
        '/about' => ['GET'],
        '/contact' => ['GET'],
        '/privacy' => ['GET'],
        '/terms' => ['GET'],
        '/login' => ['GET', 'POST'],
        '/register' => ['GET', 'POST'],
        '/register/candidate' => ['GET', 'POST'],
        '/register/recruiter' => ['GET', 'POST'],
        '/logout' => ['GET'],
        '/clear-session' => ['GET'],
        '/403' => ['GET'],
        '/404' => ['GET']
    ];

    private array $roleRoutes = [
        'candidate' => [
            '/candidate' => ['GET'],
            '/candidate/dashboard' => ['GET'],
            '/candidate/profile' => ['GET', 'POST'],
            '/candidate/profile/update' => ['POST'],
            '/candidate/applications' => ['GET'],
            '/candidate/settings' => ['GET'],
            '/api/candidate' => ['GET', 'POST'],
            '/api/candidate/application' => ['GET', 'POST'],
            '/api/candidate/application/details' => ['GET'],
            '/api/candidate/application/withdraw' => ['POST'],
            '/api/candidate/application/accept' => ['POST'],
            '/api/candidate/application/reapply' => ['POST'],
            '/api/candidate/job' => ['GET', 'POST'],
            '/api/candidate/job/save' => ['POST'],
            '/api/candidate/job/unsave' => ['POST'],
            '/api/candidate/resume' => ['GET', 'POST'],
            '/api/candidate/resume/upload' => ['POST']
        ],
        'recruiter' => [
            '/recruiter' => ['GET'],
            '/recruiter/dashboard' => ['GET'],
            '/recruiter/jobs' => ['GET'],
            '/recruiter/jobs/create' => ['GET'],
            '/recruiter/jobs/store' => ['POST'],
            '/recruiter/jobs/edit' => ['GET'],
            '/recruiter/jobs/update' => ['POST'],
            '/recruiter/jobs/delete' => ['POST'],
            '/recruiter/candidates' => ['GET'],
            '/recruiter/company' => ['GET'],
            '/recruiter/company/create' => ['GET'],
            '/recruiter/company/store' => ['POST'],
            '/recruiter/company/update' => ['POST'],
            '/recruiter/settings' => ['GET'],
            '/recruiter/applications' => ['GET'],
            '/recruiter/applications/update-status' => ['POST'],
            '/recruiter/candidate/profile' => ['GET']
        ],
        'admin' => [
            '/admin' => ['GET'],
            '/admin/dashboard' => ['GET'],
            '/admin/users' => ['GET'],
            '/admin/roles' => ['GET'],
            '/admin/system' => ['GET'],
            '/admin/logs' => ['GET'],
            '/admin/tags' => ['GET'],
            '/admin/tags/create' => ['GET'],
            '/admin/tags/store' => ['POST'],
            '/admin/tags/edit' => ['GET'],
            '/admin/tags/update' => ['POST'],
            '/admin/tags/destroy' => ['POST'],
            '/admin/categories' => ['GET'],
            '/admin/categories/create' => ['GET'],
            '/admin/categories/store' => ['POST'],
            '/admin/categories/edit' => ['GET'],
            '/admin/categories/update' => ['POST'],
            '/admin/categories/destroy' => ['POST']
        ]
    ];

    public function handle(string $uri, string $method): bool
    {
        // Normalize URI
        $uri = rtrim($uri, '/');
        if ($uri === '') $uri = '/';

        // Debug: Log the request
        error_log("AuthMiddleware: Checking URI: $uri, Method: $method");
        error_log("AuthMiddleware: User role: " . ($_SESSION['role'] ?? 'NOT SET'));
        error_log("AuthMiddleware: User ID: " . ($_SESSION['user_id'] ?? 'NOT SET'));

        // Check if route is public
        if ($this->isPublicRoute($uri, $method)) {
            return true;
        }

        // Check if user is authenticated
        if (!$this->isAuthenticated()) {
            error_log("AuthMiddleware: User not authenticated");
            $_SESSION['error'] = 'Please login to access this page.';
            $this->redirect('/login');
            return false;
        }

        // Check role-based access
        $userRole = $_SESSION['role'] ?? null;
        error_log("AuthMiddleware: Checking role access for role: $userRole");
        
        if (!$userRole || !$this->hasRoleAccess($userRole, $uri, $method)) {
            error_log("AuthMiddleware: Access denied for role: $userRole, URI: $uri");
            $_SESSION['error'] = 'Access denied. Insufficient permissions.';
            $this->redirect('/403');
            return false;
        }

        error_log("AuthMiddleware: Access granted");
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
        // Sync role from database if not set in session
        if (empty($role) && isset($_SESSION['user_id'])) {
            error_log("AuthMiddleware: Role is empty, syncing from database");
            $userModel = new \App\Models\UserModel(\App\Middleware\Database::connection());
            $user = $userModel->findById($_SESSION['user_id']);
            if ($user && isset($user['role'])) {
                $_SESSION['role'] = $user['role'];
                $role = $user['role'];
                error_log("AuthMiddleware: Synced role from database: $role");
            }
        }
        
        error_log("AuthMiddleware: Checking access for role: $role, URI: $uri, Method: $method");
        
        if (!isset($this->roleRoutes[$role])) {
            error_log("AuthMiddleware: Role $role not found in roleRoutes");
            return false;
        }

        $roleRoutes = $this->roleRoutes[$role];
        error_log("AuthMiddleware: Available routes for role $role: " . implode(', ', array_keys($roleRoutes)));
        
        // Check exact route match
        if (isset($roleRoutes[$uri])) {
            $allowed = in_array($method, $roleRoutes[$uri]);
            error_log("AuthMiddleware: Exact route match found for $uri, method $method allowed: " . ($allowed ? 'YES' : 'NO'));
            return $allowed;
        }

        // Check prefix matches (for routes like /candidate/*)
        foreach ($roleRoutes as $route => $allowedMethods) {
            if ($this->isPrefixMatch($route, $uri)) {
                $allowed = in_array($method, $allowedMethods);
                error_log("AuthMiddleware: Prefix match found for $route, method $method allowed: " . ($allowed ? 'YES' : 'NO'));
                return $allowed;
            }
        }

        error_log("AuthMiddleware: No route match found for $uri");
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
        // Don't add base URL if it's already included or if it's an absolute URL
        if (str_starts_with($url, '/Talent-HUB') || str_starts_with($url, 'http')) {
            header("Location: {$url}");
        } else {
            $baseUrl = '/Talent-HUB';
            $fullUrl = $baseUrl . $url;
            header("Location: {$fullUrl}");
        }
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
