<?php require_once __DIR__ . '/../recruiter/layout.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Job Postings</h2>
        <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
            <a href="/Talent-HUB/recruiter/jobs/create" class="text-white no-underline">Post New Job</a>
        </button>
    </div>
    
    <div class="space-y-4">
         <?php if (empty($jobs)): ?>
            <p class="text-gray-600">No job postings yet. <a href="/Talent-HUB/recruiter/jobs/create" class="text-blue-600">Create your first job</a>.</p>
        <?php else: ?>
            <?php foreach ($jobs as $job): ?>
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900"><?php echo htmlspecialchars($job['title']); ?></h3>
                            <p class="text-gray-600">Salary: $<?php echo number_format($job['salary'], 2); ?></p>
                            <p class="text-sm text-gray-500 mt-1">Posted on <?php echo date('M d, Y', strtotime($job['created_at'])); ?></p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="/Talent-HUB/recruiter/jobs/edit?id=<?php echo $job['id']; ?>" class="text-green-600 hover:text-green-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/Talent-HUB/recruiter/jobs/delete?id=<?php echo $job['id']; ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Delete this job?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">Applications: 0</span> • 
                            <span class="text-green-600">0 shortlisted</span>
                        </div>
                        <a href="/Talent-HUB/recruiter/applications?job_id=<?php echo $job['id']; ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Applications</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="mt-6">
        <nav class="flex justify-center">
            <div class="flex space-x-2">
                <button class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md">1</button>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">2</button>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">3</button>
            </div>
        </nav>
    </div>
</div>
