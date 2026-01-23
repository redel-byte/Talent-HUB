<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repository\UserRepository;
use App\Repository\ApplicationRepository;
use App\Repository\JobOfferRepository;
use App\Repository\CompanyRepository;

class CandidateController extends Controller
{
    private UserRepository $userRepository;
    private ApplicationRepository $applicationRepository;
    private JobOfferRepository $jobRepository;
    private CompanyRepository $companyRepository;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->requireRole('candidate');

        $this->userRepository = new UserRepository(Database::connection());
        $this->applicationRepository = new ApplicationRepository(Database::connection());
        $this->jobRepository = new JobOfferRepository(Database::connection());
        $this->companyRepository = new CompanyRepository(Database::connection());
    }

    public function dashboard(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // Get candidate's applications
        $applications = $this->applicationRepository->findByCandidate($user['id']);
        
        // Calculate statistics
        $stats = [
            'total_applications' => count($applications),
            'profile_views' => 0, // TODO: Implement profile views tracking
            'saved_jobs' => 0, // TODO: Implement saved jobs functionality
            'profile_completion' => $this->calculateProfileCompletion($user)
        ];

        // Get recent applications (last 5) with job details
        $recentApplications = [];
        foreach (array_slice($applications, 0, 5) as $application) {
            $job = $this->jobRepository->findById($application['job_offer_id']);
            if ($job) {
                $company = $this->companyRepository->findById($job[0]['company_id']);
                $application['job_title'] = $job[0]['title'];
                $application['company_name'] = $company ? $company['name'] : 'Unknown Company';
                $recentApplications[] = $application;
            }
        }

        // Get recommended jobs (latest 3 active jobs) with company details
        $recommendedJobs = [];
        foreach ($this->jobRepository->findActive(3) as $job) {
            $company = $this->companyRepository->findById($job['company_id']);
            $job['company_name'] = $company ? $company['name'] : 'Unknown Company';
            $recommendedJobs[] = $job;
        }

        $this->view('candidate/dashboard', [
            'user' => $user,
            'stats' => $stats,
            'recent_applications' => $recentApplications,
            'recommended_jobs' => $recommendedJobs,
            'page_title' => 'Candidate Dashboard - TalentHub'
        ]);
    }

    public function profile(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('candidate/profile', [
            'user'       => $user,
            'page_title' => 'My Profile - TalentHub'
        ]);
    }

    public function updateProfile(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Talent-HUB/candidate/profile');
        }

        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $fullname = trim($_POST['fullname'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $experience = trim($_POST['experience'] ?? '');
        $skills = trim($_POST['skills'] ?? '');
        $bio = trim($_POST['bio'] ?? '');

        if (empty($fullname)) {
            $_SESSION['error'] = 'Full name is required.';
            $this->redirect('/Talent-HUB/candidate/profile');
        }

        // Update user profile
        $updated = $this->userRepository->update($user['id'], [
            'fullname' => $fullname,
            'phone_number' => $phone
        ]);

        if ($updated) {
            $_SESSION['success'] = 'Profile updated successfully!';
        } else {
            $_SESSION['error'] = 'Failed to update profile. Please try again.';
        }

        $this->redirect('/Talent-HUB/candidate/profile');
    }

    public function settings(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('candidate/settings', [
            'user'       => $user,
            'page_title' => 'Settings - TalentHub'
        ]);
    }

    public function jobs(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // Get all active jobs
        $jobs = $this->jobRepository->findActive();

        $this->view('candidate/jobs', [
            'user' => $user,
            'jobs' => $jobs,
            'page_title' => 'Browse Jobs - TalentHub'
        ]);
    }

    public function applyJob(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Talent-HUB/candidate/jobs');
        }

        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $jobId = (int)($_POST['job_id'] ?? 0);
        $coverLetter = trim($_POST['cover_letter'] ?? '');

        if (!$jobId) {
            $_SESSION['error'] = 'Invalid job selection.';
            $this->redirect('/Talent-HUB/candidate/jobs');
        }

        // Check if job exists and is active
        $job = $this->jobRepository->findById($jobId);
        if (!$job || ($job[0]['deleted_at'] ?? null)) {
            $_SESSION['error'] = 'Job not found or no longer available.';
            $this->redirect('/Talent-HUB/candidate/jobs');
        }

        // Check if already applied
        $existingApplication = $this->applicationRepository->findByCandidateAndJob($user['id'], $jobId);
        if ($existingApplication) {
            $_SESSION['error'] = 'You have already applied to this job.';
            $this->redirect('/Talent-HUB/candidate/jobs');
        }

        // Create application
        $applicationId = $this->applicationRepository->create([
            'candidate_id' => $user['id'],
            'job_offer_id' => $jobId,
            'cover_letter' => $coverLetter,
            'status' => 'pending'
        ]);

        if ($applicationId) {
            $_SESSION['success'] = 'Application submitted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to submit application. Please try again.';
        }

        $this->redirect('/Talent-HUB/candidate/jobs');
    }

    public function applications(): void
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $applications = $this->applicationRepository->findByCandidate($user['id']);

        // Enrich applications with job details
        $enrichedApplications = [];
        foreach ($applications as $application) {
            $job = $this->jobRepository->findById($application['job_offer_id']);
            if ($job) {
                $application['job_title'] = $job[0]['title'];
                $application['company_name'] = $this->getCompanyName($job[0]['company_id']);
                $enrichedApplications[] = $application;
            }
        }

        $this->view('candidate/applications', [
            'user' => $user,
            'applications' => $enrichedApplications,
            'page_title' => 'My Applications - TalentHub'
        ]);
    }

    /* =========================
       HELPERS
    ==========================*/

    private function calculateProfileCompletion(array $user): int
    {
        $fields = ['fullname', 'email', 'phone_number'];
        $completed = 0;
        
        foreach ($fields as $field) {
            if (!empty($user[$field])) {
                $completed++;
            }
        }
        
        return round(($completed / count($fields)) * 100);
    }

    private function getCompanyName(int $companyId): string
    {
        $company = $this->companyRepository->findById($companyId);
        return $company ? $company['name'] : 'Unknown Company';
    }

    /* =========================
       HELPERS
    ==========================*/

    // private function getCurrentUser(): ?array
    // {
    //     if (!isset($_SESSION['user_id'])) {
    //         return null;
    //     }

    //     return $this->userRepository->findById((int) $_SESSION['user_id']);
    // }
}
