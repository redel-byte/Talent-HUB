<?php
require_once 'app/Middleware/Database.php';

$pdo = App\Middleware\Database::connection();

// Check applications count
$stmt = $pdo->query('SELECT COUNT(*) as count FROM applications');
$result = $stmt->fetch();
echo 'Applications count: ' . $result['count'] . PHP_EOL;

// Check if there are job offers
$stmt = $pdo->query('SELECT COUNT(*) as count FROM job_offers');
$result = $stmt->fetch();
echo 'Job offers count: ' . $result['count'] . PHP_EOL;

// Check if there are candidates
$stmt = $pdo->query('SELECT COUNT(*) as count FROM users u JOIN roles r ON u.role_id = r.id WHERE r.name = "candidate"');
$result = $stmt->fetch();
echo 'Candidates count: ' . $result['count'] . PHP_EOL;

// Show sample applications if any exist
$stmt = $pdo->query('SELECT a.*, u.fullname as candidate_name, jo.title as job_title FROM applications a JOIN users u ON a.candidate_id = u.id JOIN job_offers jo ON a.job_offer_id = jo.id LIMIT 5');
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($applications)) {
    echo "\nSample applications:\n";
    foreach ($applications as $app) {
        echo "- {$app['candidate_name']} applied for {$app['job_title']} (Status: {$app['status']})\n";
    }
} else {
    echo "\nNo applications found. Creating sample data...\n";
    
    // Create sample job offers if none exist
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM job_offers');
    $jobCount = $stmt->fetch()['count'];
    
    if ($jobCount == 0) {
        // Create sample companies first
        $pdo->exec("INSERT INTO companies (name, address, email) VALUES 
            ('Tech Solutions Inc', '123 Tech St, San Francisco, CA', 'hr@techsolutions.com'),
            ('Digital Marketing Agency', '456 Market St, New York, NY', 'jobs@digitalmarketing.com')");
        
        // Get company IDs
        $stmt = $pdo->query('SELECT id FROM companies LIMIT 2');
        $companies = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        // Get recruiter user IDs
        $stmt = $pdo->query('SELECT u.id FROM users u JOIN roles r ON u.role_id = r.id WHERE r.name = "recruiter" LIMIT 2');
        $recruiters = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        // Create sample job offers
        $pdo->exec("INSERT INTO job_offers (title, description, salary_min, salary_max, company_id, location, type, experience_level) VALUES 
            ('Senior PHP Developer', 'Looking for an experienced PHP developer to join our team.', 80000, 120000, {$companies[0]}, 'San Francisco, CA', 'Full-time', 'senior'),
            ('Frontend Developer', 'We need a creative frontend developer with React experience.', 70000, 100000, {$companies[1]}, 'New York, NY', 'Full-time', 'mid'),
            ('Full Stack Developer', 'Join our team as a full stack developer working on exciting projects.', 75000, 110000, {$companies[0]}, 'Remote', 'Full-time', 'mid')");
    }
    
    // Get candidate and job offer IDs
    $stmt = $pdo->query('SELECT u.id FROM users u JOIN roles r ON u.role_id = r.id WHERE r.name = "candidate" LIMIT 3');
    $candidates = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $stmt = $pdo->query('SELECT id FROM job_offers LIMIT 5');
    $jobs = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (!empty($candidates) && !empty($jobs)) {
        // Create sample applications
        $sampleApplications = [
            ['candidate_id' => $candidates[0], 'job_offer_id' => $jobs[0], 'status' => 'pending'],
            ['candidate_id' => $candidates[0], 'job_offer_id' => $jobs[1], 'status' => 'reviewed'],
            ['candidate_id' => $candidates[1], 'job_offer_id' => $jobs[2], 'status' => 'accepted'],
            ['candidate_id' => $candidates[2], 'job_offer_id' => $jobs[0], 'status' => 'rejected'],
        ];
        
        foreach ($sampleApplications as $app) {
            $pdo->prepare("INSERT INTO applications (candidate_id, job_offer_id, status, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())")
               ->execute([$app['candidate_id'], $app['job_offer_id'], $app['status']]);
        }
        
        echo "Sample applications created successfully!\n";
    }
}
?>
