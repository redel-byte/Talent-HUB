CREATE DATABASE talent_hub;
USE talent_hub;

-- Roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    role_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    archived_at DATETIME NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Recruiter Profile
CREATE TABLE recruiters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_name VARCHAR(100) NOT NULL,
    company_address VARCHAR(255),
    company_email VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Tags
CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Job Offers
CREATE TABLE job_offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    salary DECIMAL(10,2),
    recruiter_id INT NOT NULL,
    category_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    archived_at DATETIME NULL,
    FOREIGN KEY (recruiter_id) REFERENCES recruiters(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Offer <-> Tags (Many to Many)
CREATE TABLE job_offer_tags (
    job_offer_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (job_offer_id, tag_id),
    FOREIGN KEY (job_offer_id) REFERENCES job_offers(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

-- Applications
CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT NOT NULL,
    job_offer_id INT NOT NULL,
    cv_upload VARCHAR(255) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (candidate_id) REFERENCES users(id),
    FOREIGN KEY (job_offer_id) REFERENCES job_offers(id)
);
