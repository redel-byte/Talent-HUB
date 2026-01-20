<?php

namespace Youcode\WorkshopMvc\Core;

class Validator
{
    // regex for text (allows letters and spaces)
    private static $strRegex = "/^[a-zA-Z\s]+$/";
    
    // regex for phone number (Moroccan format)
    private static $phoneRegex = "/^0[567][0-9]{8}$/";  // Fixed: added 5 for other operators
    
    // regex for email - more permissive
    private static $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    
    // regex for date (YYYY-MM-DD format)
    private static $dateRegex = "/^\d{4}-\d{2}-\d{2}$/";
    
    // check if string is not empty
    public static function NotEmpty(string $input): bool
    {
        return !empty(trim($input));  // Fixed: trim first
    }
    
    // validate if text contains only letters and spaces
    public static function isstring(string $input): bool
    {
        return preg_match(self::$strRegex, $input) === 1;  // Better comparison
    }
    
    // validate if date is valid and real
    public static function isValidDate(string $input): bool
    {
        if (preg_match(self::$dateRegex, $input) !== 1) {
            return false;
        }
        
        // Check if it's a real date
        $dateParts = explode('-', $input);
        if (count($dateParts) !== 3) {
            return false;
        }
        
        return checkdate((int)$dateParts[1], (int)$dateParts[2], (int)$dateParts[0]);
    }
    
    // validate email
    public static function validateEmail(string $input): bool
    {
        // Use filter_var for primary email validation
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Additional regex check for format
        return preg_match(self::$emailRegex, $input) === 1;
    }
    
    // validate phone number
    public static function validatePhone(string $input): bool
    {
        return preg_match(self::$phoneRegex, $input) === 1;
    }
    
    // remove special characters and sanitize
    public static function rmSpecialChar(string $input): string
    {
        // Remove HTML tags and encode special chars
        $cleaned = strip_tags($input);
        $cleaned = htmlspecialchars($cleaned, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        return trim($cleaned);
    }
    
    // alias for rmSpecialChar
    public static function sanitize(string $input): string
    {
        return self::rmSpecialChar($input);
    }
    
    // Additional useful validators you might want:
    
    // Validate numeric input
    public static function isNumber($input): bool
    {
        return is_numeric($input);
    }
    
    // Validate integer
    public static function isInteger($input): bool
    {
        return filter_var($input, FILTER_VALIDATE_INT) !== false;
    }
    
    // Validate URL
    public static function validateUrl(string $input): bool
    {
        return filter_var($input, FILTER_VALIDATE_URL) !== false;
    }
    
    // Validate password strength (example)
    public static function validatePassword(string $password): bool
    {
        // At least 8 chars, contains letter and number
        return strlen($password) >= 8 && 
               preg_match('/[A-Za-z]/', $password) && 
               preg_match('/\d/', $password);
    }
    
    // Validate Moroccan CIN (Carte Nationale d'Identité)
    public static function validateCIN(string $cin): bool
    {
        return preg_match('/^[A-Z]{1,2}[0-9]{6}$/', $cin) === 1;
    }
}
