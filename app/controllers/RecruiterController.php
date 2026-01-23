<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Middleware\Database;
use App\Models\UserModel;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;

class RecruiterController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new UserModel(\App\Middleware\Database::connection());
    }

    public function dashboard()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // Mock stats data - replace with actual data from repositories
        $stats = [
            'active_jobs' => 5,
            'total_applicants' => 23,
            'profile_views' => 147,
            'interview_rate' => 35
        ];

        $this->view('recruiter/dashboard', [
            'user' => $user,
            'stats' => $stats,
            'page_title' => 'Recruiter Dashboard - TalentHub'
        ]);
    }

    public function jobs()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/jobs', [
            'user' => $user,
            'page_title' => 'Manage Job Postings - TalentHub'
        ]);
    }

    public function candidates()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/candidates', [
            'user' => $user,
            'page_title' => 'View Candidates - TalentHub'
        ]);
    }

    public function company()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/company', [
            'user' => $user,
            'page_title' => 'Company Profile - TalentHub'
        ]);
    }

    public function settings()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/settings', [
            'user' => $user,
            'page_title' => 'Settings - TalentHub'
        ]);
    }

    public function applications()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/applications', [
            'user' => $user,
            'page_title' => 'Job Applications - TalentHub'
        ]);
    }

    public function candidateProfile()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $candidateId = $_GET['id'] ?? null;
        if (!$candidateId) {
            $this->redirect('/recruiter/candidates');
        }

        $this->view('recruiter/candidate_profile', [
            'user' => $user,
            'candidate_id' => $candidateId,
            'page_title' => 'Candidate Profile - TalentHub'
        ]);
    }

    // Job Management Methods
    public function createJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $categoryRepository = new CategoryRepository();
        $tagRepository = new TagRepository();
        
        $categories = $categoryRepository->all();
        $tags = $tagRepository->all();

        $this->view('recruiter/create_job', [
            'user' => $user,
            'categories' => $categories,
            'tags' => $tags,
            'page_title' => 'Create Job Posting - TalentHub'
        ]);
    }

    public function storeJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // TODO: Implement job creation logic
        $_SESSION['success'] = 'Job posting created successfully!';
        $this->redirect('/recruiter/jobs');
    }

    public function editJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $jobId = $_GET['id'] ?? null;
        // TODO: Fetch job data and show edit form
        
        $this->view('recruiter/edit_job', [
            'user' => $user,
            'page_title' => 'Edit Job Posting - TalentHub'
        ]);
    }

    public function updateJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // TODO: Implement job update logic
        $_SESSION['success'] = 'Job posting updated successfully!';
        $this->redirect('/recruiter/jobs');
    }

    public function deleteJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $jobId = $_POST['id'] ?? null;
        // TODO: Implement job deletion logic
        $_SESSION['success'] = 'Job posting deleted successfully!';
        $this->redirect('/recruiter/jobs');
    }

    // Company Management Methods
    public function createCompany()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $this->view('recruiter/create_company', [
            'user' => $user,
            'page_title' => 'Create Company - TalentHub'
        ]);
    }

    public function storeCompany()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // TODO: Implement company creation logic
        $_SESSION['success'] = 'Company profile created successfully!';
        $this->redirect('/recruiter/company');
    }

    public function updateCompany()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        // TODO: Implement company update logic
        $_SESSION['success'] = 'Company profile updated successfully!';
        $this->redirect('/recruiter/company');
    }

    // Application Management Methods
    public function updateApplicationStatus()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $applicationId = $_POST['application_id'] ?? null;
        $status = $_POST['status'] ?? null;
        
        // TODO: Implement application status update logic
        $_SESSION['success'] = 'Application status updated successfully!';
        $this->redirect('/recruiter/applications');
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
}
