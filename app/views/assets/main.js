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
    
    // Make actual login request
    fetch('/Talent-HUB/api/auth/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ email, password })
    })
    .then(response => response.json())
    .then(data => {
        hideLoadingState();
        if (data.success) {
            showNotification('Login successful! Redirecting...', 'success');
            // Update localStorage for client-side state
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('userRole', data.role);
            localStorage.setItem('userEmail', email);
            
            // Redirect to dashboard
            setTimeout(() => {
                window.location.href = data.redirect || '/Talent-HUB/dashboard';
            }, 1500);
        } else {
            showNotification(data.message || 'Login failed', 'error');
        }
    })
    .catch(error => {
        hideLoadingState();
        showNotification('Network error. Please try again.', 'error');
        console.error('Login error:', error);
    });
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
    
    // Make actual registration request
    fetch('/Talent-HUB/api/auth/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ firstName, lastName, email, password })
    })
    .then(response => response.json())
    .then(data => {
        hideLoadingState();
        if (data.success) {
            showNotification('Registration successful! Please check your email.', 'success');
            // Clear form
            e.target.reset();
            
            // Redirect to login after delay
            setTimeout(() => {
                window.location.href = '/Talent-HUB/login';
            }, 2000);
        } else {
            showNotification(data.message || 'Registration failed', 'error');
        }
    })
    .catch(error => {
        hideLoadingState();
        showNotification('Network error. Please try again.', 'error');
        console.error('Registration error:', error);
    });
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
document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript loaded successfully');
    
    // Form switching functionality
    const showLoginBtn = document.getElementById('showLoginBtn');
    const showSignupBtn = document.getElementById('showSignupBtn');
    const switchToSignup = document.getElementById('switchToSignup');
    const switchToLogin = document.getElementById('switchToLogin');
    const backToLogin = document.getElementById('backToLogin');
    
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    const successMessage = document.getElementById('successMessage');

    console.log('Elements found:', {
        showLoginBtn,
        showSignupBtn,
        switchToSignup,
        switchToLogin,
        backToLogin,
        loginForm,
        signupForm,
        successMessage
    });

    // Show login form
    function showLoginForm() {
        console.log('Showing login form');
        if (loginForm && signupForm && successMessage) {
            loginForm.classList.remove('hidden-form');
            loginForm.classList.add('active-form');
            signupForm.classList.remove('active-form');
            signupForm.classList.add('hidden-form');
            successMessage.classList.add('hidden');
        }
    }

    // Show signup form
    function showSignupForm() {
        console.log('Showing signup form');
        if (signupForm && loginForm && successMessage) {
            signupForm.classList.remove('hidden-form');
            signupForm.classList.add('active-form');
            loginForm.classList.remove('active-form');
            loginForm.classList.add('hidden-form');
            successMessage.classList.add('hidden');
        }
    }

    // Show success message
    function showSuccessMessage() {
        console.log('Showing success message');
        if (successMessage && loginForm && signupForm) {
            successMessage.classList.remove('hidden');
            loginForm.classList.add('hidden-form');
            signupForm.classList.add('hidden-form');
        }
    }

    // Event listeners for form switching
    if (showLoginBtn) {
        showLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showLoginForm();
        });
        console.log('Login button listener attached');
    }
    
    if (showSignupBtn) {
        showSignupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showSignupForm();
        });
        console.log('Signup button listener attached');
    }
    
    if (switchToSignup) {
        switchToSignup.addEventListener('click', function(e) {
            e.preventDefault();
            showSignupForm();
        });
        console.log('Switch to signup listener attached');
    }
    
    if (switchToLogin) {
        switchToLogin.addEventListener('click', function(e) {
            e.preventDefault();
            showLoginForm();
        });
        console.log('Switch to login listener attached');
    }
    
    if (backToLogin) {
        backToLogin.addEventListener('click', function(e) {
            e.preventDefault();
            showLoginForm();
        });
        console.log('Back to login listener attached');
    }

    // Role selection and company fields
    const jobSeekerRadio = document.getElementById('jobSeeker');
    const employerRadio = document.getElementById('employer');
    const companyFields = document.getElementById('companyFields');

    function toggleCompanyFields() {
        if (employerRadio && employerRadio.checked) {
            companyFields.classList.remove('hidden');
        } else {
            companyFields.classList.add('hidden');
        }
    }

    if (jobSeekerRadio) {
        jobSeekerRadio.addEventListener('change', toggleCompanyFields);
    }
    if (employerRadio) {
        employerRadio.addEventListener('change', toggleCompanyFields);
    }

    // Initial check
    toggleCompanyFields();

    // Password visibility toggle
    const toggleLoginPassword = document.getElementById('toggleLoginPassword');
    const loginPassword = document.getElementById('loginPassword');
    const toggleSignupPassword = document.getElementById('toggleSignupPassword');
    const signupPassword = document.getElementById('signupPassword');

    if (toggleLoginPassword && loginPassword) {
        toggleLoginPassword.addEventListener('click', function() {
            const type = loginPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            loginPassword.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }

    if (toggleSignupPassword && signupPassword) {
        toggleSignupPassword.addEventListener('click', function() {
            const type = signupPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            signupPassword.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }

    // Form validation and submission
    const loginFormElement = document.getElementById('loginFormElement');
    const signupFormElement = document.getElementById('signupFormElement');

    // Login form submission
    if (loginFormElement) {
        loginFormElement.addEventListener('submit', function(e) {
            console.log('Login form submitted');
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            // Basic client-side validation
            if (!email || !password) {
                showError('Please fill in all fields');
                e.preventDefault();
                return false;
            }
            
            if (!isValidEmail(email)) {
                showError('Please enter a valid email address');
                e.preventDefault();
                return false;
            }
            
            console.log('Login validation passed, submitting form');
            // Allow form to submit normally
            return true;
        });
    }

    // Signup form submission
    if (signupFormElement) {
        signupFormElement.addEventListener('submit', function(e) {
            console.log('Registration form submitted');
            
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('signupEmail').value;
            const password = document.getElementById('signupPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const terms = document.getElementById('terms').checked;
            
            console.log('Form data:', { firstName, lastName, email, terms: terms ? 'checked' : 'unchecked' });
            
            // Basic client-side validation
            if (!firstName || !lastName || !email || !password || !confirmPassword) {
                showError('Please fill in all fields');
                e.preventDefault();
                return false;
            }
            
            if (!isValidEmail(email)) {
                showError('Please enter a valid email address');
                e.preventDefault();
                return false;
            }
            
            if (password.length < 8) {
                showError('Password must be at least 8 characters long');
                e.preventDefault();
                return false;
            }
            
            if (!/(?=.*[A-Za-z])(?=.*\d)/.test(password)) {
                showError('Password must contain both letters and numbers');
                e.preventDefault();
                return false;
            }
            
            if (password !== confirmPassword) {
                showError('Passwords do not match');
                e.preventDefault();
                return false;
            }
            
            if (!terms) {
                showError('You must agree to the Terms of Service and Privacy Policy');
                e.preventDefault();
                return false;
            }
            
            console.log('Validation passed, submitting form');
            // Allow form to submit normally
            return true;
        });
    }

    // Utility functions
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function showError(message) {
        // Remove existing error messages
        const existingErrors = document.querySelectorAll('.error-message');
        existingErrors.forEach(error => error.remove());
        
        // Create and show error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message bg-red-100 text-red-700 p-3 rounded mb-4';
        errorDiv.textContent = message;
        
        // Insert at the beginning of the active form
        const activeForm = document.querySelector('.active-form');
        if (activeForm) {
            const formContent = activeForm.querySelector('.bg-white');
            if (formContent) {
                formContent.insertBefore(errorDiv, formContent.firstChild);
            }
        }
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (errorDiv.parentNode) {
                errorDiv.remove();
            }
        }, 5000);
    }

    // Ripple effect for buttons
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Check for success/error messages from server
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    const error = urlParams.get('error');
    
    if (success) {
        showSuccessMessage();
    }
    
    if (error) {
        showError(decodeURIComponent(error));
    }
});