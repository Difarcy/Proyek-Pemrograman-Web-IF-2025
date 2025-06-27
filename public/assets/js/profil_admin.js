/*
 * PROFIL ADMIN JAVASCRIPT
 * =======================
 * File: profil_admin.js
 * Description: JavaScript khusus untuk halaman Profil Admin
 * Author: VSTOCK Team
 * Date: 2024
 */

// === GLOBAL VARIABLES ===
let selectedFile = null;

// === PROFILE LAYOUT INITIALIZATION ===
/**
 * Initialize profile layout
 */
function initializeProfileLayout() {
    const contentWrapper = document.getElementById('contentWrapper');
    if (contentWrapper) {
        contentWrapper.classList.add('profile-layout');
    }
}

// === PROFILE PHOTO FUNCTIONS ===
/**
 * Trigger file input click for photo upload
 */
function changeProfilePhoto() {
    document.getElementById('profilePhotoInput').click();
}

/**
 * Handle file selection for profile photo
 * @param {Event} event - File input change event
 */
function handleFileSelection(event) {
    const file = event.target.files[0];
    if (file) {
        // Validate file type
        if (!validateImageFile(file)) {
            return;
        }
        
        // Validate file size (max 5MB)
        if (!validateFileSize(file, 5)) {
            return;
        }
        
        selectedFile = file;
        showImagePreview(file);
    }
}

/**
 * Validate if selected file is an image
 * @param {File} file - Selected file
 * @returns {boolean} True if valid image
 */
function validateImageFile(file) {
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if (!allowedTypes.includes(file.type)) {
        showAlert('Error', 'Hanya file gambar (JPG, PNG, GIF) yang diperbolehkan!', 'error');
        return false;
    }
    return true;
}

/**
 * Validate file size
 * @param {File} file - Selected file
 * @param {number} maxSizeMB - Maximum size in MB
 * @returns {boolean} True if file size is valid
 */
function validateFileSize(file, maxSizeMB) {
    const maxSizeBytes = maxSizeMB * 1024 * 1024;
    if (file.size > maxSizeBytes) {
        showAlert('Error', `Ukuran file maksimal ${maxSizeMB}MB!`, 'error');
        return false;
    }
    return true;
}

/**
 * Show image preview
 * @param {File} file - Selected image file
 */
function showImagePreview(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        const profilePhoto = document.querySelector('.profile-photo');
        if (profilePhoto) {
            profilePhoto.src = e.target.result;
            showAlert('Sukses', 'Preview foto profil berhasil dimuat!', 'success');
        }
    };
    reader.readAsDataURL(file);
}

// === FORM HANDLING ===
/**
 * Handle form submission
 * @param {Event} event - Form submit event
 */
function handleFormSubmit(event) {
    event.preventDefault();
    
    // Validate form
    if (!validateForm()) {
        return;
    }
    
    // Show loading state
    showLoadingState();
    
    // Simulate form submission (replace with actual AJAX call)
    setTimeout(() => {
        hideLoadingState();
        showAlert('Sukses', 'Profil berhasil diperbarui!', 'success');
        
        // If there's a new photo, upload it
        if (selectedFile) {
            uploadProfilePhoto(selectedFile);
        }
    }, 2000);
}

/**
 * Validate form fields
 * @returns {boolean} True if form is valid
 */
function validateForm() {
    const form = document.querySelector('form');
    if (!form) return true;
    
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    // Validate email format
    const emailField = form.querySelector('input[type="email"]');
    if (emailField && emailField.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            emailField.classList.add('is-invalid');
            isValid = false;
        }
    }
    
    if (!isValid) {
        showAlert('Error', 'Mohon lengkapi semua field yang wajib diisi!', 'error');
    }
    
    return isValid;
}

/**
 * Upload profile photo to server
 * @param {File} file - Image file to upload
 */
function uploadProfilePhoto(file) {
    // Create FormData for file upload
    const formData = new FormData();
    formData.append('profile_photo', file);
    
    // Here you would normally send the file to server
    // For now, we'll just show a success message
    console.log('Uploading profile photo:', file.name);
    showAlert('Info', 'Foto profil akan diupload ke server...', 'info');
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
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    }
}

/**
 * Hide loading state
 */
function hideLoadingState() {
    const submitBtn = document.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
    }
}

// === EVENT LISTENERS ===
document.addEventListener('DOMContentLoaded', function() {
    // Initialize profile layout
    initializeProfileLayout();
    
    // Add form submit handler
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }
    
    // Add file input change handler
    const fileInput = document.getElementById('profilePhotoInput');
    if (fileInput) {
        fileInput.addEventListener('change', handleFileSelection);
    }
    
    // Add real-time validation
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
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
    
    // Remove invalid class by default
    field.classList.remove('is-invalid');
    
    // Check if required field is empty
    if (field.hasAttribute('required') && !value) {
        field.classList.add('is-invalid');
        return;
    }
    
    // Validate email format
    if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            field.classList.add('is-invalid');
            return;
        }
    }
    
    // Validate phone number format
    if (field.type === 'tel' && value) {
        const phoneRegex = /^[\d\s\-\+\(\)]+$/;
        if (!phoneRegex.test(value)) {
            field.classList.add('is-invalid');
            return;
        }
    }
}

// === KEYBOARD SHORTCUTS ===
document.addEventListener('keydown', function(event) {
    // Ctrl/Cmd + S to save
    if ((event.ctrlKey || event.metaKey) && event.key === 's') {
        event.preventDefault();
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.click();
        }
    }
    
    // Escape to cancel photo selection
    if (event.key === 'Escape') {
        const fileInput = document.getElementById('profilePhotoInput');
        if (fileInput) {
            fileInput.value = '';
            selectedFile = null;
        }
    }
}); 