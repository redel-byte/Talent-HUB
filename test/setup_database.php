<?php
/**
 * Database Setup Script
 * Run this script to populate the database with sample data for testing
 */

// Include Composer autoloader and database connection
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Middleware/Database.php';

try {
    $pdo = \App\Middleware\Database::connection();
    
    echo "Connected to database successfully!\n";
    
    // Check if tables exist
    $tables = ['users', 'roles', 'job_offers', 'applications', 'saved_jobs'];
    foreach ($tables as $table) {
        $query = "SHOW TABLES LIKE " . $pdo->quote($table);
        $stmt = $pdo->query($query);
        if ($stmt && $stmt->rowCount() > 0) {
            echo "✓ Table '$table' exists\n";
        } else {
            echo "✗ Table '$table' missing\n";
        }
    }

    // Ensure saved_jobs table exists (create minimal compatible schema if missing)
    $stmt = $pdo->query("SHOW TABLES LIKE 'saved_jobs'");
    if (!$stmt || $stmt->rowCount() === 0) {
        echo "Creating saved_jobs table...\n";
        $createSql = "CREATE TABLE IF NOT EXISTS saved_jobs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            candidate_id INT NOT NULL,
            job_offer_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY unique_candidate_job (candidate_id, job_offer_id),
            INDEX idx_saved_jobs_candidate (candidate_id),
            INDEX idx_saved_jobs_job (job_offer_id),
            INDEX idx_saved_jobs_created (created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $pdo->exec($createSql);
            echo "✓ saved_jobs table created\n";
        } catch (Exception $e) {
            echo "Failed creating saved_jobs: " . $e->getMessage() . "\n";
        }
    }
    
    // Insert sample roles
    echo "\nInserting sample roles...\n";
    $stmt = $pdo->prepare("INSERT IGNORE INTO roles (id, name) VALUES (?, ?)");
    $stmt->execute([1, 'candidate']);
    $stmt->execute([2, 'recruiter']); 
    $stmt->execute([3, 'admin']);
    echo "✓ Roles inserted\n";
    
    // Ensure required user columns exist for sample data (add if missing)
    $requiredUserCols = [
        'location' => 'VARCHAR(255) NULL',
        'summary' => 'TEXT NULL',
        'experience_level' => "VARCHAR(50) NULL",
        'expected_salary' => "VARCHAR(50) NULL",
        'skills' => 'TEXT NULL',
        'resume_path' => 'VARCHAR(255) NULL'
    ];

    foreach ($requiredUserCols as $col => $definition) {
        $colCheck = $pdo->prepare("SELECT COUNT(*) as cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = :schema AND TABLE_NAME = 'users' AND COLUMN_NAME = :col");
        $colCheck->execute(['schema' => $_ENV['DBNAME'], 'col' => $col]);
        $res = $colCheck->fetch(PDO::FETCH_ASSOC);
        if (!$res || (int)$res['cnt'] === 0) {
            try {
                $pdo->exec("ALTER TABLE users ADD COLUMN $col $definition");
                echo "Added column users.$col\n";
            } catch (Exception $e) {
                echo "Failed adding column users.$col: " . $e->getMessage() . "\n";
            }
        }
    }

    // Insert sample users
    echo "\nInserting sample users...\n";
    $passwordHash = password_hash('password123', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT IGNORE INTO users (id, fullname, email, password, role_id, phone_number, location, summary, experience_level, expected_salary, skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Candidate user
    $stmt->execute([1, 'John Doe', 'john.doe@example.com', $passwordHash, 1, '+1234567890', 'New York, NY', 'Experienced software developer looking for new opportunities', 'mid', '$80,000-$100,000', 'PHP, JavaScript, React, MySQL, Git']);
    
    // Recruiter user  
    $stmt->execute([2, 'Jane Smith', 'jane.smith@techcorp.com', $passwordHash, 2, '+1234567891', 'San Francisco, CA', 'HR Manager at TechCorp', 'senior', '$120,000-$150,000', 'Recruitment, HR Management, Team Building']);
    
    // Admin user
    $stmt->execute([3, 'Admin User', 'admin@talenthub.com', $passwordHash, 3, '+1234567892', 'Remote', 'System Administrator', 'expert', '$100,000-$120,000', 'System Administration, Database Management']);
    
    echo "✓ Users inserted\n";

    // Ensure companies table exists and add a sample company for job offers
    $stmt = $pdo->query("SHOW TABLES LIKE 'companies'");
    if (!$stmt || $stmt->rowCount() === 0) {
        echo "Creating companies table...\n";
        $createCompanies = "CREATE TABLE IF NOT EXISTS companies (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NULL,
            name VARCHAR(100) NOT NULL,
            address VARCHAR(255) NULL,
            email VARCHAR(255) NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        try {
            $pdo->exec($createCompanies);
            echo "✓ companies table created\n";
        } catch (Exception $e) {
            echo "Failed creating companies: " . $e->getMessage() . "\n";
        }
    }

    // Insert a sample company record matching the sample recruiter user (id=2)
    try {
        $stmt = $pdo->prepare("INSERT IGNORE INTO companies (id, user_id, name, address, email, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([2, 2, 'TechCorp', 'San Francisco, CA', 'contact@techcorp.com', date('Y-m-d H:i:s')]);
        echo "✓ Sample company inserted\n";
    } catch (Exception $e) {
        echo "Failed inserting sample company: " . $e->getMessage() . "\n";
    }

    // Ensure required job_offers columns exist for sample data (add if missing)
    $requiredJobCols = [
        'salary_min' => 'DECIMAL(10,2) NULL',
        'salary_max' => 'DECIMAL(10,2) NULL',
        'location' => 'VARCHAR(255) NULL',
        'type' => "VARCHAR(50) NULL",
        'experience_level' => "VARCHAR(50) NULL"
    ];

    foreach ($requiredJobCols as $col => $definition) {
        $colCheck = $pdo->prepare("SELECT COUNT(*) as cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = :schema AND TABLE_NAME = 'job_offers' AND COLUMN_NAME = :col");
        $colCheck->execute(['schema' => $_ENV['DBNAME'], 'col' => $col]);
        $res = $colCheck->fetch(PDO::FETCH_ASSOC);
        if (!$res || (int)$res['cnt'] === 0) {
            try {
                $pdo->exec("ALTER TABLE job_offers ADD COLUMN $col $definition");
                echo "Added column job_offers.$col\n";
            } catch (Exception $e) {
                echo "Failed adding column job_offers.$col: " . $e->getMessage() . "\n";
            }
        }
    }

    // Insert sample job offers
    echo "\nInserting sample job offers...\n";
    $stmt = $pdo->prepare("INSERT IGNORE INTO job_offers (id, title, description, salary, salary_min, salary_max, location, type, experience_level, company_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([1, 'React Developer', 'We are looking for an experienced React Developer to join our frontend team. You will work on building modern web applications using React, TypeScript, and other cutting-edge technologies.', 95000, 80000, 120000, 'Remote', 'full-time', 'mid', 2, date('Y-m-d H:i:s', strtotime('-30 days'))]);
    
    $stmt->execute([2, 'PHP Backend Developer', 'Join our backend team to develop robust server-side applications using PHP, Laravel, and MySQL. Experience with REST APIs and microservices architecture is required.', 85000, 70000, 100000, 'New York, NY', 'full-time', 'mid', 2, date('Y-m-d H:i:s', strtotime('-15 days'))]);
    
    $stmt->execute([3, 'DevOps Engineer', 'We need a DevOps Engineer to manage our cloud infrastructure, implement CI/CD pipelines, and ensure high availability of our services.', 110000, 90000, 130000, 'San Francisco, CA', 'full-time', 'senior', 2, date('Y-m-d H:i:s', strtotime('-7 days'))]);
    
    echo "✓ Job offers inserted\n";
    
    // Ensure required applications columns exist for sample data (add if missing)
    $requiredAppCols = [
        'updated_at' => 'DATETIME NULL',
        'status_details' => 'TEXT NULL',
        'recruiter_notes' => 'TEXT NULL'
    ];

    foreach ($requiredAppCols as $col => $definition) {
        $colCheck = $pdo->prepare("SELECT COUNT(*) as cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = :schema AND TABLE_NAME = 'applications' AND COLUMN_NAME = :col");
        $colCheck->execute(['schema' => $_ENV['DBNAME'], 'col' => $col]);
        $res = $colCheck->fetch(PDO::FETCH_ASSOC);
        if (!$res || (int)$res['cnt'] === 0) {
            try {
                $pdo->exec("ALTER TABLE applications ADD COLUMN $col $definition");
                echo "Added column applications.$col\n";
            } catch (Exception $e) {
                echo "Failed adding column applications.$col: " . $e->getMessage() . "\n";
            }
        }
    }

    // Insert sample applications
    echo "\nInserting sample applications...\n";
    $stmt = $pdo->prepare("INSERT IGNORE INTO applications (candidate_id, job_offer_id, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
    
    $stmt->execute([1, 1, 'pending', date('Y-m-d H:i:s', strtotime('-5 days')), date('Y-m-d H:i:s', strtotime('-5 days'))]);
    $stmt->execute([1, 2, 'reviewed', date('Y-m-d H:i:s', strtotime('-10 days')), date('Y-m-d H:i:s', strtotime('-8 days'))]);
    $stmt->execute([1, 3, 'accepted', date('Y-m-d H:i:s', strtotime('-3 days')), date('Y-m-d H:i:s', strtotime('-2 days'))]);
    
    echo "✓ Applications inserted\n";
    
    // Insert sample saved jobs
    echo "\nInserting sample saved jobs...\n";
    $stmt = $pdo->prepare("INSERT IGNORE INTO saved_jobs (candidate_id, job_offer_id, created_at) VALUES (?, ?, ?)");
    
    $stmt->execute([1, 1, date('Y-m-d H:i:s', strtotime('-1 day'))]);
    $stmt->execute([1, 2, date('Y-m-d H:i:s', strtotime('-2 days'))]);
    
    echo "✓ Saved jobs inserted\n";
    
    echo "\n🎉 Database setup complete!\n";
    echo "\nYou can now login with:\n";
    echo "Candidate: john.doe@example.com / password123\n";
    echo "Recruiter: jane.smith@techcorp.com / password123\n";
    echo "Admin: admin@talenthub.com / password123\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Please check your database configuration in app/Middleware/Database.php\n";
}
