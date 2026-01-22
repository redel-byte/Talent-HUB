document.addEventListener('DOMContentLoaded', function() {
    console.log('Main JavaScript loaded successfully');
    
    // Initialize navigation
    initNavigation();
    
    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize form validations
    initFormValidations();
    
    // Initialize notifications
    initNotifications();
    
    // Check authentication status
    checkAuthStatus();
});

function initNavigation() {
    const navContainer = document.querySelector('.nav-auth-container');
    if (navContainer) {
        updateNavigation(navContainer);
    }
}

function updateNavigation(container) {
    // Check if user is logged in
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const userRole = localStorage.getItem('userRole');
    const userEmail = localStorage.getItem('userEmail');
    
    if (isLoggedIn && userRole) {
        // Show authenticated navigation
        container.innerHTML = generateAuthenticatedNav(userRole, userEmail);
    } else {
        // Show public navigation
        container.innerHTML = generatePublicNav();
    }
}

function generatePublicNav() {
    return `
        <div class="flex space-x-4">
            <a href="/Talent-HUB/login" class="text-purple-600 border border-purple-600 px-4 py-2 rounded-lg hover:bg-purple-50 transition">Log In</a>
            <a href="/Talent-HUB/register" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Sign Up</a>
        </div>
    `;
}

function generateAuthenticatedNav(role, email) {
    const dashboardLinks = {
        candidate: '/Talent-HUB/candidate/dashboard',
        recruiter: '/Talent-HUB/recruiter/dashboard',
        admin: '/Talent-HUB/admin/dashboard'
    };
    
    const settingsLinks = {
        candidate: '/Talent-HUB/candidate/settings',
        recruiter: '/Talent-HUB/recruiter/settings',
        admin: '/Talent-HUB/admin/settings'
    };
    
    return `
        <div class="flex items-center space-x-4">
            <div class="relative group">
                <button class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 px-3 py-2 rounded-lg hover:bg-purple-50 transition">
                    <i class="fas fa-user-circle"></i>
                    <span class="hidden md:block">${email}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <a href="${dashboardLinks[role]}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="${settingsLinks[role]}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                        <i class="fas fa-cog mr-2"></i>Settings
                    </a>
                    <div class="border-t border-gray-200">
                        <a href="/Talent-HUB/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function initMobileMenu() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
}

function initFormValidations() {
    // Login form validation
    const loginForm = document.getElementById('loginFormElement');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLoginSubmit);
    }
    
    // Registration form validation
    const registerForm = document.getElementById('registerFormElement');
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegisterSubmit);
    }
}

function handleLoginSubmit(e) {
    e.preventDefault();
    
    const email = document.getElementById('loginEmail')?.value;
    const password = document.getElementById('loginPassword')?.value;
    
    // Basic client-side validation
    if (!email || !password) {
        showNotification('Please fill in all fields', 'error');
        return;
    }
    
    if (!isValidEmail(email)) {
        showNotification('Please enter a valid email address', 'error');
        return;
    }
    
    // Show loading state
    showLoadingState();
    
    // Submit form normally
    setTimeout(() => {
        e.target.submit();
    }, 500);
}

function handleRegisterSubmit(e) {
    e.preventDefault();
    
    const firstName = document.getElementById('firstName')?.value;
    const lastName = document.getElementById('lastName')?.value;
    const email = document.getElementById('signupEmail')?.value;
    const password = document.getElementById('signupPassword')?.value;
    const confirmPassword = document.getElementById('confirmPassword')?.value;
    const terms = document.getElementById('terms')?.checked;
    
    // Basic client-side validation
    if (!firstName || !lastName || !email || !password || !confirmPassword) {
        showNotification('Please fill in all fields', 'error');
        return;
    }
    
    if (!isValidEmail(email)) {
        showNotification('Please enter a valid email address', 'error');
        return;
    }
    
    if (password.length < 8) {
        showNotification('Password must be at least 8 characters long', 'error');
        return;
    }
    
    if (!/(?=.*[A-Za-z])(?=.*\d)/.test(password)) {
        showNotification('Password must contain both letters and numbers', 'error');
        return;
    }
    
    if (password !== confirmPassword) {
        showNotification('Passwords do not match', 'error');
        return;
    }
    
    if (!terms) {
        showNotification('You must agree to the Terms of Service and Privacy Policy', 'error');
        return;
    }
    
    // Show loading state
    showLoadingState();
    
    // Submit form normally
    setTimeout(() => {
        e.target.submit();
    }, 500);
}

function initNotifications() {
    // Check for URL parameters for notifications
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    const error = urlParams.get('error');
    
    if (success) {
        showNotification(decodeURIComponent(success), 'success');
    }
    
    if (error) {
        showNotification(decodeURIComponent(error), 'error');
    }
}

function checkAuthStatus() {
    // This would typically be checked via an API endpoint
    // For now, we'll use localStorage as a fallback
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    
    // Update navigation based on auth status
    const navContainer = document.querySelector('.nav-auth-container');
    if (navContainer) {
        updateNavigation(navContainer);
    }
    
    // Redirect if needed
    const currentPage = window.location.pathname;
    if (isLoggedIn && (currentPage.includes('/login') || currentPage.includes('/register'))) {
        const userRole = localStorage.getItem('userRole');
        const dashboardUrls = {
            candidate: '/Talent-HUB/candidate/dashboard',
            recruiter: '/Talent-HUB/recruiter/dashboard',
            admin: '/Talent-HUB/admin/dashboard'
        };
        
        if (dashboardUrls[userRole]) {
            window.location.href = dashboardUrls[userRole];
        }
    }
}

function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        warning: 'bg-yellow-500',
        info: 'bg-blue-500'
    };
    
    notification.className = `notification fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white ${colors[type]} transform translate-x-full transition-transform duration-300`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
}

function showLoadingState() {
    const loader = document.createElement('div');
    loader.id = 'global-loader';
    loader.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    loader.innerHTML = `
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div>
                <span class="text-gray-700">Loading...</span>
            </div>
        </div>
    `;
    
    document.body.appendChild(loader);
}

function hideLoadingState() {
    const loader = document.getElementById('global-loader');
    if (loader) {
        loader.remove();
    }
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// Utility functions for global access
window.TalentHub = {
    showNotification,
    showLoadingState,
    hideLoadingState,
    updateNavigation,
    checkAuthStatus
};