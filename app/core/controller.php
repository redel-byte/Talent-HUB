<?php

namespace App\Core;

/**
 * Base Controller
 * All controllers should extend this class
 * Provides common functionality for controllers
 */

class Controller
{
    /**
     * Render a view with optional data
     * 
     * @param string $view View filename (without .php)
     * @param array $data Data to pass to the view
     */
        public function view(string $view, array $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../views/{$view}.php";
    }
    

    /**
     * Redirect to a different URL
     * 
     * @param string $url URL to redirect to
     */








    
    protected function redirect($url)
    {
        $baseUrl = '/Talent-HUB';
        $fullUrl = $baseUrl . $url;
        header("Location: {$fullUrl}");
        exit();
    }

    /**
     * Check if user is logged in
     * 
     * TODO: Students must implement this method
     * Hint: Check if 'user_id' exists in $_SESSION
     * 
     * @return bool True if user is logged in
     */
    protected function isLoggedIn()
    {
        // TODO: Implement session check
        // Return true if user is authenticated
        return isset($_SESSION['user_id']);
    }

    /**
     * Require authentication for a page
     * Redirects to login if not authenticated
     */
    protected function requireAuth(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
    }

    protected function requireRole(string $role): void
    {
        if (!$this->isLoggedIn()) {
            $_SESSION['error'] = 'Please login to access this page.';
            $this->redirect('/login');
        }

        $currentRole = $_SESSION['role'] ?? null;
        error_log("RequireRole debug: required '$role', current '" . $currentRole . "'");

        if ($currentRole !== $role) {
            $_SESSION['error'] = 'Access denied.';
            $this->redirect('/403');
        }
    }

    /**
     * Get current logged-in user data
     */
    protected function getCurrentUser()
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        $repo = new \App\Repository\UserRepository(\App\Core\Database::connection());
        return $repo->findById($_SESSION['user_id']);
    }

    
}
