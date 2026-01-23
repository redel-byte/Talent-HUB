<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=talent_hub;charset=utf8mb4', 'root', '');

echo "Checking applications table structure...\n";

// Check applications table structure
$stmt = $pdo->query('DESCRIBE applications');
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Applications table structure:\n";
foreach ($columns as $column) {
    echo "- {$column['Field']} ({$column['Type']}) {$column['Null']} {$column['Default']}\n";
}

// Create applications with cv_upload field
$pdo->exec("INSERT INTO applications (candidate_id, job_offer_id, status, cv_upload, created_at) VALUES 
    (35, 1, 'pending', 'resume_alice_1.pdf', NOW()),
    (35, 2, 'reviewed', 'resume_alice_2.pdf', NOW()),
    (36, 3, 'accepted', 'resume_charlie.pdf', NOW()),
    (37, 4, 'rejected', 'resume_diana.pdf', NOW()),
    (35, 5, 'interview', 'resume_alice_3.pdf', NOW()),
    (36, 1, 'rejected', 'resume_charlie_2.pdf', NOW()),
    (37, 2, 'pending', 'resume_diana_2.pdf', NOW())");

echo "Applications created with cv_upload field\n";

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

// Clean up
unlink('create_complete_sample_data.php');
unlink('check_applications_structure.php');
echo "Cleaned up temporary files\n";
?>
