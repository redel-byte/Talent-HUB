<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repository\UserRepository;
use App\Repository\ApplicationRepository;
use App\Repository\JobOfferRepository;
use App\Repository\CompanyRepository;

class RecruiterController extends Controller
{
    private CompanyRepository $companyRepository;
    private JobOfferRepository $jobRepository;
    private ApplicationRepository $applicationRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->requireRole('recruiter');
        $this->companyRepository = new CompanyRepository(Database::connection());
        $this->jobRepository = new JobOfferRepository(Database::connection());
        $this->applicationRepository = new ApplicationRepository(Database::connection());
        $this->userRepository = new UserRepository(Database::connection());
    }

    public function dashboard()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        // Get user's company
        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            // Create company if not exists
            $this->companyRepository->create($user['id'], [
                'name' => $user['fullname'] . ' Company',
                'address' => '',
                'email' => $user['email']
            ]);
            $company = $this->companyRepository->findByUser($user['id']);
        }

        // Get dashboard statistics
        $jobs = $company ? $this->jobRepository->findByCompany($company['id']) : [];
        $activeJobs = array_filter($jobs, fn($job) => !($job['deleted_at'] ?? null));
        $allApplications = [];
        
        foreach ($activeJobs as $job) {
            $applications = $this->applicationRepository->findByJobOffer($job['id']);
            $allApplications = array_merge($allApplications, $applications);
        }
        
        // Calculate statistics
        $stats = [
            'active_jobs' => count($activeJobs),
            'total_applicants' => count($allApplications),
            'profile_views' => 0, // TODO: Implement profile views tracking
            'interview_rate' => count($allApplications) > 0 ? round((count(array_filter($allApplications, fn($app) => ($app['status'] ?? '') === 'interview')) / count($allApplications)) * 100) : 0
        ];

        // Get recent applications (last 5)
        $recentApplications = array_slice($allApplications, 0, 5);
        
        // Get recent job postings (last 3) with applicant counts
        $recentJobs = [];
        foreach (array_slice($activeJobs, 0, 3) as $job) {
            $applications = $this->applicationRepository->findByJobOffer($job['id']);
            $job['applicant_count'] = count($applications);
            $recentJobs[] = $job;
        }

        $this->view('recruiter/dashboard', [
            'user' => $user,
            'stats' => $stats,
            'recent_applications' => $recentApplications,
            'recent_jobs' => $recentJobs,
            'page_title' => 'Recruiter Dashboard - TalentHub'
        ]);
    }

    public function jobs()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        // Temporary: ensure role is set for recruiter
        if (empty($_SESSION['role'])) {
            $_SESSION['role'] = 'recruiter';
        }

        // Get user's company
        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            // Create company if not exists
            $this->companyRepository->create($user['id'], [
                'name' => $user['fullname'] . ' Company',
                'address' => '',
                'email' => $user['email']
            ]);
            $company = $this->companyRepository->findByUser($user['id']);
            if (!$company) {
                $_SESSION['error'] = 'Failed to create company.';
                $this->redirect('/Talent-HUB/recruiter/dashboard');
            }
        }

        $jobs = $this->jobRepository->findByCompany($company['id']);

        $this->view('recruiter/jobs', [
            'user' => $user,
            'jobs' => $jobs,
            'page_title' => 'Manage Job Postings - TalentHub'
        ]);
    }

    public function candidates()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        // Get all candidates
        $candidates = $this->userRepository->findByRole('candidate');

        $this->view('recruiter/candidates', [
            'user' => $user,
            'candidates' => $candidates,
            'page_title' => 'View Candidates - TalentHub'
        ]);
    }

    public function viewCandidate()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $candidateId = (int)($_GET['id'] ?? 0);
        if (!$candidateId) {
            $_SESSION['error'] = 'Invalid candidate ID.';
            $this->redirect('/Talent-HUB/recruiter/candidates');
        }

        $candidate = $this->userRepository->findById($candidateId);
        if (!$candidate || $candidate['role'] !== 'candidate') {
            $_SESSION['error'] = 'Candidate not found.';
            $this->redirect('/Talent-HUB/recruiter/candidates');
        }

        $this->view('recruiter/candidate_profile', [
            'user' => $user,
            'candidate' => $candidate,
            'page_title' => 'Candidate Profile - TalentHub'
        ]);
    }

    public function deleteCandidate()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $candidateId = (int)($_GET['id'] ?? 0);
        if (!$candidateId) {
            $_SESSION['error'] = 'Invalid candidate ID.';
            $this->redirect('/Talent-HUB/recruiter/candidates');
        }

        $candidate = $this->userRepository->findById($candidateId);
        if (!$candidate || $candidate['role'] !== 'candidate') {
            $_SESSION['error'] = 'Candidate not found.';
            $this->redirect('/Talent-HUB/recruiter/candidates');
        }

        if ($this->userRepository->delete($candidateId)) {
            $_SESSION['success'] = 'Candidate deleted successfully.';
        } else {
            $_SESSION['error'] = 'Failed to delete candidate.';
        }

        $this->redirect('/Talent-HUB/recruiter/candidates');
    }

    public function company()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
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
            $this->redirect('/Talent-HUB/login');
        }

        $this->view('recruiter/settings', [
            'user' => $user,
            'page_title' => 'Settings - TalentHub'
        ]);
    }

    public function createCompanyForm()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        // Check if company already exists
        $company = $this->companyRepository->findByUser($user['id']);
        if ($company) {
            $this->redirect('/Talent-HUB/recruiter/company');
        }

        $this->view('recruiter/create_company', [
            'user' => $user,
            'page_title' => 'Create Company - TalentHub'
        ]);
    }

    public function createCompany()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Talent-HUB/recruiter/company/create');
        }

        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $name = trim($_POST['name'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (empty($name) || empty($email)) {
            $_SESSION['error'] = 'Name and email are required.';
            $this->redirect('/Talent-HUB/recruiter/company/create');
        }

        $created = $this->companyRepository->create($user['id'], [
            'name' => $name,
            'address' => $address,
            'email' => $email
        ]);

        if ($created) {
            $_SESSION['success'] = 'Company created successfully.';
            $this->redirect('/Talent-HUB/recruiter/company');
        } else {
            $_SESSION['error'] = 'Failed to create company.';
            $this->redirect('/Talent-HUB/recruiter/company/create');
        }
    }

    public function createJobForm()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        // Temporary: ensure role is set for recruiter
        if (empty($_SESSION['role'])) {
            $_SESSION['role'] = 'recruiter';
        }

        $categories = $this->categoryRepository->getCategories();
        $tags = $this->tagRepository->getAll();

        $this->view('recruiter/create_job', [
            'user' => $user,
            'categories' => $categories,
            'tags' => $tags,
            'page_title' => 'Create Job Posting - TalentHub'
        ]);
    }

    public function createJob()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Talent-HUB/recruiter/jobs/create');
        }

        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $salary = (float)($_POST['salary'] ?? 0);
        $category_id = (int)($_POST['category_id'] ?? 0);
        $tags = $_POST['tags'] ?? []; // Assume array of tag IDs

        if (empty($title) || empty($description) || !$category_id) {
            $_SESSION['error'] = 'All fields are required.';
            $this->redirect('/Talent-HUB/recruiter/jobs/create');
        }

        // Ensure company exists
        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            $this->companyRepository->create($user['id'], [
                'name' => $user['fullname'] . ' Company',
                'address' => '',
                'email' => $user['email']
            ]);
            $company = $this->companyRepository->findByUser($user['id']);
        }

        $jobId = $this->jobRepository->create([
            'title' => $title,
            'description' => $description,
            'salary' => $salary,
            'company' => $company['id'], // Use company id, not user id
            'category' => $category_id
        ]);

        if ($jobId) {
            // Add tags
            $this->jobRepository->associateTags($jobId, array_map('intval', $tags));
            $_SESSION['success'] = 'Job created successfully.';
            $this->redirect('/Talent-HUB/recruiter/jobs');
        } else {
            $_SESSION['error'] = 'Failed to create job.';
            $this->redirect('/Talent-HUB/recruiter/jobs/create');
        }
    }

    public function editJobForm()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $jobId = (int)($_GET['id'] ?? 0);
        if (!$jobId) {
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        // Get user's company
        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            // Create company if not exists
            $this->companyRepository->create($user['id'], [
                'name' => $user['fullname'] . ' Company',
                'address' => '',
                'email' => $user['email']
            ]);
            $company = $this->companyRepository->findByUser($user['id']);
            if (!$company) {
                $_SESSION['error'] = 'Failed to create company.';
                $this->redirect('/Talent-HUB/recruiter/dashboard');
            }
        }

        // Get job and check ownership
        $job = $this->jobRepository->findById($jobId);
        if (!$job || $job[0]['company_id'] != $company['id']) {
            $_SESSION['error'] = 'Job not found.';
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        $job = $job[0];
        $categories = $this->categoryRepository->findAll();
        $tags = $this->tagRepository->findAll();
        $jobTags = $this->jobRepository->getTags($jobId);

        $this->view('recruiter/edit_job', [
            'user' => $user,
            'job' => $job,
            'categories' => $categories,
            'tags' => $tags,
            'jobTags' => array_column($jobTags, 'id'),
            'page_title' => 'Edit Job Posting - TalentHub'
        ]);
    }

    public function editJob()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $jobId = (int)($_POST['job_id'] ?? 0);
        if (!$jobId) {
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        // Get user's company
        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            $_SESSION['error'] = 'Company not found.';
            $this->redirect('/Talent-HUB/recruiter/dashboard');
        }

        // Get job and check ownership
        $job = $this->jobRepository->findById($jobId);
        if (!$job || $job[0]['company_id'] != $company['id']) {
            $_SESSION['error'] = 'Job not found.';
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $salary = (float)($_POST['salary'] ?? 0);
        $category_id = (int)($_POST['category_id'] ?? 0);
        $tags = $_POST['tags'] ?? [];

        if (empty($title) || empty($description) || !$category_id) {
            $_SESSION['error'] = 'All fields are required.';
            $this->redirect('/Talent-HUB/recruiter/jobs/edit?id=' . $jobId);
        }

        $updated = $this->jobRepository->update($jobId, [
            'title' => $title,
            'description' => $description,
            'salary' => $salary,
            'category' => $category_id
        ]);

        if ($updated) {
            // Update tags
            $this->jobRepository->associateTags($jobId, array_map('intval', $tags));
            $_SESSION['success'] = 'Job updated successfully.';
        } else {
            $_SESSION['error'] = 'Failed to update job.';
        }

        $this->redirect('/Talent-HUB/recruiter/jobs');
    }

    public function deleteJob()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $jobId = (int)($_GET['id'] ?? 0);
        if (!$jobId) {
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        // Get user's company
        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            // Create company if not exists
            $this->companyRepository->create($user['id'], [
                'name' => $user['fullname'] . ' Company',
                'address' => '',
                'email' => $user['email']
            ]);
            $company = $this->companyRepository->findByUser($user['id']);
            if (!$company) {
                $_SESSION['error'] = 'Failed to create company.';
                $this->redirect('/Talent-HUB/recruiter/dashboard');
            }
        }

        // Get job and check ownership
        $job = $this->jobRepository->findById($jobId);
        if (!$job || $job[0]['company_id'] != $company['id']) {
            $_SESSION['error'] = 'Job not found.';
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        if ($this->jobRepository->softDelete($jobId)) {
            $_SESSION['success'] = 'Job deleted successfully.';
        } else {
            $_SESSION['error'] = 'Failed to delete job.';
        }

        $this->redirect('/Talent-HUB/recruiter/jobs');
    }

    public function applications()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $jobId = (int)($_GET['job_id'] ?? 0);
        if (!$jobId) {
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        // Get user's company
        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            // Create company if not exists
            $this->companyRepository->create($user['id'], [
                'name' => $user['fullname'] . ' Company',
                'address' => '',
                'email' => $user['email']
            ]);
            $company = $this->companyRepository->findByUser($user['id']);
            if (!$company) {
                $_SESSION['error'] = 'Failed to create company.';
                $this->redirect('/Talent-HUB/recruiter/dashboard');
            }
        }

        // Check if job belongs to user
        $job = $this->jobRepository->findById($jobId);
        if (!$job || $job[0]['company_id'] != $company['id']) {
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        $job = $job[0];
        $applications = $this->applicationRepository->findByJobOffer($jobId);

        $this->view('recruiter/applications', [
            'user' => $user,
            'job' => $job,
            'applications' => $applications,
            'page_title' => 'Applications for ' . $job['title']
        ]);
    }

    public function updateApplicationStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Talent-HUB/recruiter/dashboard');
        }

        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $applicationId = (int)($_POST['application_id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        
        if (!$applicationId || !in_array($status, ['accepted', 'rejected', 'interview'])) {
            $_SESSION['error'] = 'Invalid request.';
            $this->redirect('/Talent-HUB/recruiter/dashboard');
        }

        // Get user's company
        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            $_SESSION['error'] = 'Company not found.';
            $this->redirect('/Talent-HUB/recruiter/dashboard');
        }

        // Get application and verify ownership
        $application = $this->applicationRepository->findById($applicationId);
        if (!$application) {
            $_SESSION['error'] = 'Application not found.';
            $this->redirect('/Talent-HUB/recruiter/dashboard');
        }

        // Verify the job belongs to this recruiter's company
        $job = $this->jobRepository->findById($application['job_offer_id']);
        if (!$job || (isset($job[0]['company_id']) && $job[0]['company_id'] != $company['id'])) {
            $_SESSION['error'] = 'Access denied.';
            $this->redirect('/Talent-HUB/recruiter/dashboard');
        }

        // Update application status and redirect back to applications page
        if ($this->applicationRepository->updateStatus($applicationId, $status)) {
            $_SESSION['success'] = 'Application status updated successfully.';
        } else {
            $_SESSION['error'] = 'Failed to update application status.';
        }

        // Redirect back to the applications page for this job
        $this->redirect('/Talent-HUB/recruiter/applications?job_id=' . $application['job_offer_id']);
    }
}
