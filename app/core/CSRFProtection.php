<?php

namespace Youcode\WorkshopMvc\Core;

/**
 * CSRF Protection Class
 * Provides Cross-Site Request Forgery protection tokens
 */
class CSRFProtection
{
    private static string $tokenName = 'csrf_token';
    private static int $tokenLength = 32;

    /**
     * Generate a new CSRF token
     */
    public static function generateToken(): string
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $token = bin2hex(random_bytes(self::$tokenLength));
        $_SESSION[self::$tokenName] = $token;
        
        return $token;
    }

    /**
     * Get existing token or generate new one
     */
    public static function getToken(): string
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION[self::$tokenName])) {
            return self::generateToken();
        }

        return $_SESSION[self::$tokenName];
    }

    /**
     * Validate CSRF token
     */
    public static function validateToken(string $token): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION[self::$tokenName]) || empty($token)) {
            return false;
        }

        return hash_equals($_SESSION[self::$tokenName], $token);
    }

    /**
     * Get HTML input field for CSRF token
     */
    public static function getHiddenInput(): string
    {
        $token = self::getToken();
        return '<input type="hidden" name="' . self::$tokenName . '" value="' . htmlspecialchars($token) . '">';
    }

    /**
     * Clear the CSRF token
     */
    public static function clearToken(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION[self::$tokenName]);
    }

    /**
     * Validate token from POST request
     */
    public static function validateRequest(): bool
    {
        $token = $_POST[self::$tokenName] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        
        if (!self::validateToken($token)) {
            self::clearToken();
            return false;
        }

        return true;
    }
}
