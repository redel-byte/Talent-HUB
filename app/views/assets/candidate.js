document.addEventListener('DOMContentLoaded', function() {
    // Add ripple effect CSS
    const style = document.createElement('style');
    style.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .application-action, .quick-action {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .application-action:hover, .quick-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .application-action:active, .quick-action:active {
            transform: translateY(0);
        }
        
        .search-result-item {
            transition: all 0.3s ease;
        }
        
        .search-result-item:hover {
            background-color: #f9fafb;
            border-color: #9333ea;
        }
        
        .notification {
            animation: slideInRight 0.3s ease-out;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fixed.show {
            opacity: 1;
        }
    `;
    document.head.appendChild(style);
    
    // Initialize tooltips
    initTooltips();
    
    // Initialize form validations
    initFormValidations();
    
    // Initialize interactive elements
    initInteractiveElements();
    
    // Initialize job saving
    initJobSaving();
    
    // Initialize status updates
    initStatusUpdates();
    
    // Initialize file upload separately to ensure it's bound
    initFileUpload();
});

function initTooltips() {
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', function(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'absolute z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg';
            tooltip.textContent = this.getAttribute('data-tooltip');
            tooltip.style.top = (e.pageY - 30) + 'px';
            tooltip.style.left = (e.pageX + 10) + 'px';
            tooltip.id = 'tooltip';
            document.body.appendChild(tooltip);
        });
        
        element.addEventListener('mouseleave', function() {
            const tooltip = document.getElementById('tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });
}

function initFileUpload() {
    // Try multiple approaches to find the file input
    const fileInput = document.getElementById('resume-upload');
    const fileInputByName = document.querySelector('input[name="resume"]');
    
    // Use whichever is found
    const targetInput = fileInput || fileInputByName;
    
    if (targetInput) {
        // Remove any existing listeners to prevent duplicates
        targetInput.removeEventListener('change', handleFileChange);
        
        // Add the event listener
        targetInput.addEventListener('change', handleFileChange);
    } else {
        // Retry after a short delay in case DOM is still loading
        setTimeout(initFileUpload, 500);
    }
}

function handleFileChange(e) {
    const file = e.target.files[0];
    if (file) {
        const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        const maxSize = 2 * 1024 * 1024; // 2MB to match PHP config
        
        if (!allowedTypes.includes(file.type)) {
            showNotification('Please upload a PDF, DOC, or DOCX file', 'error');
            this.value = '';
            return;
        }
        
        if (file.size > maxSize) {
            showNotification('File size must be less than 2MB', 'error');
            this.value = '';
            return;
        }
        
        // Show upload progress
        showNotification('Uploading file: ' + file.name, 'info');
        uploadFile(file);
    }
}

function initFormValidations() {
    // Profile form validation
    const profileForm = document.querySelector('form[action="/Talent-HUB/candidate/profile/update"]');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            const fullname = this.querySelector('input[name="fullname"]')?.value.trim();
            const phone = this.querySelector('input[name="phone_number"]')?.value.trim();
            
            if (!fullname) {
                showNotification('Please enter your full name', 'error');
                e.preventDefault();
                return;
            }
            
            if (phone && !validatePhone(phone)) {
                showNotification('Please enter a valid phone number', 'error');
                e.preventDefault();
                return;
            }
            
            // Show loading state for form submission
            showLoadingState();
            
            // Submit form normally (or via AJAX for better UX)
            setTimeout(() => {
                hideLoadingState();
                showNotification('Profile updated successfully!', 'success');
            }, 1000);
        });
    }
}

function uploadFile(file) {
    const formData = new FormData();
    formData.append('resume', file);
    
    showLoadingState();
    
    fetch('/Talent-HUB/api/candidate/resume/upload', {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        hideLoadingState();
        if (data.success) {
            showNotification(data.success, 'success');
            // Update UI to show uploaded file
            const uploadButton = document.querySelector('button[onclick*="resume-upload"]');
            if (uploadButton) {
                uploadButton.innerHTML = '<i class="fas fa-check mr-2"></i>Resume Uploaded';
                uploadButton.classList.add('bg-green-600', 'hover:bg-green-700');
                uploadButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            }
        } else {
            showNotification(data.error || 'Upload failed', 'error');
        }
    })
    .catch(error => {
        hideLoadingState();
        showNotification('Upload failed. Please try again.', 'error');
    });
}

function initInteractiveElements() {
    // Application action buttons with better UX
    const actionButtons = document.querySelectorAll('.application-action');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.getAttribute('data-action');
            const applicationId = this.getAttribute('data-application-id');
            
            // Add ripple effect
            addRippleEffect(this, e);
            
            handleApplicationAction(action, applicationId);
        });
    });
    
    // Quick action buttons with hover effects
    const quickActionButtons = document.querySelectorAll('.quick-action');
    quickActionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const action = this.getAttribute('data-action');
            addRippleEffect(this, e);
            handleQuickAction(action);
        });
        
        // Add hover sound effect (optional)
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Search functionality with real-time suggestions
    const searchInput = document.querySelector('#search-jobs');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length > 2) {
                searchTimeout = setTimeout(() => searchJobs(query), 300);
            } else if (query.length === 0) {
                // Clear search results
                const searchResults = document.querySelector('#search-results');
                if (searchResults) {
                    searchResults.innerHTML = '';
                }
            }
        });
        
        // Add keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query.length > 2) {
                    searchJobs(query);
                }
            }
        });
    }
    
    // Add smooth scroll to anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
}

function initStatusUpdates() {
    // Auto-refresh application status (every 30 seconds)
    setInterval(function() {
        if (document.querySelector('.application-status')) {
            updateApplicationStatuses();
        }
    }, 30000);
}

function handleApplicationAction(action, applicationId) {
    const confirmMessages = {
        'view': 'View application details',
        'withdraw': 'Are you sure you want to withdraw this application? This action cannot be undone.',
        'accept': 'Are you sure you want to accept this offer?',
        'reapply': 'Would you like to reapply for this position?'
    };
    
    if (action === 'view') {
        // Show application details in a modal
        showApplicationDetails(applicationId);
        return;
    }
    
    if (confirmMessages[action]) {
        if (confirm(confirmMessages[action])) {
            showLoadingState();
            
            // Make actual API call
            const apiEndpoints = {
                'withdraw': '/Talent-HUB/api/candidate/application/withdraw',
                'accept': '/Talent-HUB/api/candidate/application/accept',
                'reapply': '/Talent-HUB/api/candidate/application/reapply'
            };
            
            fetch(apiEndpoints[action], {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ id: applicationId })
            })
            .then(response => response.json())
            .then(data => {
                hideLoadingState();
                if (data.success) {
                    showNotification(data.success, 'success');
                    if (action === 'withdraw') {
                        removeApplicationFromUI(applicationId);
                    } else {
                        // Refresh the page to show updated status
                        setTimeout(() => window.location.reload(), 1500);
                    }
                } else {
                    showNotification(data.error || 'Action failed', 'error');
                }
            })
            .catch(error => {
                hideLoadingState();
                showNotification('Network error. Please try again.', 'error');
                console.error('Application action error:', error);
            });
        }
    }
}

function showApplicationDetails(applicationId) {
    showLoadingState();
    
    fetch(`/Talent-HUB/api/candidate/application/details?id=${applicationId}`, { credentials: 'same-origin' })
        .then(response => response.json())
        .then(data => {
            hideLoadingState();
            if (data.data) {
                const application = data.data;
                const modal = createApplicationDetailsModal(application);
                document.body.appendChild(modal);
                
                // Show modal with animation
                setTimeout(() => {
                    modal.classList.add('show');
                }, 10);
            } else {
                showNotification(data.error || 'Failed to load application details', 'error');
            }
        })
        .catch(error => {
            hideLoadingState();
            showNotification('Failed to load application details', 'error');
            console.error('Application details error:', error);
        });
}

function createApplicationDetailsModal(application) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 transition-opacity duration-300';
    modal.innerHTML = `
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">${application.title}</h2>
                        <p class="text-gray-600">${application.company_name || application.recruiter_name}</p>
                    </div>
                    <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Location</p>
                            <p class="font-medium">${application.location || 'Remote'}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Salary</p>
                            <p class="font-medium">${application.salary_min ? '$' + number_format(application.salary_min) + (application.salary_max ? ' - $' + number_format(application.salary_max) : '') : 'Not specified'}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Type</p>
                            <p class="font-medium">${application.type || 'Full-time'}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="font-medium capitalize">${application.status}</p>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Applied Date</p>
                        <p class="font-medium">${new Date(application.applied_at).toLocaleDateString()}</p>
                    </div>
                    
                    ${application.job_description ? `
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Job Description</p>
                        <div class="prose max-w-none text-gray-700">
                            ${application.job_description.substring(0, 500)}${application.job_description.length > 500 ? '...' : ''}
                        </div>
                    </div>
                    ` : ''}
                    
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Close
                        </button>
                        ${application.status === 'accepted' ? `
                            <button onclick="acceptOfferFromModal(${application.id})" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                Accept Offer
                            </button>
                        ` : ''}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.remove();
        }
    });
    
    return modal;
}

