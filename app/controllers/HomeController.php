<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Repositories\JobOfferRepository;
use PDO;

class HomeController extends Controller
{
    private JobOfferRepository $jobOfferRepository;
    
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->jobOfferRepository = new JobOfferRepository(\App\Middleware\Database::connection());
    }

    public function index()
    {
        // This is the main home page
        $this->view('home_template', [
            'page_title' => 'TalentHub - Find Your Dream Job or Perfect Talent'
        ]);
    }

    public function findTalent()
    {
        // Find talent page for employers
        $this->view('find_talent_template', [
            'page_title' => 'Find Talent - TalentHub'
        ]);
    }

    public function findJobs()
    {
        // Get search filters from GET parameters - only include non-empty values
        $filters = [];
        
        if (!empty($_GET['search'])) {
            $filters['search'] = $_GET['search'];
        }
        
        if (!empty($_GET['category'])) {
            $filters['category'] = $_GET['category'];
        }
        
        if (!empty($_GET['min_salary']) && is_numeric($_GET['min_salary'])) {
            $filters['min_salary'] = $_GET['min_salary'];
        }
        
        // Fetch jobs from database
        if (!empty($filters)) {
            error_log("HomeController calling searchJobs with filters: " . json_encode($filters));
            $jobs = $this->jobOfferRepository->searchJobs($filters);
        } else {
            $jobs = $this->jobOfferRepository->getAllActiveJobs();
        }
        
        // Get user info if logged in
        $user = $this->getCurrentUser();
        
        // Check which jobs the user has already applied for
        $appliedJobs = [];
        if ($user && $user['role'] === 'candidate') {
            $stmt = \App\Middleware\Database::connection()->prepare(
                "SELECT job_offer_id FROM applications WHERE candidate_id = ?"
            );
            $stmt->execute([$user['id']]);
            $appliedJobs = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        
        // Use different views based on user role
        if ($user && $user['role'] === 'candidate') {
            // Use candidate layout with candidate-specific view
            $this->view('candidate/find_jobs', [
                'page_title' => 'Find Jobs - TalentHub',
                'jobs' => $jobs,
                'filters' => $filters,
                'user' => $user,
                'appliedJobs' => $appliedJobs
            ]);
        } else {
            // Use public layout with template view
            $this->view('find_jobs_template', [
                'page_title' => 'Find Jobs - TalentHub',
                'jobs' => $jobs,
                'filters' => $filters,
                'user' => $user,
                'appliedJobs' => $appliedJobs
            ]);
        }
    }

    public function pricing()
    {
        // Pricing page for all plans
        $this->view('pricing_template', [
            'page_title' => 'Pricing Plans - TalentHub'
        ]);
    }

    public function blog()
    {
        // Blog page with articles and insights
        $this->view('blog_template', [
            'page_title' => 'Blog - TalentHub Insights'
        ]);
    }

    public function howItWorks()
    {
        // How it works page explaining the platform
        $this->view('how_it_works_template', [
            'page_title' => 'How It Works - TalentHub'
        ]);
    }

    public function about()
    {
        // About us page
        $this->view('about_template', [
            'page_title' => 'About Us - TalentHub'
        ]);
    }

    public function contact()
    {
        // Contact page
        $this->view('contact_template', [
            'page_title' => 'Contact Us - TalentHub'
        ]);
    }

    public function privacy()
    {
        // Privacy policy page
        $this->view('privacy_template', [
            'page_title' => 'Privacy Policy - TalentHub'
        ]);
    }

    public function terms()
    {
        // Terms of service page
        $this->view('terms_template', [
            'page_title' => 'Terms of Service - TalentHub'
        ]);
    }
}
