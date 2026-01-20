<?php

namespace Youcode\WorkshopMvc\Core;

/**
 * Security Class
 * Provides various security utilities for the application
 */
class Security
{
    /**
     * Sanitize input data
     */
    public static function sanitize(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Validate email format
     */
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validate password strength
     */
    public static function isStrongPassword(string $password): bool
    {
        // At least 8 characters, contains letters and numbers
        return strlen($password) >= 8 && 
               preg_match('/[A-Za-z]/', $password) && 
               preg_match('/[0-9]/', $password);
    }

    /**
     * Generate secure random token
     */
    public static function generateToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Check if request is AJAX
     */
    public static function isAjaxRequest(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Get client IP address
     */
    public static function getClientIP(): string
    {
        $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        
        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }

    /**
     * Rate limiting check
     */
    public static function checkRateLimit(string $identifier, int $maxAttempts = 5, int $timeWindow = 300): bool
    {
        $cacheKey = "rate_limit_{$identifier}";
        
        if (!isset($_SESSION[$cacheKey])) {
            $_SESSION[$cacheKey] = ['attempts' => 0, 'first_attempt' => time()];
        }

        $data = $_SESSION[$cacheKey];
        
        // Reset if time window has passed
        if (time() - $data['first_attempt'] > $timeWindow) {
            $_SESSION[$cacheKey] = ['attempts' => 1, 'first_attempt' => time()];
            return true;
        }

        // Check if limit exceeded
        if ($data['attempts'] >= $maxAttempts) {
            return false;
        }

        // Increment attempts
        $_SESSION[$cacheKey]['attempts']++;
        return true;
    }

    /**
     * Log security event
     */
    public static function logSecurityEvent(string $event, array $context = []): void
    {
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'event' => $event,
            'ip' => self::getClientIP(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'context' => $context
        ];

        // In production, this should log to a file or logging service
        error_log('Security Event: ' . json_encode($logEntry));
    }

    /**
     * Validate session integrity
     */
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

    /**
     * Set secure headers
     */
    public static function setSecureHeaders(): void
    {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        }
    }

    /**
     * Validate file upload
     */
    public static function validateFileUpload(array $file, array $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'], int $maxSize = 5242880): array
    {
        $errors = [];

        // Check if file was uploaded
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            $errors[] = 'Invalid file upload';
            return $errors;
        }

        // Check file size
        if ($file['size'] > $maxSize) {
            $errors[] = 'File size exceeds maximum allowed size';
        }

        // Check file type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            $errors[] = 'File type not allowed';
        }

        return $errors;
    }
}
