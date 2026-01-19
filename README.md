# Talent HUB – Job Recruitment Platform (MVC PHP)

##  Project Overview
**Talent HUB** is a job recruitment platform designed to connect **candidates**, **recruiters**, and **administrators** through a secure and scalable web application.

The project is built **from scratch** using **PHP 8 (OOP)** following the **MVC architecture**, without relying on any framework, with a strong focus on **security**, **maintainability**, and **clean architecture**.

This project starts with a reusable authentication foundation and can later be extended into a full-featured recruitment platform.

---

##  Learning Objectives
- Adopt **MVC architecture** to clearly separate concerns.
- Implement the **Repository Pattern** to isolate data access logic.
- Secure database interactions using **PDO with prepared statements**.
- Build a **multi-role authentication system** (Admin / Recruiter / Candidate).
- Properly manage **sessions and cookies**.
- Implement **soft delete (archiving)** instead of hard deletion.
- Use **AJAX** for dynamic client-side interactions.
- Securely handle **file uploads** (CVs, images).
- Apply security best practices (SQL Injection, XSS, CSRF).

---

##  Technical Stack
- **Language**: PHP 8 (Object-Oriented)
- **Architecture**: MVC (without framework)
- **Database**: MySQL
- **Database Access**: PDO + Prepared Statements
- **Frontend**: HTML5, CSS, JavaScript (Vanilla + AJAX)
- **Version Control**: Git & GitHub
- **Project Management**: Jira (Scrum Board)

---

##  User Roles
### 1. Administrator
- Manage categories and tags
- Moderate and archive job offers (soft delete)
- View platform statistics
- Manage user roles

### 2. Recruiter
- Register as a company
- Create, update, archive job offers
- View and manage applications

### 3. Candidate
- Browse job offers
- View job details
- Apply for jobs
- Upload CV securely
- View recommended jobs (optional)

---

##  Core Features

###  Authentication & Authorization
- User registration (Candidate / Recruiter)
- Secure login & logout
- Password hashing
- Role-based redirection
- Protected routes with middleware
- Clear **403 Forbidden** access handling

###  Back Office (Admin & Recruiter)
- Categories CRUD
- Tags CRUD
- Job offers CRUD
- Soft delete (archive & restore)
- Admin dashboard with statistics

###  Front Office (Candidates)
- Job listing and details
- Secure job application
- CV upload
- Recommended jobs (based on skills & salary expectations)

###  Technical Features
- Repository Pattern for all database queries
- AJAX-powered search and filters (optional)
- Secure file upload system
- Clean and maintainable code structure

---

##  Project Structure
talent-hub/
│
├── app/
│ ├── Controllers/
│ ├── Models/
│ ├── Repositories/
│ ├── Middlewares/
│ └── Views/
│
├── config/
│ └── database.php
│
├── public/
│ ├── index.php
│ ├── assets/
│ └── uploads/
│
├── routes/
│ └── web.php
│
├── database/
│ └── schema.sql
│
├── docs/
│ ├── UML/
│ └── presentation/
│
└── README.md

