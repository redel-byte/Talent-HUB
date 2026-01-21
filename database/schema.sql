-- Talent-HUB Database Schema
-- Job Recruitment Platform

-- Roles Table
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_role_name (name)
);

-- Insert default roles
INSERT INTO roles (name) VALUES 
('admin'),
('recruiter'),
('candidate')
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    role_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    archived_at DATETIME NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE RESTRICT,
    INDEX idx_user_email (email),
    INDEX idx_user_role (role_id),
    INDEX idx_user_archived (archived_at)
);

-- Categories Table (for job categories)
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    archived_at DATETIME NULL,
    INDEX idx_category_name (name)
);

-- Tags Table (for job tags/skills)
CREATE TABLE IF NOT EXISTS tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    color VARCHAR(7) DEFAULT '#007bff', -- Hex color code
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_tag_name (name)
);

-- Job Offers Table
CREATE TABLE IF NOT EXISTS job_offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT,
    salary_min DECIMAL(10,2),
    salary_max DECIMAL(10,2),
    location VARCHAR(255),
    work_type ENUM('remote', 'onsite', 'hybrid') DEFAULT 'onsite',
    experience_level ENUM('junior', 'mid', 'senior', 'expert') DEFAULT 'mid',
    category_id INT,
    recruiter_id INT NOT NULL,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    archived_at DATETIME NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (recruiter_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_job_title (title),
    INDEX idx_job_category (category_id),
    INDEX idx_job_recruiter (recruiter_id),
    INDEX idx_job_status (status),
    INDEX idx_job_archived (archived_at),
    FULLTEXT idx_job_search (title, description, requirements)
);

-- Job Offer Tags Junction Table
CREATE TABLE IF NOT EXISTS job_offer_tags (
    job_offer_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (job_offer_id, tag_id),
    FOREIGN KEY (job_offer_id) REFERENCES job_offers(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Applications Table
CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_offer_id INT NOT NULL,
    candidate_id INT NOT NULL,
    cover_letter TEXT,
    cv_path VARCHAR(500),
    status ENUM('pending', 'reviewed', 'accepted', 'rejected') DEFAULT 'pending',
    applied_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (job_offer_id) REFERENCES job_offers(id) ON DELETE CASCADE,
    FOREIGN KEY (candidate_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_application (job_offer_id, candidate_id),
    INDEX idx_application_job (job_offer_id),
    INDEX idx_application_candidate (candidate_id),
    INDEX idx_application_status (status)
);

-- Companies Table (for recruiter company information)
CREATE TABLE IF NOT EXISTS companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    website VARCHAR(255),
    industry VARCHAR(100),
    size ENUM('startup', 'small', 'medium', 'large', 'enterprise'),
    logo_path VARCHAR(500),
    founded_year YEAR,
    location VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    archived_at DATETIME NULL,
    INDEX idx_company_name (name),
    INDEX idx_company_industry (industry)
);

-- Company Users Junction Table (link recruiters to companies)
CREATE TABLE IF NOT EXISTS company_users (
    company_id INT NOT NULL,
    user_id INT NOT NULL,
    role ENUM('owner', 'admin', 'recruiter') DEFAULT 'recruiter',
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (company_id, user_id),
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- System Logs Table (for admin tracking)
CREATE TABLE IF NOT EXISTS system_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    action VARCHAR(100) NOT NULL,
    table_name VARCHAR(100),
    record_id INT,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_log_user (user_id),
    INDEX idx_log_action (action),
    INDEX idx_log_table (table_name),
    INDEX idx_log_created (created_at)
);

-- Create indexes for better performance
CREATE INDEX idx_job_salary_range ON job_offers(salary_min, salary_max);
CREATE INDEX idx_job_location ON job_offers(location);
CREATE INDEX idx_application_applied_at ON applications(applied_at);