function acceptOfferFromModal(applicationId) {
    if (confirm('Are you sure you want to accept this offer?')) {
        handleApplicationAction('accept', applicationId);
        document.querySelector('.fixed').remove();
    }
}

// Helper function for number formatting
function number_format(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function handleQuickAction(action) {
    const actions = {
        'search-jobs': '/Talent-HUB/find-jobs',
        'upload-resume': '#resume-upload',
        'update-profile': '/Talent-HUB/candidate/profile',
        'notifications': '/Talent-HUB/candidate/settings'
    };
    
    if (action === 'upload-resume') {
        const input = document.querySelector('#resume-upload');
        if (input) {
            input.click();
        } else {
            // If the file input is not on this page, redirect to profile where upload exists
            window.location.href = actions['update-profile'];
        }
    } else if (actions[action]) {
        window.location.href = actions[action];
    }
}

// Job saving functionality for bookmark buttons
function initJobSaving() {
    const bookmarkButtons = document.querySelectorAll('.job-bookmark');
    bookmarkButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const jobId = this.getAttribute('data-job-id');
            const isSaved = this.classList.contains('saved');
            
            if (isSaved) {
                unsaveJob(jobId, this);
            } else {
                saveJob(jobId, this);
            }
        });
    });
}

function saveJob(jobId, button) {
    showLoadingState();
    
    fetch('/Talent-HUB/api/candidate/job/save', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ job_id: jobId })
    })
    .then(response => response.json())
    .then(data => {
        hideLoadingState();
        if (data.success) {
            showNotification('Job saved successfully!', 'success');
            button.classList.add('saved');
            button.innerHTML = '<i class="fas fa-bookmark-fill"></i>';
            button.classList.add('text-green-600');
            button.classList.remove('text-blue-600');
        } else {
            showNotification(data.error || 'Failed to save job', 'error');
        }
    })
    .catch(error => {
        hideLoadingState();
        showNotification('Network error. Please try again.', 'error');
        console.error('Save job error:', error);
    });
}

