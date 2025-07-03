/*
 * UBAH PASSWORD ADMIN JAVASCRIPT
 * ==============================
 * File: ubah_password_admin.js
 * Description: JavaScript khusus untuk halaman Ubah Password Admin
 * Author: VSTOCK Team
 * Date: 2024
 */

// === GLOBAL VARIABLES ===
let passwordVisible = {
    oldPassword: false,
    newPassword: false,
    confirmPassword: false
};

// === PASSWORD LAYOUT INITIALIZATION ===
/**
 * Initialize password layout
 */
function initializePasswordLayout() {
    const contentWrapper = document.getElementById('contentWrapper');
    if (contentWrapper) {
        contentWrapper.classList.add('password-layout');
    }
}

// === PASSWORD TOGGLE FUNCTIONS ===
/**
 * Toggle password visibility
 * @param {string} fieldType - Type of password field
 */
function togglePasswordVisibility(fieldType) {
    const field = document.getElementById(fieldType);
    const toggleBtn = document.querySelector(`[data-toggle="${fieldType}"]`);
    
    if (field && toggleBtn) {
        passwordVisible[fieldType] = !passwordVisible[fieldType];
        
        if (passwordVisible[fieldType]) {
            field.type = 'text';
            toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            field.type = 'password';
            toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
}

// === PASSWORD STRENGTH FUNCTIONS ===
/**
 * Check password strength
 * @param {string} password - Password to check
 * @returns {object} Strength object with level and score
 */
function checkPasswordStrength(password) {
    let score = 0;
    let feedback = [];
    
    // Length check
    if (password.length >= 8) {
        score += 1;
    } else {
        feedback.push('Minimal 8 karakter');
    }
    
    // Uppercase check
    if (/[A-Z]/.test(password)) {
        score += 1;
    } else {
        feedback.push('Minimal 1 huruf besar');
    }
    
    // Lowercase check
    if (/[a-z]/.test(password)) {
        score += 1;
    } else {
        feedback.push('Minimal 1 huruf kecil');
    }
    
    // Number check
    if (/\d/.test(password)) {
        score += 1;
    } else {
        feedback.push('Minimal 1 angka');
    }
    
    // Special character check
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        score += 1;
    } else {
        feedback.push('Minimal 1 karakter khusus');
    }
    
    let level = 'weak';
    if (score >= 4) {
        level = 'strong';
    } else if (score >= 2) {
        level = 'medium';
    }
    
    return {
        level: level,
        score: score,
        feedback: feedback
    };
}

/**
 * Update password strength indicator
 * @param {string} password - Password to check
 */
function updatePasswordStrength(password) {
    const strengthIndicator = document.getElementById('passwordStrength');
    const strengthMeter = document.getElementById('passwordStrengthMeter');
    
    if (!strengthIndicator || !strengthMeter) return;
    
    const strength = checkPasswordStrength(password);
    
    // Update text
    strengthIndicator.textContent = `Kekuatan: ${strength.level === 'weak' ? 'Lemah' : strength.level === 'medium' ? 'Sedang' : 'Kuat'}`;
    strengthIndicator.className = `password-strength ${strength.level}`;
    
    // Update meter
    strengthMeter.className = `password-strength-meter ${strength.level}`;
    const meterFill = strengthMeter.querySelector('.meter-fill');
    if (meterFill) {
        meterFill.style.width = `${(strength.score / 5) * 100}%`;
    }
}

// === FORM VALIDATION ===
/**
 * Validate password form
 * @returns {boolean} True if form is valid
 */
function validatePasswordForm() {
    const oldPassword = document.getElementById('oldPassword');
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    
    let isValid = true;
    
    // Reset validation states
    [oldPassword, newPassword, confirmPassword].forEach(field => {
        if (field) {
            field.classList.remove('is-invalid', 'is-valid');
        }
    });
    
    // Validate old password
    if (!oldPassword || !oldPassword.value.trim()) {
        if (oldPassword) oldPassword.classList.add('is-invalid');
        isValid = false;
    } else {
        if (oldPassword) oldPassword.classList.add('is-valid');
    }
    
    // Validate new password
    if (!newPassword || !newPassword.value.trim()) {
        if (newPassword) newPassword.classList.add('is-invalid');
        isValid = false;
    } else {
        const strength = checkPasswordStrength(newPassword.value);
        if (strength.score < 3) {
            if (newPassword) newPassword.classList.add('is-invalid');
            isValid = false;
        } else {
            if (newPassword) newPassword.classList.add('is-valid');
        }
    }
    
    // Validate confirm password
    if (!confirmPassword || !confirmPassword.value.trim()) {
        if (confirmPassword) confirmPassword.classList.add('is-invalid');
        isValid = false;
    } else if (newPassword && confirmPassword.value !== newPassword.value) {
        if (confirmPassword) confirmPassword.classList.add('is-invalid');
        isValid = false;
    } else {
        if (confirmPassword) confirmPassword.classList.add('is-valid');
    }
    
    return isValid;
}

// === FORM SUBMISSION ===
/**
 * Handle form submission
 * @param {Event} event - Form submit event
 */
function handlePasswordSubmit(event) {
    event.preventDefault();
    
    if (!validatePasswordForm()) {
        showAlert('Error', 'Mohon periksa kembali input password Anda!', 'error');
        return;
    }
    
    // Show loading state
    showLoadingState();
    
    // Simulate password change (replace with actual AJAX call)
    setTimeout(() => {
        hideLoadingState();
        showAlert('Sukses', 'Password berhasil diubah!', 'success');
        
        // Reset form
        const form = document.querySelector('form');
        if (form) {
            form.reset();
            // Reset validation states
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                input.classList.remove('is-invalid', 'is-valid');
            });
        }
        
        // Reset password strength indicator
        const strengthIndicator = document.getElementById('passwordStrength');
        const strengthMeter = document.getElementById('passwordStrengthMeter');
        if (strengthIndicator) strengthIndicator.textContent = '';
        if (strengthMeter) strengthMeter.className = 'password-strength-meter';
        
    }, 2000);
}

