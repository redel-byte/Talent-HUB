# Talent HUB – Job Recruitment Platform (MVC PHP)

## 🚀 Project Overview
**Talent HUB** is a modern job recruitment platform designed to connect **candidates**, **recruiters**, and **administrators** through a secure and scalable web application.

Built **from scratch** using **PHP 8 (OOP)** following **MVC architecture** with **Repository Pattern** and **Service Layer**, without relying on any framework, with a strong focus on **security**, **maintainability**, and **clean architecture**.

---

## 🎯 Learning Objectives
- ✅ **MVC architecture** with clear separation of concerns
- ✅ **Repository Pattern** to isolate data access logic
- ✅ **Service Layer** for business logic separation
- ✅ **PDO with prepared statements** for secure database interactions
- ✅ **Multi-role authentication system** (Admin / Recruiter / Candidate)
- ✅ **Session and cookie management**
- ✅ **Soft delete (archiving)** instead of hard deletion
- ✅ **AJAX** for dynamic client-side interactions
- ✅ **Secure file uploads** (CVs, images)
- ✅ **Security best practices** (SQL Injection, XSS, CSRF)

---

## 🛠️ Technical Stack
- **Language**: PHP 8 (Object-Oriented)
- **Architecture**: MVC + Repository Pattern + Service Layer
- **Database**: MySQL with comprehensive schema
- **Database Access**: PDO + Prepared Statements
- **Frontend**: HTML5, CSS, JavaScript (Vanilla + AJAX)
- **Version Control**: Git & GitHub
- **Project Management**: Jira (Scrum Board)

---

## 👥 User Roles & Features

### 🔧 Administrator
- Manage categories and tags
- Moderate and archive job offers (soft delete)
- View platform statistics and analytics
- Manage user roles and permissions
- System logging and monitoring

### 👔 Recruiter
- Register as a company representative
- Create, update, archive job offers
- View and manage candidate applications
- Company profile management
- Advanced candidate search and filtering

### 👨‍💼 Candidate
- Browse and search job offers
- View detailed job information
- Apply for jobs with CV upload
- Track application status
- Receive job recommendations based on profile

---

## 🏗️ Project Structure

```
talent-hub/
│
├── app/
│ ├── Controllers/          # HTTP Request Handlers
│ │ ├── AuthController.php
│ │ ├── HomeController.php
│ │ ├── CandidateController.php
│ │ ├── RecruiterController.php
│ │ └── AdminController.php
│ │
│ ├── Models/             # Data Models (Legacy)
│ │ └── User.php
│ │
│ ├── Repositories/       # Data Access Layer
│ │ ├── RepositoryInterface.php
│ │ ├── BaseRepository.php
│ │ ├── UserRepository.php
│ │ └── RoleRepository.php
│ │
│ ├── Services/           # Business Logic Layer
│ │ └── AuthService.php
│ │
│ ├── Middleware/         # HTTP Middleware
│ │ ├── AuthMiddleware.php
│ │ ├── CSRFProtection.php
│ │ ├── Security.php
│ │ ├── Validator.php
│ │ └── Hashpassword.php
│ │
│ └── Views/             # Presentation Layer
│ ├── auth/
│ ├── candidate/
│ ├── recruiter/
│ ├── admin/
│ └── errors/
│
├── config/              # Configuration Files
│ └── database.php
│
├── routes/              # Route Definitions
│ └── web.php
│
├── database/           # Database Schema
│ └── schema.sql
│
├── public/             # Web Root
│ ├── index.php
│ ├── assets/          # Static Assets (CSS, JS, Images)
│ └── uploads/        # User Uploads (CVs, Avatars)
│
├── docs/              # Documentation
│ ├── UML/            # Architecture Diagrams
│ └── presentation/    # Project Presentations
│
├── storage/           # Application Storage
│ └── logs/           # Log Files
│
├── vendor/            # Composer Dependencies
├── .env              # Environment Variables
├── .gitignore        # Git Ignore Rules
├── composer.json      # PHP Dependencies
└── README.md         # This File
```

---

## 🔐 Security Features

### Authentication & Authorization
- ✅ Role-based user registration (Candidate / Recruiter)
- ✅ Secure login & logout with session management
- ✅ Password hashing with PHP's password_hash()
- ✅ Role-based redirection and access control
- ✅ Protected routes with middleware
- ✅ CSRF token protection for all forms
- ✅ Proper 403 Forbidden handling

### Data Protection
- ✅ SQL Injection prevention with prepared statements
- ✅ XSS prevention with output escaping
- ✅ Input sanitization and validation
- ✅ Secure file upload handling
- ✅ Rate limiting considerations

---

## 📊 Database Schema

### Core Tables
- **users** - User accounts with role assignments
- **roles** - System roles (admin, recruiter, candidate)
- **categories** - Job categories
- **tags** - Skills and job tags
- **job_offers** - Job postings with full-text search
- **applications** - Job applications with status tracking
- **companies** - Company information
- **system_logs** - Audit trail and activity logs

### Key Features
- **Soft Delete** - All major tables support archiving
- **Foreign Key Constraints** - Data integrity
- **Indexes** - Optimized for performance
- **Full-Text Search** - Advanced job search capabilities

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.0+
- MySQL 5.7+ or MariaDB 10.2+
- Composer
- Web Server (Apache/Nginx)

### Installation

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd talent-hub
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

4. **Database Setup**
   ```bash
   # Import the schema
   mysql -u username -p database_name < database/schema.sql
   ```

5. **Web Server Configuration**
   - Set document root to `public/` directory
   - Configure URL rewriting for clean URLs
   - Ensure proper file permissions for `uploads/` and `storage/`

---

## 🎯 Next Development Steps

### Phase 1: Core Features ✅
- [x] User authentication system
- [x] Role-based access control
- [x] Repository pattern implementation
- [x] Service layer separation
- [x] Database schema design

### Phase 2: Job Management 🚧
- [ ] Job offer CRUD operations
- [ ] Category and tag management
- [ ] Job search and filtering
- [ ] Application system

### Phase 3: Advanced Features 📋
- [ ] File upload system (CVs, avatars)
- [ ] Company profiles
- [ ] Advanced search with AJAX
- [ ] Email notifications
- [ ] Admin dashboard with analytics

### Phase 4: Enhancement 🎨
- [ ] UI/UX improvements
- [ ] Mobile responsiveness
- [ ] Performance optimization
- [ ] Testing suite
- [ ] API endpoints

---

## 📝 Code Standards

### Architecture Patterns
- **MVC** for request handling
- **Repository Pattern** for data access
- **Service Layer** for business logic
- **Dependency Injection** for loose coupling

### Coding Guidelines
- PSR-4 autoloading
- PHP 8 type hints and return types
- Comprehensive error handling
- Input validation and sanitization
- Security-first approach

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👥 Team

- **Project Lead**: [Your Name]
- **Architecture**: MVC + Repository Pattern
- **Database Design**: Relational with soft deletes
- **Security**: OWASP best practices

---

## 📞 Support

For questions and support:
- Create an issue in the repository
- Check the documentation in `/docs`
- Review the database schema in `/database`

---

**Built with ❤️ for the developer community**
