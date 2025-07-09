// File: profil.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Profil Pengguna.
// Biasanya berisi script untuk mengubah data profil, upload foto profil, dan validasi form profil.

document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const btnUbah = document.getElementById('btnUbah');
    const btnSimpan = document.getElementById('btnSimpan');
    const btnBatal = document.getElementById('btnBatal');
    const fotoInput = document.getElementById('fotoInput');
    const fotoTokoInput = document.getElementById('fotoTokoInput');
    const profilImage = document.getElementById('profilImage');
    const profilTokoImage = document.getElementById('profilTokoImage');
    const profilForm = document.getElementById('profilForm');
    const profilTokoForm = document.getElementById('profilTokoForm');
    const cameraIcon = document.getElementById('cameraIcon');

    // Check if we're on profil page or profil toko page
    const isProfilToko = window.location.pathname.includes('profil-toko');
    const currentForm = isProfilToko ? profilTokoForm : profilForm;
    const currentFotoInput = isProfilToko ? fotoTokoInput : fotoInput;
    // Ganti: const currentImage = isProfilToko ? profilTokoImage : profilImage;

    // Initialize form state
    let originalFormData = {};

    // Save original form data
    if (currentForm) {
        const formData = new FormData(currentForm);
        for (let [key, value] of formData.entries()) {
            originalFormData[key] = value;
        }
    }

    // Edit button click handler
    if (btnUbah) {
        btnUbah.addEventListener('click', function() {
            enableFormEditing();
        });
    }

    // Cancel button click handler
    if (btnBatal) {
        btnBatal.addEventListener('click', function() {
            cancelEditing();
        });
    }

    // Save button click handler
    if (btnSimpan) {
        btnSimpan.addEventListener('click', function() {
            saveProfile();
        });
    }

    // Photo upload handler
    if (currentFotoInput) {
        currentFotoInput.addEventListener('change', function(e) {
            handlePhotoUpload(e);
        });
    }

    // Image click handler for photo upload (ubah ke icon kamera)
    if (cameraIcon && currentFotoInput) {
        cameraIcon.addEventListener('click', function() {
            currentFotoInput.click();
        });
    }

    // Enable form editing
    function enableFormEditing() {
        const inputs = currentForm.querySelectorAll('input[readonly], textarea[readonly]');
        
        inputs.forEach(input => {
            // Skip admin username field (has admin-readonly class)
            if (input.classList.contains('admin-readonly')) {
                return;
            }
            input.removeAttribute('readonly');
            input.classList.add('editing');
        });

        // Show/hide buttons using hidden attribute
        if (btnUbah) btnUbah.setAttribute('hidden', '');
        if (btnSimpan) btnSimpan.removeAttribute('hidden');
        if (btnBatal) btnBatal.removeAttribute('hidden');
    }

    // Cancel editing
    function cancelEditing() {
        const inputs = currentForm.querySelectorAll('input.editing, textarea.editing');
        
        inputs.forEach(input => {
            input.setAttribute('readonly', 'readonly');
            input.classList.remove('editing');
            // Restore original value
            if (originalFormData[input.name]) {
                input.value = originalFormData[input.name];
            }
        });

        // Show/hide buttons using hidden attribute
        if (btnUbah) btnUbah.removeAttribute('hidden');
        if (btnSimpan) btnSimpan.setAttribute('hidden', '');
        if (btnBatal) btnBatal.setAttribute('hidden', '');
    }

    // Save profile
    function saveProfile() {
        const formData = new FormData(currentForm);
        
        // Add photo file if selected
        if (currentFotoInput && currentFotoInput.files[0]) {
            formData.append('foto', currentFotoInput.files[0]);
        }

        // Fix URL calculation
        const url = isProfilToko ? 
            '/admin/profil-toko/update' : 
            '/' + (window.location.pathname.includes('admin') ? 'admin' : 'user') + '/profil/update';

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message || 'Profil berhasil diperbarui.');
                
                // Update session data if needed
                if (data.foto) {
                    // Update profile image
                    if (isProfilToko) {
                        fetch('/admin/profil-toko/data')
                            .then(res => res.json())
                            .then(profile => {
                                if (profile.foto) {
                                    const img = document.getElementById('profilTokoImage');
                                    if (img) img.src = '/uploads/profil/' + profile.foto + '?' + new Date().getTime();
                                }
                            });
                    } else {
                        fetch('/' + (window.location.pathname.includes('admin') ? 'admin' : 'user') + '/profil/data')
                            .then(res => res.json())
                            .then(profile => {
                                if (profile.foto) {
                                    const img = document.getElementById('profilImage');
                                    if (img) img.src = '/uploads/profil/' + profile.foto + '?' + new Date().getTime();
                                }
                            });
                    }
                    // Update header profile image
                    const headerProfileImg = document.querySelector('.header-profile-img');
                    if (headerProfileImg) {
                        headerProfileImg.src = '/uploads/profil/' + data.foto + '?' + new Date().getTime();
                    }
                }

                // Save new form data as original
                const newFormData = new FormData(currentForm);
                for (let [key, value] of newFormData.entries()) {
                    originalFormData[key] = value;
                }

                // Disable editing
                cancelEditing();
            } else {
                alert(data.message || 'Maaf, terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error saving profile:', error);
            alert('Maaf, terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        });
    }

    // Handle photo upload
    function handlePhotoUpload(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Tipe file tidak didukung. Silakan gunakan JPG, PNG, atau GIF.');
            return;
        }

        // Validate file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            return;
        }

        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            if (isProfilToko) {
                const img = document.getElementById('profilTokoImage');
                if (img) img.src = e.target.result;
            } else {
                const img = document.getElementById('profilImage');
                if (img) img.src = e.target.result;
            }
        };
        reader.readAsDataURL(file);

        // Auto save photo
        const formData = new FormData();
        formData.append('foto', file);

        // Fix URL calculation
        const url = isProfilToko ? 
            '/admin/profil-toko/update-foto' : 
            '/' + (window.location.pathname.includes('admin') ? 'admin' : 'user') + '/profil/update-foto';

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message || 'Foto profil berhasil diperbarui.');
                // Update profile image and header without reload
                if (data.foto) {
                    if (isProfilToko) {
                        fetch('/admin/profil-toko/data')
                            .then(res => res.json())
                            .then(profile => {
                                if (profile.foto) {
                                    const img = document.getElementById('profilTokoImage');
                                    if (img) img.src = '/uploads/profil/' + profile.foto + '?' + new Date().getTime();
                                }
                            });
                    } else {
                        fetch('/' + (window.location.pathname.includes('admin') ? 'admin' : 'user') + '/profil/data')
                            .then(res => res.json())
                            .then(profile => {
                                if (profile.foto) {
                                    const img = document.getElementById('profilImage');
                                    if (img) img.src = '/uploads/profil/' + profile.foto + '?' + new Date().getTime();
                                }
                            });
                        // Update header profile image hanya jika user ganti foto profil
                        const headerProfileImg = document.querySelector('.header-profile-img');
                        if (headerProfileImg) {
                            headerProfileImg.src = '/uploads/profil/' + data.foto + '?' + new Date().getTime();
                        }
                    }
                }
            } else {
                alert(data.message || 'Maaf, terjadi kesalahan saat upload foto. Silakan coba lagi.');
                // Revert image if upload failed
                if (isProfilToko) {
                    const img = document.getElementById('profilTokoImage');
                    if (img) img.src = img.dataset.originalSrc || img.src;
                } else {
                    const img = document.getElementById('profilImage');
                    if (img) img.src = img.dataset.originalSrc || img.src;
                }
            }
        })
        .catch(error => {
            console.error('Error uploading photo:', error);
            alert('Maaf, terjadi kesalahan saat upload foto. Silakan coba lagi.');
            // Revert image if upload failed
            if (isProfilToko) {
                const img = document.getElementById('profilTokoImage');
                if (img) img.src = img.dataset.originalSrc || img.src;
            } else {
                const img = document.getElementById('profilImage');
                if (img) img.src = img.dataset.originalSrc || img.src;
            }
        });
    }

    // Store original image src
    if (isProfilToko) {
        const currentImage = profilTokoImage;
        if (currentImage) {
            currentImage.dataset.originalSrc = currentImage.src;
        }
    } else {
        const currentImage = profilImage;
        if (currentImage) {
            currentImage.dataset.originalSrc = currentImage.src;
        }
    }
});
