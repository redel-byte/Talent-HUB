/**
 * Enhanced UX Features for TalentHub
 * Adds micro-interactions, animations, and accessibility improvements
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Enhanced UX features loaded');
    
    // Initialize all enhancements
    initSmoothScrolling();
    initLazyLoading();
    initKeyboardNavigation();
    initProgressIndicators();
    initTooltips();
    initAnimations();
    initAccessibilityFeatures();
});

/**
 * Smooth scrolling for anchor links
 */
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Add highlight effect
                target.classList.add('highlighted');
                setTimeout(() => {
                    target.classList.remove('highlighted');
                }, 2000);
            }
        });
    });
}

/**
 * Lazy loading for images and content
 */
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

/**
 * Enhanced keyboard navigation
 */
function initKeyboardNavigation() {
    // Focus trap for modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            const modal = document.querySelector('.modal.show');
            if (modal) {
                trapFocus(modal, e);
            }
        }
    });
    
    // Skip to main content link
    const skipLink = document.createElement('a');
    skipLink.href = '#main-content';
    skipLink.className = 'skip-link';
    skipLink.textContent = 'Skip to main content';
    skipLink.style.cssText = `
        position: absolute;
        top: -40px;
        left: 6px;
        background: #4B5563;
        color: white;
        padding: 8px;
        text-decoration: none;
        border-radius: 4px;
        z-index: 10000;
        transition: top 0.3s;
    `;
    
    skipLink.addEventListener('focus', function() {
        this.style.top = '6px';
    });
    
    skipLink.addEventListener('blur', function() {
        this.style.top = '-40px';
    });
    
    document.body.insertBefore(skipLink, document.body.firstChild);
}

/**
 * Progress indicators for forms and uploads
 */
function initProgressIndicators() {
    // Form progress
    const forms = document.querySelectorAll('form[data-progress]');
    forms.forEach(form => {
        const steps = form.querySelectorAll('.form-step');
        const progressBar = document.createElement('div');
        progressBar.className = 'progress-bar';
        progressBar.innerHTML = `
            <div class="progress-fill" style="width: 0%"></div>
            <div class="progress-text">Step 1 of ${steps.length}</div>
        `;
        
        form.insertBefore(progressBar, form.firstChild);
        
        updateFormProgress(form, 0);
    });
    
    // File upload progress
    const fileInputs = document.querySelectorAll('input[type="file"][data-progress]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                showUploadProgress(file);
            }
        });
    });
}

/**
 * Enhanced tooltips
 */
function initTooltips() {
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    
    tooltipElements.forEach(element => {
        let tooltip = null;
        let timeout = null;
        
        element.addEventListener('mouseenter', function(e) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                tooltip = createTooltip(this.getAttribute('data-tooltip'), e);
                document.body.appendChild(tooltip);
                
                // Position tooltip
                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
                
                // Animate in
                setTimeout(() => tooltip.classList.add('show'), 10);
            }, 300);
        });
        
        element.addEventListener('mouseleave', function() {
            clearTimeout(timeout);
            if (tooltip) {
                tooltip.classList.remove('show');
                setTimeout(() => tooltip.remove(), 200);
            }
        });
    });
}

function createTooltip(text, event) {
    const tooltip = document.createElement('div');
    tooltip.className = 'enhanced-tooltip';
    tooltip.textContent = text;
    tooltip.style.cssText = `
        position: absolute;
        background: #1F2937;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        z-index: 10000;
        opacity: 0;
        transform: translateY(5px);
        transition: all 0.2s ease;
        pointer-events: none;
        max-width: 200px;
        text-align: center;
    `;
    
    return tooltip;
}

/**
 * Scroll-triggered animations
 */
function initAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const animationObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe elements with animation classes
    document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right, .scale-in').forEach(el => {
        animationObserver.observe(el);
    });
}

/**
 * Accessibility improvements
 */