// === UI UTILITY FUNCTIONS ===
/**
 * Show alert message
 * @param {string} title - Alert title
 * @param {string} message - Alert message
 * @param {string} type - Alert type (success, error, warning, info)
 */
function showAlert(title, message, type = 'info') {
    // Use SweetAlert2 if available, otherwise use browser alert
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: title,
            text: message,
            icon: type,
            confirmButtonText: 'OK',
            confirmButtonColor: '#4e73df'
        });
    } else {
        alert(`${title}: ${message}`);
    }
}

/**
 * Show loading state
 */
function showLoadingState() {
    const submitBtn = document.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengubah Password...';
    }
}

/**
 * Hide loading state
 */
function hideLoadingState() {
    const submitBtn = document.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Ubah Password';
    }
}

// === EVENT LISTENERS ===
document.addEventListener('DOMContentLoaded', function() {
    // Initialize password layout
    initializePasswordLayout();
    
    // Add form submit handler
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', handlePasswordSubmit);
    }
    
    // Add password field listeners
    const newPasswordField = document.getElementById('newPassword');
    if (newPasswordField) {
        newPasswordField.addEventListener('input', function() {
            updatePasswordStrength(this.value);
        });
    }
    
    // Add real-time validation
    const passwordFields = document.querySelectorAll('input[type="password"]');
    passwordFields.forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });
        
        field.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });
});

/**
 * Validate individual field
 * @param {HTMLElement} field - Form field element
 */
function validateField(field) {
    const value = field.value.trim();
    
    // Remove validation classes
    field.classList.remove('is-invalid', 'is-valid');
    
    // Check if field is empty
    if (!value) {
        field.classList.add('is-invalid');
        return;
    }
    
    // Specific validation for new password
    if (field.id === 'newPassword') {
        const strength = checkPasswordStrength(value);
        if (strength.score < 3) {
            field.classList.add('is-invalid');
        } else {
            field.classList.add('is-valid');
        }
    }
    
    // Specific validation for confirm password
    if (field.id === 'confirmPassword') {
        const newPassword = document.getElementById('newPassword');
        if (newPassword && value !== newPassword.value) {
            field.classList.add('is-invalid');
        } else if (value) {
            field.classList.add('is-valid');
        }
    }
}

// === KEYBOARD SHORTCUTS ===
document.addEventListener('keydown', function(event) {
    // Ctrl/Cmd + Enter to submit
    if ((event.ctrlKey || event.metaKey) && event.key === 'Enter') {
        event.preventDefault();
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.click();
        }
    }
    
    // Escape to reset form
    if (event.key === 'Escape') {
        const form = document.querySelector('form');
        if (form) {
            form.reset();
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                input.classList.remove('is-invalid', 'is-valid');
            });
        }
    }
}); 