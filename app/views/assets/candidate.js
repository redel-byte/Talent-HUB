document.addEventListener('DOMContentLoaded', function() {
    console.log('Candidate JavaScript loaded successfully');
    
    // Initialize tooltips
    initTooltips();
    
    // Initialize form validations
    initFormValidations();
    
    // Initialize interactive elements
    initInteractiveElements();
    
    // Initialize status updates
    initStatusUpdates();
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

function initFormValidations() {
    // Profile form validation
    const profileForm = document.querySelector('form[action="/Talent-HUB/candidate/profile/update"]');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            const fullname = this.querySelector('input[name="fullname"]').value.trim();
            const phone = this.querySelector('input[name="phone_number"]').value.trim();
            
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
            
            showNotification('Profile updated successfully!', 'success');
        });
    }
    
    // File upload validation
    const fileInput = document.getElementById('resume-upload');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                const maxSize = 5 * 1024 * 1024; // 5MB
                
                if (!allowedTypes.includes(file.type)) {
                    showNotification('Please upload a PDF, DOC, or DOCX file', 'error');
                    this.value = '';
                    return;
                }
                
                if (file.size > maxSize) {
                    showNotification('File size must be less than 5MB', 'error');
                    this.value = '';
                    return;
                }
                
                showNotification('File selected: ' + file.name, 'success');
            }
        });
    }
}

function initInteractiveElements() {
    // Application action buttons
    const actionButtons = document.querySelectorAll('.application-action');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.getAttribute('data-action');
            const applicationId = this.getAttribute('data-application-id');
            
            handleApplicationAction(action, applicationId);
        });
    });
    
    // Quick action buttons on dashboard
    const quickActionButtons = document.querySelectorAll('.quick-action');
    quickActionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            handleQuickAction(action);
        });
    });
    
    // Search functionality
    const searchInput = document.querySelector('#search-jobs');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function() {
            const query = this.value.trim();
            if (query.length > 2) {
                searchJobs(query);
            }
        }, 300));
    }
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
        'withdraw': 'Are you sure you want to withdraw this application?',
        'accept': 'Are you sure you want to accept this offer?',
        'reapply': 'Would you like to reapply for this position?'
    };
    
    if (confirmMessages[action]) {
        if (confirm(confirmMessages[action])) {
            // Show loading state
            showLoadingState();
            
            // Simulate API call
            setTimeout(() => {
                hideLoadingState();
                showNotification(`Application ${action}ed successfully!`, 'success');
                
                // Refresh the page or update UI
                if (action === 'withdraw') {
                    removeApplicationFromUI(applicationId);
                }
            }, 1000);
        }
    }
}

function handleQuickAction(action) {
    const actions = {
        'search-jobs': '/Talent-HUB/find-jobs',
        'upload-resume': '#resume-upload',
        'update-profile': '/Talent-HUB/candidate/profile',
        'notifications': '/Talent-HUB/candidate/notifications'
    };
    
    if (action === 'upload-resume') {
        document.querySelector('#resume-upload')?.click();
    } else if (actions[action]) {
        window.location.href = actions[action];
    }
}

function searchJobs(query) {
    // Show loading state
    const searchResults = document.querySelector('#search-results');
    if (searchResults) {
        searchResults.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin"></i> Searching...</div>';
    }
    
    // Simulate API call
    setTimeout(() => {
        // This would be an actual API call in production
        console.log('Searching for jobs:', query);
        if (searchResults) {
            searchResults.innerHTML = '<p class="text-gray-500">No jobs found for "' + query + '"</p>';
        }
    }, 500);
}

function updateApplicationStatuses() {
    // Simulate status update check
    console.log('Checking for application status updates...');
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
    const notification = document.createElement('div');
    const colors = {
        success: 'bg-green-100 text-green-800 border-green-200',
        error: 'bg-red-100 text-red-800 border-red-200',
        info: 'bg-blue-100 text-blue-800 border-blue-200',
        warning: 'bg-yellow-100 text-yellow-800 border-yellow-200'
    };
    
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg border ${colors[type]} shadow-lg max-w-sm`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    notification.style.transform = 'translateX(100%)';
    notification.style.transition = 'transform 0.3s ease-out';
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
}

function showLoadingState() {
    const loader = document.createElement('div');
    loader.id = 'global-loader';
    loader.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    loader.innerHTML = '<div class="bg-white p-4 rounded-lg shadow-lg"><i class="fas fa-spinner fa-spin text-blue-600 text-2xl"></i></div>';
    document.body.appendChild(loader);
}

function hideLoadingState() {
    const loader = document.getElementById('global-loader');
    if (loader) {
        loader.remove();
    }
}

function validatePhone(phone) {
    const phoneRegex = /^[\d\s\-\+\(\)]+$/;
    return phoneRegex.test(phone) && phone.replace(/\D/g, '').length >= 10;
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