function unsaveJob(jobId, button) {
    showLoadingState();
    
    fetch('/Talent-HUB/api/candidate/job/unsave', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ job_id: jobId })
    })
    .then(response => response.json())
    .then(data => {
        hideLoadingState();
        if (data.success) {
            showNotification('Job removed from saved list', 'info');
            button.classList.remove('saved');
            button.innerHTML = '<i class="fas fa-bookmark"></i>';
            button.classList.remove('text-green-600');
            button.classList.add('text-blue-600');
        } else {
            showNotification(data.error || 'Failed to remove saved job', 'error');
        }
    })
    .catch(error => {
        hideLoadingState();
        showNotification('Network error. Please try again.', 'error');
        console.error('Unsave job error:', error);
    });
}

function searchJobs(query) {
    const searchResults = document.querySelector('#search-results');
    const searchInput = document.querySelector('#search-jobs');
    
    if (searchResults) {
        searchResults.innerHTML = '<div class="text-center py-4"><div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div> Searching...</div>';
    }
    
    // Debounced API call
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(() => {
        fetch(`/Talent-HUB/api/jobs/search?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (searchResults) {
                    if (data.jobs && data.jobs.length > 0) {
                        searchResults.innerHTML = data.jobs.map(job => `
                            <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                                <h4 class="font-semibold text-gray-900">${job.title}</h4>
                                <p class="text-sm text-gray-600">${job.company} • ${job.location}</p>
                                <p class="text-xs text-gray-500 mt-1">${job.salary}</p>
                                <button class="mt-2 text-purple-600 hover:text-purple-800 text-sm font-medium">Apply Now</button>
                            </div>
                        `).join('');
                    } else {
                        searchResults.innerHTML = '<p class="text-gray-500 text-center py-4">No jobs found for "' + query + '"</p>';
                    }
                }
            })
            .catch(error => {
                if (searchResults) {
                    searchResults.innerHTML = '<p class="text-red-500 text-center py-4">Search failed. Please try again.</p>';
                }
                console.error('Search error:', error);
            });
    }, 300);
}

function updateApplicationStatuses() {
    fetch('/Talent-HUB/api/applications/status', { credentials: 'same-origin' })
        .then(response => response.json())
        .then(data => {
            if (data.updates && data.updates.length > 0) {
                data.updates.forEach(update => {
                    const statusElement = document.querySelector(`[data-application-id="${update.id}"] .application-status`);
                    if (statusElement) {
                        const oldStatus = statusElement.textContent.trim();
                        const newStatus = update.status;
                        
                        if (oldStatus !== newStatus) {
                            statusElement.textContent = newStatus;
                            statusElement.className = `application-status px-2 py-1 text-xs font-medium bg-${getStatusColor(newStatus)}-100 text-${getStatusColor(newStatus)}-800 rounded-full`;
                            
                            showNotification(`Application status updated to: ${newStatus}`, 'info');
                        }
                    }
                });
            }
        })
        .catch(error => {
            console.error('Status update error:', error);
        });
}

function getStatusColor(status) {
    const colors = {
        'pending': 'yellow',
        'reviewed': 'blue', 
        'accepted': 'green',
        'rejected': 'red',
        'interview': 'purple'
    };
    return colors[status] || 'gray';
}

function removeApplicationFromUI(applicationId) {
    const applicationElement = document.querySelector(`[data-application-id="${applicationId}"]`);
    if (applicationElement) {
        applicationElement.style.transition = 'opacity 0.3s, transform 0.3s';
        applicationElement.style.opacity = '0';
        applicationElement.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            applicationElement.remove();
            showNotification('Application withdrawn', 'info');
        }, 300);
    }
}

function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    const icons = {
        success: 'check-circle',
        error: 'exclamation-circle',
        warning: 'exclamation-triangle',
        info: 'info-circle'
    };
    
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        warning: 'bg-yellow-500',
        info: 'bg-blue-500'
    };
    
    notification.className = `notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white ${colors[type]} transform translate-x-full transition-all duration-300 max-w-sm backdrop-blur-sm`;
    notification.innerHTML = `
        <div class="flex items-start">
            <i class="fas fa-${icons[type]} mr-3 mt-0.5 flex-shrink-0 text-lg"></i>
            <div class="flex-1">
                <p class="font-medium">${message}</p>
                <button class="mt-2 text-xs opacity-75 hover:opacity-100 transition-opacity focus:outline-none" onclick="this.parentElement.parentElement.parentElement.remove()">Dismiss</button>
            </div>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
        notification.classList.add('translate-x-0');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        notification.classList.remove('translate-x-0');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
}

function showLoadingState() {
    // Remove existing loader
    hideLoadingState();
    
    const loader = document.createElement('div');
    loader.id = 'global-loader';
    loader.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm';
    loader.innerHTML = `
        <div class="bg-white rounded-lg shadow-xl p-6 flex flex-col items-center space-y-4 max-w-sm mx-4">
            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-purple-600"></div>
            <p class="text-gray-700 font-medium text-center">Loading...</p>
            <p class="text-gray-500 text-sm text-center">Please wait while we process your request</p>
            <button onclick="this.closest('#global-loader').remove()" class="mt-2 text-xs text-gray-400 hover:text-gray-600 transition-colors">Cancel</button>
        </div>
    `;
    
    document.body.appendChild(loader);
    
    // Add escape key to close loader
    const handleEscape = (e) => {
        if (e.key === 'Escape') {
            hideLoadingState();
            document.removeEventListener('keydown', handleEscape);
        }
    };
    document.addEventListener('keydown', handleEscape);
}

function hideLoadingState() {
    const loader = document.getElementById('global-loader');
    if (loader) {
        loader.style.opacity = '0';
        loader.style.transition = 'opacity 0.3s ease-out';
        setTimeout(() => {
            loader.remove();
        }, 300);
    }
}

function validatePhone(phone) {
    const phoneRegex = /^[\d\s\-\+\(\)]+$/;
    return phoneRegex.test(phone) && phone.replace(/\D/g, '').length >= 10;
}

function addRippleEffect(button, event) {
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    // Ensure button has relative positioning
    if (getComputedStyle(button).position !== 'relative') {
        button.style.position = 'relative';
    }
    button.style.overflow = 'hidden';
    
    // Remove existing ripple
    const existingRipple = button.querySelector('.ripple');
    if (existingRipple) {
        existingRipple.remove();
    }
    
    button.appendChild(ripple);
    
    // Remove ripple after animation
    setTimeout(() => {
        ripple.remove();
    }, 600);
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Utility function to format dates
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays === 0) return 'Today';
    if (diffDays === 1) return 'Yesterday';
    if (diffDays < 7) return diffDays + ' days ago';
    if (diffDays < 30) return Math.floor(diffDays / 7) + ' weeks ago';
    if (diffDays < 365) return Math.floor(diffDays / 30) + ' months ago';
    return Math.floor(diffDays / 365) + ' years ago';
}

// Export functions for global access
window.candidateUtils = {
    showNotification,
    showLoadingState,
    hideLoadingState,
    formatDate,
    validatePhone
};
