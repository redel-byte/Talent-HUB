<?php

namespace App\Core;

class Security
{
   public static function sanitize(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

   public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

   public static function isStrongPassword(string $password): bool
    {
        // At least 8 characters, contains letters and numbers
        return strlen($password) >= 8 && 
               preg_match('/[A-Za-z]/', $password) && 
               preg_match('/[0-9]/', $password);
    }

   public static function generateToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

   public static function validateSession(): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            return false;
        }

        // Check if session contains required data
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
            return false;
        }

        // Check session timeout (optional)
        $maxLifetime = 3600; // 1 hour
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $maxLifetime) {
            session_destroy();
            return false;
        }

        // Update last activity
        $_SESSION['last_activity'] = time();
        return true;
    }
}
