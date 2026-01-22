<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repository\CompanyRepository;
use App\Repository\JobOfferRepository;
use App\Repository\CategorieRepository ;
use App\Repository\ApplicationRepository;

class RecruiterController extends Controller
{
    private CompanyRepository $companyRepository;
    private JobOfferRepository $jobRepository;
    private CategorieRepository $categoryRepository;
    private ApplicationRepository $applicationRepository;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->requireRole('recruiter');
        $this->companyRepository = new CompanyRepository(Database::connection());
        $this->jobRepository = new JobOfferRepository(Database::connection());
        $this->categoryRepository = new CategorieRepository(Database::connection());
        $this->applicationRepository = new ApplicationRepository(Database::connection());
    }

    public function dashboard()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $this->view('recruiter/dashboard', [
            'user' => $user,
            'page_title' => 'Recruiter Dashboard - TalentHub'
        ]);
    }

    public function jobs()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/Talent-HUB/login');
        }

        $jobs = $this->jobRepository->findByCompany($user['id']);

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

        $this->view('recruiter/candidates', [
            'user' => $user,
            'page_title' => 'View Candidates - TalentHub'
        ]);
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

        $company = $this->companyRepository->findByUser($user['id']);
        if (!$company) {
            $_SESSION['error'] = 'Please create a company first.';
            $this->redirect('/Talent-HUB/recruiter/company/create');
        }

        $categories = $this->categoryRepository->getCategories();

        $this->view('recruiter/create_job', [
            'user' => $user,
            'categories' => $categories,
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

        if (empty($title) || empty($description) || !$category_id) {
            $_SESSION['error'] = 'All fields are required.';
            $this->redirect('/Talent-HUB/recruiter/jobs/create');
        }

        $created = $this->jobRepository->create([
            'title' => $title,
            'description' => $description,
            'salary' => $salary,
            'company' => $user['id'],
            'category' => $category_id
        ]);

        if ($created) {
            $_SESSION['success'] = 'Job created successfully.';
            $this->redirect('/Talent-HUB/recruiter/jobs');
        } else {
            $_SESSION['error'] = 'Failed to create job.';
            $this->redirect('/Talent-HUB/recruiter/jobs/create');
        }
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

        // Check if job belongs to user
        $job = $this->jobRepository->findById($jobId);
        if (!$job || $job['company_id'] != $user['id']) {
            $this->redirect('/Talent-HUB/recruiter/jobs');
        }

        $applications = $this->applicationRepository->findByJobOffer($jobId);

        $this->view('recruiter/applications', [
            'user' => $user,
            'job' => $job,
            'applications' => $applications,
            'page_title' => 'Applications for ' . $job['title']
        ]);
    }
}
