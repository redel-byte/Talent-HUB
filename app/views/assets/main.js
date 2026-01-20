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