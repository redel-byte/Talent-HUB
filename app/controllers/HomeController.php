<?php

namespace App\Controllers;

use App\Middleware\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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
        // Find jobs page for candidates
        $this->view('find_jobs_template', [
            'page_title' => 'Find Jobs - TalentHub'
        ]);
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
}