function initAccessibilityFeatures() {
    // ARIA live regions for dynamic content
    const liveRegion = document.createElement('div');
    liveRegion.setAttribute('aria-live', 'polite');
    liveRegion.setAttribute('aria-atomic', 'true');
    liveRegion.className = 'sr-only';
    document.body.appendChild(liveRegion);
    
    // Enhanced focus indicators
    const style = document.createElement('style');
    style.textContent = `
        .skip-link:focus {
            top: 6px !important;
        }
        
        .enhanced-tooltip.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .highlighted {
            background-color: #FEF3C7 !important;
            outline: 2px solid #F59E0B;
            outline-offset: 2px;
            transition: all 0.3s ease;
        }
        
        .progress-bar {
            margin-bottom: 20px;
            background: #E5E7EB;
            border-radius: 4px;
            overflow: hidden;
            height: 4px;
            position: relative;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #8B5CF6, #EC4899);
            transition: width 0.3s ease;
        }
        
        .progress-text {
            text-align: center;
            margin-top: 8px;
            font-size: 14px;
            color: #6B7280;
        }
        
        .fade-in-up { opacity: 0; transform: translateY(20px); }
        .fade-in-left { opacity: 0; transform: translateX(-20px); }
        .fade-in-right { opacity: 0; transform: translateX(20px); }
        .scale-in { opacity: 0; transform: scale(0.9); }
        
        .animate-in {
            opacity: 1;
            transform: translateY(0) translateX(0) scale(1);
            transition: all 0.6s ease;
        }
        
        .loaded {
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
        
        *:focus {
            outline: 2px solid #8B5CF6;
            outline-offset: 2px;
        }
        
        button:focus, a:focus, input:focus, textarea:focus, select:focus {
            outline: 2px solid #8B5CF6 !important;
            outline-offset: 2px !important;
        }
    `;
    document.head.appendChild(style);
}

/**
 * Utility functions
 */
function updateFormProgress(form, currentStep) {
    const steps = form.querySelectorAll('.form-step');
    const progressFill = form.querySelector('.progress-fill');
    const progressText = form.querySelector('.progress-text');
    
    if (progressFill && progressText) {
        const progress = ((currentStep + 1) / steps.length) * 100;
        progressFill.style.width = progress + '%';
        progressText.textContent = `Step ${currentStep + 1} of ${steps.length}`;
    }
}

function showUploadProgress(file) {
    const progressContainer = document.createElement('div');
    progressContainer.className = 'upload-progress';
    progressContainer.innerHTML = `
        <div class="upload-info">
            <span class="upload-filename">${file.name}</span>
            <span class="upload-percentage">0%</span>
        </div>
        <div class="upload-bar">
            <div class="upload-fill" style="width: 0%"></div>
        </div>
    `;
    
    progressContainer.style.cssText = `
        margin: 10px 0;
        padding: 12px;
        background: #F9FAFB;
        border-radius: 6px;
        border: 1px solid #E5E7EB;
    `;
    
    // Insert after file input
    const fileInput = document.querySelector('input[type="file"][data-progress]');
    fileInput.parentNode.insertBefore(progressContainer, fileInput.nextSibling);
    
    // Simulate upload progress
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress > 100) progress = 100;
        
        progressContainer.querySelector('.upload-fill').style.width = progress + '%';
        progressContainer.querySelector('.upload-percentage').textContent = Math.round(progress) + '%';
        
        if (progress === 100) {
            clearInterval(interval);
            setTimeout(() => {
                progressContainer.style.background = '#D1FAE5';
                progressContainer.style.borderColor = '#10B981';
                progressContainer.querySelector('.upload-percentage').textContent = 'Complete!';
            }, 200);
        }
    }, 200);
}

function trapFocus(element, event) {
    const focusableElements = element.querySelectorAll(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];
    
    if (event.shiftKey) {
        if (document.activeElement === firstElement) {
            lastElement.focus();
            event.preventDefault();
        }
    } else {
        if (document.activeElement === lastElement) {
            firstElement.focus();
            event.preventDefault();
        }
    }
}

// Export for global access
window.TalentHubEnhancements = {
    updateFormProgress,
    showUploadProgress,
    trapFocus
};
