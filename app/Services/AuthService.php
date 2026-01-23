<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Middleware\Hashpassword;
use App\Middleware\Security;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $userData): array
    {
        // Validate required fields
        $requiredFields = ['email', 'password', 'first_name', 'last_name', 'phone_number', 'role'];
        foreach ($requiredFields as $field) {
            if (empty($userData[$field])) {
                return ['success' => false, 'message' => "Field {$field} is required"];
            }
        }

        // Validate email format
        if (!Security::isValidEmail($userData['email'])) {
            return ['success' => false, 'message' => 'Please provide a valid email address'];
        }

        // Validate password strength
        if (!Security::isStrongPassword($userData['password'])) {
            return ['success' => false, 'message' => 'Password must be at least 8 characters and contain letters and numbers'];
        }

        // Validate role
        if (!in_array($userData['role'], ['candidate', 'recruiter'])) {
            return ['success' => false, 'message' => 'Invalid role selected'];
        }

        // Check if email already exists
        if ($this->userRepository->findByEmail($userData['email'])) {
            return ['success' => false, 'message' => 'Email already registered'];
        }

        // Prepare user data
        $hashedPassword = (new Hashpassword($userData['password']))->getHashedPassword();
        $userRecord = [
            'email' => Security::sanitize($userData['email']),
            'fullname' => Security::sanitize(trim($userData['first_name'] . ' ' . $userData['last_name'])),
            'password' => $hashedPassword,
            'phone_number' => Security::sanitize($userData['phone_number']),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Create user
        $result = $this->userRepository->createWithRole(
            $userRecord['email'], 
            $hashedPassword, 
            $userRecord['phone_number'], 
            $userData['role'], 
            $userData['first_name'], 
            $userData['last_name']
        );
        
        if ($result) {
            return ['success' => true, 'message' => 'Account created successfully'];
        }

        return ['success' => false, 'message' => 'Failed to create account'];
    }

    public function login(string $email, string $password): array
    {
        // Validate input
        if (empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Email and password are required'];
        }

        if (!Security::isValidEmail($email)) {
            return ['success' => false, 'message' => 'Please provide a valid email address'];
        }

        // Find user
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            return ['success' => false, 'message' => 'Invalid email or password'];
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Invalid email or password'];
        }

        return ['success' => true, 'user' => $user];
    }

    public function updatePassword(int $userId, string $currentPassword, string $newPassword): array
    {
        // Validate new password
        if (!Security::isStrongPassword($newPassword)) {
            return ['success' => false, 'message' => 'New password must be at least 8 characters and contain letters and numbers'];
        }

        // Get current user
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }

        // Verify current password
        if (!password_verify($currentPassword, $user['password'])) {
            return ['success' => false, 'message' => 'Current password is incorrect'];
        }

        // Update password
        $hashedPassword = (new Hashpassword($newPassword))->getHashedPassword();
        $result = $this->userRepository->updatePassword($userId, $hashedPassword);

        if ($result) {
            return ['success' => true, 'message' => 'Password updated successfully'];
        }

        return ['success' => false, 'message' => 'Failed to update password'];
    }

    public function updateProfile(int $userId, array $profileData): array
    {
        // Sanitize input
        $sanitizedData = [];
        foreach (['fullname', 'phone_number'] as $field) {
            if (isset($profileData[$field])) {
                $sanitizedData[$field] = Security::sanitize($profileData[$field]);
            }
        }

        if (empty($sanitizedData)) {
            return ['success' => false, 'message' => 'No valid data provided'];
        }

        $result = $this->userRepository->updateProfile($userId, $sanitizedData);

        if ($result) {
            return ['success' => true, 'message' => 'Profile updated successfully'];
        }

        return ['success' => false, 'message' => 'Failed to update profile'];
    }
}
