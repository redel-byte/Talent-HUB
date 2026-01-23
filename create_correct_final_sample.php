<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=talent_hub;charset=utf8mb4', 'root', '');

try {
    echo "Setting up sample data correctly...\n";
    
    // Disable foreign key checks temporarily
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    
    // Clear existing data (except roles)
    $pdo->exec("DELETE FROM job_offer_tags");
    $pdo->exec("DELETE FROM applications");
    $pdo->exec("DELETE FROM job_offers");
    $pdo->exec("DELETE FROM company");
    $pdo->exec("DELETE FROM users");
    $pdo->exec("DELETE FROM tags");
    echo "Cleared existing data\n";
    
    // Re-enable foreign key checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    
    // Get existing role IDs
    $stmt = $pdo->query('SELECT id, name FROM roles');
    $roles = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $roles[$row['name']] = $row['id'];
    }
    echo "Found role IDs: " . json_encode($roles) . "\n";
    
    // Create sample users (recruiters first since companies depend on them)
    $pdo->exec("INSERT INTO users (fullname, email, password, phone_number, role_id, created_at) VALUES 
        ('John Admin', 'admin@talenthub.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1234567890', {$roles['admin']}, NOW()),
        ('Jane Recruiter', 'jane@techsolutions.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0987654321', {$roles['recruiter']}, NOW()),
        ('Bob Recruiter', 'bob@digitalmarketing.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5555555555', {$roles['recruiter']}, NOW()),
        ('Alice Candidate', 'alice@email.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1111111111', {$roles['candidate']}, NOW()),
        ('Charlie Candidate', 'charlie@email.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2222222222', {$roles['candidate']}, NOW()),
        ('Diana Candidate', 'diana@email.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3333333333', {$roles['candidate']}, NOW())");
    
    echo "Users created\n";
    
    // Get the recruiter user IDs to use as company IDs
    $stmt = $pdo->query('SELECT id FROM users WHERE role_id = ' . $roles['recruiter'] . ' ORDER BY id LIMIT 2');
    $recruiterIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Recruiter IDs for companies: " . json_encode($recruiterIds) . "\n";
    
    // Create companies using recruiter user IDs
    $pdo->exec("INSERT INTO company (id, name, address, email, created_at) VALUES 
        ({$recruiterIds[0]}, 'Tech Solutions Inc', '123 Tech St, San Francisco, CA', 'hr@techsolutions.com', NOW()),
        ({$recruiterIds[1]}, 'Digital Marketing Agency', '456 Market St, New York, NY', 'jobs@digitalmarketing.com', NOW())");
    
    echo "Companies created\n";
    
    // Create job offers
    $pdo->exec("INSERT INTO job_offers (title, description, salary, company_id, category_id, created_at) VALUES 
        ('Senior PHP Developer', 'Looking for an experienced PHP developer to join our team. Must have 5+ years of experience with Laravel and modern PHP frameworks.', 100000.00, {$recruiterIds[0]}, 1, NOW()),
        ('Frontend Developer', 'We need a creative frontend developer with React experience. Must be proficient in JavaScript, HTML5, and CSS3.', 85000.00, {$recruiterIds[1]}, 1, NOW()),
        ('Full Stack Developer', 'Join our team as a full stack developer working on exciting projects. Experience with both frontend and backend technologies required.', 92500.00, {$recruiterIds[0]}, 1, NOW()),
        ('Junior Developer', 'Entry-level position for motivated developers looking to grow their skills. Training provided.', 60000.00, {$recruiterIds[1]}, 1, NOW()),
        ('DevOps Engineer', 'Looking for a DevOps engineer with experience in cloud platforms, CI/CD, and infrastructure automation.', 110000.00, {$recruiterIds[0]}, 1, NOW())");
    
    echo "Job offers created\n";
    
    // Get candidate user IDs
    $stmt = $pdo->query('SELECT id FROM users WHERE role_id = ' . $roles['candidate'] . ' ORDER BY id LIMIT 3');
    $candidateIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Candidate IDs: " . json_encode($candidateIds) . "\n";
    
    // Create applications
    $pdo->exec("INSERT INTO applications (candidate_id, job_offer_id, status, created_at) VALUES 
        ({$candidateIds[0]}, 1, 'pending', NOW()),
        ({$candidateIds[0]}, 2, 'reviewed', NOW()),
        ({$candidateIds[1]}, 3, 'accepted', NOW()),
        ({$candidateIds[2]}, 4, 'rejected', NOW()),
        ({$candidateIds[0]}, 5, 'interview', NOW()),
        ({$candidateIds[1]}, 1, 'rejected', NOW()),
        ({$candidateIds[2]}, 2, 'pending', NOW())");
    
    echo "Applications created\n";
    
    // Create some tags
    $pdo->exec("INSERT INTO tags (name) VALUES 
        ('PHP'),
        ('JavaScript'),
        ('React'),
        ('Laravel'),
        ('MySQL'),
        ('Docker'),
        ('AWS'),
        ('Git')");
    
    echo "Tags created\n";
    
    // Link tags to job offers
    $pdo->exec("INSERT INTO job_offer_tags (job_offer_id, tag_id) VALUES 
        (1, 1), (1, 4), (1, 5), -- PHP, Laravel, MySQL
        (2, 2), (2, 3), -- JavaScript, React
        (3, 1), (3, 2), (3, 5), -- PHP, JavaScript, MySQL
        (4, 2), (4, 8), -- JavaScript, Git
        (5, 6), (5, 7), (5, 8) -- Docker, AWS, Git");
    
    echo "Job tags linked\n";
    
    echo "\nSample data setup complete!\n";
    
    // Show summary
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM applications');
    $apps = $stmt->fetch();
    echo "Total applications: {$apps['count']}\n";
    
    $stmt = $pdo->query('SELECT a.*, u.fullname as candidate_name, jo.title as job_title FROM applications a JOIN users u ON a.candidate_id = u.id JOIN job_offers jo ON a.job_offer_id = jo.id LIMIT 5');
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\nSample applications:\n";
    foreach ($applications as $app) {
        echo "- {$app['candidate_name']} applied for {$app['job_title']} (Status: {$app['status']})\n";
    }
    
    // Show candidate login info
    echo "\nCandidate login credentials:\n";
    echo "Email: alice@email.com (Password: password)\n";
    echo "Email: charlie@email.com (Password: password)\n";
    echo "Email: diana@email.com (Password: password)\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
?>
