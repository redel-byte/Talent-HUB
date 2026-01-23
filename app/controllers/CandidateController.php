<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Middleware\Database;
use App\Models\User;
use App\Models\UserModel;
use App\Repositories\CandidateRepository;
use Exception;

class CandidateController extends Controller
{
    private UserModel $userModel;
    private CandidateRepository $candidateRepository;
    private \App\Repositories\UserRepository $userRepository;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new UserModel(\App\Middleware\Database::connection());
        $this->candidateRepository = new CandidateRepository(\App\Middleware\Database::connection());
        $this->userRepository = new \App\Repositories\UserRepository(\App\Middleware\Database::connection());
    }

    public function dashboard()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // Get candidate statistics
        $stats = $this->candidateRepository->getCandidateStats($user['id']);
        $profile = $this->candidateRepository->getCandidateProfile($user['id']);
        $recentApplications = $this->candidateRepository->getCandidateApplications($user['id'], ['pending', 'reviewed', 'accepted']);
        $recentApplications = array_slice($recentApplications, 0, 3); // Show only 3 most recent
        $recommendedJobs = $this->candidateRepository->getRecommendedJobs($user['id'], 3);

        $this->view('candidate/dashboard', [
            'user' => $user,
            'stats' => $stats,
            'profile' => $profile,
            'recentApplications' => $recentApplications,
            'recommendedJobs' => $recommendedJobs,
            'page_title' => 'Candidate Dashboard - TalentHub'
        ]);
    }

    public function profile()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // Get candidate profile data
        $profile = $this->candidateRepository->getCandidateProfile($user['id']);
        $skills = $this->candidateRepository->getCandidateSkills($user['id']);

        $this->view('candidate/profile', [
            'user' => $user,
            'profile' => $profile,
            'skills' => $skills,
            'page_title' => 'My Profile - TalentHub'
        ]);
    }

    public function profileUpdate()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/candidate/profile');
        }

        // Validate and sanitize input
        $fullname = trim($_POST['fullname'] ?? '');
        $phone_number = trim($_POST['phone_number'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $summary = trim($_POST['summary'] ?? '');
        $experience_level = trim($_POST['experience_level'] ?? '');
        $expected_salary = trim($_POST['expected_salary'] ?? '');
        $skills = trim($_POST['skills'] ?? '');

        // Basic validation
        if (empty($fullname)) {
            $_SESSION['error'] = 'Full name is required.';
            $this->redirect('/candidate/profile');
        }

        // Prepare update data
        $updateData = [
            'fullname' => $fullname,
            'phone_number' => $phone_number,
            'location' => $location,
            'summary' => $summary,
            'experience_level' => $experience_level,
            'expected_salary' => $expected_salary,
            'skills' => $skills,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Update user profile
        try {
            $this->userRepository->update($user['id'], $updateData);
            $_SESSION['success'] = 'Profile updated successfully!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Failed to update profile. Please try again.';
        }

        $this->redirect('/candidate/profile');
    }

    public function applications()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // Get all candidate applications
        $applications = $this->candidateRepository->getCandidateApplications($user['id']);
        $stats = $this->candidateRepository->getCandidateStats($user['id']);

        $this->view('candidate/applications', [
            'user' => $user,
            'applications' => $applications,
            'stats' => $stats,
            'page_title' => 'My Applications - TalentHub'
        ]);
    }

    public function settings()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('candidate/settings', [
            'user' => $user,
            'page_title' => 'Settings - TalentHub'
        ]);
    }

    // API endpoints for AJAX requests
    public function getApplicationDetails()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        $applicationId = $_GET['id'] ?? null;
        if (!$applicationId) {
            $this->jsonResponse(['error' => 'Application ID required'], 400);
        }

        $application = $this->candidateRepository->getApplicationDetails($user['id'], $applicationId);
        if (!$application) {
            $this->jsonResponse(['error' => 'Application not found'], 404);
        }

        $this->jsonResponse(['data' => $application]);
    }

    public function withdrawApplication()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        $applicationId = $_POST['id'] ?? null;
        if (!$applicationId) {
            $this->jsonResponse(['error' => 'Application ID required'], 400);
        }

        try {
            $result = $this->candidateRepository->withdrawApplication($user['id'], $applicationId);
            if ($result) {
                $this->jsonResponse(['success' => 'Application withdrawn successfully']);
            } else {
                $this->jsonResponse(['error' => 'Failed to withdraw application'], 500);
            }
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'An error occurred'], 500);
        }
    }

    public function acceptOffer()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        $applicationId = $_POST['id'] ?? null;
        if (!$applicationId) {
            $this->jsonResponse(['error' => 'Application ID required'], 400);
        }

        try {
            $result = $this->candidateRepository->acceptOffer($user['id'], $applicationId);
            if ($result) {
                $this->jsonResponse(['success' => 'Offer accepted successfully']);
            } else {
                $this->jsonResponse(['error' => 'Failed to accept offer'], 500);
            }
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'An error occurred'], 500);
        }
    }

    public function reapplyJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        $applicationId = $_POST['id'] ?? null;
        if (!$applicationId) {
            $this->jsonResponse(['error' => 'Application ID required'], 400);
        }

        try {
            $result = $this->candidateRepository->reapplyJob($user['id'], $applicationId);
            if ($result) {
                $this->jsonResponse(['success' => 'Application submitted successfully']);
            } else {
                $this->jsonResponse(['error' => 'Failed to reapply'], 500);
            }
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'An error occurred'], 500);
        }
    }

    public function saveJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        $jobId = $_POST['job_id'] ?? null;
        if (!$jobId) {
            $this->jsonResponse(['error' => 'Job ID required'], 400);
        }

        try {
            $result = $this->candidateRepository->saveJob($user['id'], $jobId);
            if ($result) {
                $this->jsonResponse(['success' => 'Job saved successfully']);
            } else {
                $this->jsonResponse(['error' => 'Failed to save job'], 500);
            }
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'An error occurred'], 500);
        }
    }

    public function unsaveJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        $jobId = $_POST['job_id'] ?? null;
        if (!$jobId) {
            $this->jsonResponse(['error' => 'Job ID required'], 400);
        }

        try {
            $result = $this->candidateRepository->unsaveJob($user['id'], $jobId);
            if ($result) {
                $this->jsonResponse(['success' => 'Job removed from saved list']);
            } else {
                $this->jsonResponse(['error' => 'Failed to remove saved job'], 500);
            }
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'An error occurred'], 500);
        }
    }

    public function uploadResume()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        if (!isset($_FILES['resume'])) {
            $this->jsonResponse(['error' => 'No file uploaded'], 400);
        }

        $file = $_FILES['resume'];
        
        // Check for PHP upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'File size exceeds server limit (max 2MB)',
                UPLOAD_ERR_FORM_SIZE => 'File size exceeds form limit',
                UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
                UPLOAD_ERR_NO_FILE => 'No file was uploaded',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                UPLOAD_ERR_EXTENSION => 'File upload stopped by extension',
            ];
            $errorMessage = $errorMessages[$file['error']] ?? 'Unknown upload error';
            $this->jsonResponse(['error' => $errorMessage], 400);
        }
        
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        if (!in_array($file['type'], $allowedTypes)) {
            $this->jsonResponse(['error' => 'Invalid file type. Only PDF, DOC, and DOCX files are allowed'], 400);
        }

        // Updated to match PHP configuration (2MB limit)
        if ($file['size'] > 2 * 1024 * 1024) { // 2MB limit to match PHP config
            $this->jsonResponse(['error' => 'File size too large. Maximum size is 2MB'], 400);
        }

        try {
            $uploadDir = __DIR__ . '/../../public/uploads/resumes/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = 'resume_' . $user['id'] . '_' . time() . '_' . basename($file['name']);
            $uploadPath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // Update user record with resume file path
                $updateResult = $this->userRepository->update($user['id'], ['resume_path' => $fileName]);
                
                if ($updateResult) {
                    $this->jsonResponse(['success' => 'Resume uploaded successfully', 'filename' => $fileName]);
                } else {
                    $this->jsonResponse(['error' => 'Failed to save file path to database'], 500);
                }
            } else {
                $this->jsonResponse(['error' => 'Failed to upload file'], 500);
            }
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'An error occurred during upload: ' . $e->getMessage()], 500);
        }
    }

    private function jsonResponse(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function getCurrentUser(): ?array
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return $this->userModel->findById($_SESSION['user_id']);
    }

    protected function requireRole(string $requiredRole): void
    {
        if (!$this->isLoggedIn()) {
            $_SESSION['error'] = 'Please login to access this page.';
            $this->redirect('/login');
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
            $_SESSION['error'] = 'Access denied. Insufficient permissions.';
            $this->redirect('/403');
        }
    }

    private function getStatusColor(string $status): string
    {
        $colors = [
            'pending' => 'yellow',
            'reviewed' => 'blue',
            'accepted' => 'green',
            'rejected' => 'red',
            'interview' => 'purple'
        ];
        
        return $colors[$status] ?? 'gray';
    }

    public function applyForJob()
    {
        $user = $this->getCurrentUser();
        if (!$user || $user['role'] !== 'candidate') {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $jobId = $input['job_id'] ?? null;

        if (!$jobId) {
            $this->jsonResponse(['error' => 'Job ID is required'], 400);
        }

        try {
            $pdo = \App\Middleware\Database::connection();
            
            // Check if already applied
            $stmt = $pdo->prepare(
                "SELECT id FROM applications WHERE candidate_id = ? AND job_offer_id = ?"
            );
            $stmt->execute([$user['id'], $jobId]);
            if ($stmt->fetch()) {
                $this->jsonResponse(['error' => 'You have already applied for this job'], 400);
            }

            // Check if job exists
            $stmt = $pdo->prepare("SELECT id FROM job_offers WHERE id = ? AND archived_at IS NULL");
            $stmt->execute([$jobId]);
            if (!$stmt->fetch()) {
                $this->jsonResponse(['error' => 'Job not found'], 404);
            }

            // Create application
            $stmt = $pdo->prepare(
                "INSERT INTO applications (candidate_id, job_offer_id, status, cv_upload, created_at) 
                 VALUES (?, ?, 'pending', 'resume_uploaded.pdf', NOW())"
            );
            $result = $stmt->execute([$user['id'], $jobId]);

            if ($result) {
                $this->jsonResponse(['success' => 'Application submitted successfully']);
            } else {
                $this->jsonResponse(['error' => 'Failed to submit application'], 500);
            }
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
