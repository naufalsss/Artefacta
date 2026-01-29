document.addEventListener('DOMContentLoaded', function() {
    // Form switching functionality
    const daftarForm = document.getElementById('daftarForm');
    const loginForm = document.getElementById('loginForm');
    const switchToDaftar = document.getElementById('switchToDaftar');
    const switchToLogin = document.getElementById('switchToLogin');
    const headerTitle = document.getElementById('headerTitle');
    const headerSubtitle = document.getElementById('headerSubtitle');
    const authWrapper = document.querySelector('.auth-wrapper') || document.querySelector('.login-wrapper');

    // Initialize - show login form by default
    let currentForm = 'login';
    
    // Form switching
    function switchForm(form) {
        currentForm = form;
        
        if (form === 'login') {
            loginForm.classList.add('active');
            daftarForm.classList.remove('active');
            headerTitle.textContent = 'Masuk ke Museum';
            headerSubtitle.textContent = 'Silakan masukkan email dan password Anda';
        } else {
            daftarForm.classList.add('active');
            loginForm.classList.remove('active');
            headerTitle.textContent = 'Selamat Datang di Museum';
            headerSubtitle.textContent = 'Silakan lengkapi data diri Anda untuk mendaftar';
        }
        
        // Clear all form errors
        clearAllErrors();
    }

    if (switchToDaftar && switchToLogin) {
        switchToDaftar.addEventListener('click', () => switchForm('daftar'));
        switchToLogin.addEventListener('click', () => switchForm('login'));
    }

    // Password toggle functionality (for multiple forms)
    document.querySelectorAll('.toggle-password').forEach(toggleBtn => {
        toggleBtn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            
            if (passwordInput) {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Animate toggle button
                this.style.transform = 'translateY(-50%) scale(0.9)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-50%) scale(1)';
                }, 150);
                
                // Update eye icon
                const eyeIcon = this.querySelector('.eye-icon');
                if (type === 'password') {
                    eyeIcon.textContent = '👁️';
                } else {
                    eyeIcon.textContent = '🙈';
                }
            }
        });
    });

    // Add entrance animation to form groups
    function animateFormGroups(form) {
        const formGroups = form.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.opacity = '0';
            group.style.transform = 'translateX(-30px)';
            setTimeout(() => {
                group.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                group.style.opacity = '1';
                group.style.transform = 'translateX(0)';
            }, 200 + (index * 100));
        });
    }

    // Animate current form on load
    if (loginForm) animateFormGroups(loginForm);

    // Setup form validation and submission
    setupForm(daftarForm, 'daftar');
    //setupForm(loginForm, 'login');

    function setupForm(form, formType) {
        if (!form) return;

        const inputs = form.querySelectorAll('input, select');
        const submitBtn = form.querySelector('.submit-btn');

        // Real-time validation with animations
        inputs.forEach(input => {
            // Add focus animation
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
                validateField(this, formType);
            });

            input.addEventListener('input', function() {
                // Remove error styling on input with animation
                if (this.classList.contains('invalid')) {
                    clearFieldError(this);
                }
                
                // Add typing animation
                if (this.value.length > 0 && !this.classList.contains('valid')) {
                    this.style.transform = 'scale(1.01)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                }
            });

            // Add hover effect animation
            input.addEventListener('mouseenter', function() {
                if (!this.matches(':focus')) {
                    this.style.transform = 'translateY(-1px)';
                    this.style.transition = 'all 0.3s ease';
                }
            });

            input.addEventListener('mouseleave', function() {
                if (!this.matches(':focus')) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            
            // Validate all fields
            inputs.forEach(input => {
                if (!validateField(input, formType)) {
                    isValid = false;
                }
            });

            if (isValid) {
                submitForm(form, formType, submitBtn);
            } else {
                // Animate wrapper shake
                if (authWrapper) {
                    authWrapper.style.animation = 'none';
                    setTimeout(() => {
                        authWrapper.style.animation = 'shakeForm 0.5s ease';
                    }, 10);
                }
                
                // Scroll to first error with smooth animation
                const firstError = form.querySelector('.invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => {
                        firstError.focus();
                        firstError.style.animation = 'pulseError 0.6s ease';
                    }, 500);
                }
            }
        });
    }

    // Add shake animation for form
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shakeForm {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
            20%, 40%, 60%, 80% { transform: translateX(10px); }
        }
        @keyframes pulseError {
            0%, 100% { box-shadow: 0 0 0 0 rgba(205, 92, 92, 0.7); }
            50% { box-shadow: 0 0 0 10px rgba(205, 92, 92, 0); }
        }
        @keyframes successPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        @keyframes ripple {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    function validateField(field, formType) {
        const fieldName = field.name;
        const fieldId = field.id;
        const fieldValue = field.value.trim();
        const errorElement = document.getElementById(`error-${fieldId}`);

        clearFieldError(field, fieldId);

        // Required field validation
        if (field.hasAttribute('required') && !fieldValue) {
            showFieldError(field, errorElement, `${getFieldLabel(fieldName)} harus diisi`);
            return false;
        }

        // Specific validations for daftar form
        if (formType === 'daftar') {
            switch(fieldName) {
                case 'nama':
                    if (fieldValue.length < 3) {
                        showFieldError(field, errorElement, 'Nama minimal 3 karakter');
                        return false;
                    }
                    if (!/^[a-zA-Z\s]+$/.test(fieldValue)) {
                        showFieldError(field, errorElement, 'Nama hanya boleh mengandung huruf');
                        return false;
                    }
                    break;

                case 'umur':
                    const umur = parseInt(fieldValue);
                    if (isNaN(umur) || umur < 1 || umur > 120) {
                        showFieldError(field, errorElement, 'Umur harus antara 1-120 tahun');
                        return false;
                    }
                    break;

                case 'email':
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(fieldValue)) {
                        showFieldError(field, errorElement, 'Format email tidak valid');
                        return false;
                    }
                    if (!fieldValue.includes('@gmail.com')) {
                        showFieldError(field, errorElement, 'Harus menggunakan email Gmail');
                        return false;
                    }
                    break;

                case 'password':
                    if (fieldValue.length < 6) {
                        showFieldError(field, errorElement, 'Password minimal 6 karakter');
                        return false;
                    }
                    if (fieldValue.length > 50) {
                        showFieldError(field, errorElement, 'Password maksimal 50 karakter');
                        return false;
                    }
                    break;
            }
        }

        // Validation for login form
        if (formType === 'login') {
            switch(fieldName) {
                case 'email':
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(fieldValue)) {
                        showFieldError(field, errorElement, 'Format email tidak valid');
                        return false;
                    }
                    break;

                case 'password':
                    if (fieldValue.length < 6) {
                        showFieldError(field, errorElement, 'Password minimal 6 karakter');
                        return false;
                    }
                    break;
            }
        }

        // Mark as valid with animation
        field.classList.remove('invalid');
        field.classList.add('valid');
        
        // Add success animation
        field.style.animation = 'successPulse 0.4s ease';
        setTimeout(() => {
            field.style.animation = '';
        }, 400);
        
        return true;
    }

    function showFieldError(field, errorElement, message) {
        field.classList.remove('valid');
        field.classList.add('invalid');
        
        // Add error animation
        field.style.animation = 'shakeInput 0.5s ease';
        
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.opacity = '0';
            errorElement.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                errorElement.style.transition = 'all 0.3s ease';
                errorElement.style.opacity = '1';
                errorElement.style.transform = 'translateY(0)';
            }, 10);
        }
    }

    function clearFieldError(field, fieldId) {
        const errorElement = document.getElementById(`error-${fieldId}`);
        field.classList.remove('invalid', 'valid');
        
        if (errorElement) {
            errorElement.style.transition = 'all 0.3s ease';
            errorElement.style.opacity = '0';
            errorElement.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                errorElement.textContent = '';
            }, 300);
        }
        
        field.style.animation = '';
    }

    function clearAllErrors() {
        document.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
            el.style.opacity = '0';
        });
        document.querySelectorAll('input, select').forEach(field => {
            field.classList.remove('invalid', 'valid');
            field.style.animation = '';
        });
    }

    function getFieldLabel(fieldName) {
        const labels = {
            'nama': 'Nama',
            'jenis_kelamin': 'Jenis Kelamin',
            'umur': 'Umur',
            'status': 'Status',
            'email': 'Email',
            'password': 'Password'
        };
        return labels[fieldName] || fieldName;
    }

    function submitForm(form, formType, submitBtn) {
        // Create ripple effect
        const ripple = document.createElement('span');
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            width: 20px;
            height: 20px;
            margin-top: -10px;
            margin-left: -10px;
            pointer-events: none;
            animation: ripple 0.6s ease-out;
        `;
        submitBtn.style.position = 'relative';
        submitBtn.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);

        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        submitBtn.querySelector('.btn-text').style.display = 'none';
        submitBtn.querySelector('.btn-loader').style.display = 'inline-block';

        // Animate wrapper on success
        if (authWrapper) {
            authWrapper.style.animation = 'successPulse 0.6s ease';
        }

        // Get form data
        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        console.log(`${formType === 'daftar' ? 'Daftar' : 'Login'} Data:`, data);

        // Get CSRF token (dari form atau meta tag)
        let token = data['_token'] || '';
        if (!token) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            token = csrfToken ? csrfToken.getAttribute('content') : '';
        }

        // Determine API endpoint
        const apiUrl = formType === 'daftar' ? '/register' : '/login';

        // Function to show message
        function showMessage(message, isSuccess = true) {
            const msg = document.createElement('div');
            msg.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, ${isSuccess ? '#8B9A46 0%, #6B8E23 100%' : '#CD5C5C 0%, #B22222 100%'});
                color: white;
                padding: 20px 30px;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                z-index: 10000;
                animation: slideInRight 0.5s ease;
                font-weight: 600;
                font-size: 16px;
                max-width: 400px;
            `;
            msg.textContent = message;
            document.body.appendChild(msg);

            // Add slide in animation if not exists
            if (!document.getElementById('slideInRightStyle')) {
                const successStyle = document.createElement('style');
                successStyle.id = 'slideInRightStyle';
                successStyle.textContent = `
                    @keyframes slideInRight {
                        from {
                            transform: translateX(400px);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }
                `;
                document.head.appendChild(successStyle);
            }

            setTimeout(() => {
                msg.style.transition = 'all 0.5s ease';
                msg.style.transform = 'translateX(400px)';
                msg.style.opacity = '0';
                setTimeout(() => {
                    msg.remove();
                }, 500);
            }, 3000);
        }

        // Send data to Laravel backend
        console.log('Sending request with data:', data);
        console.log('CSRF Token:', token);
        
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Success animation
                if (authWrapper) {
                    authWrapper.style.animation = 'successBounce 0.8s ease';
                }
                
                // Show success message
                showMessage(`✓ ${result.message}`, true);
                
                // Reset form
                setTimeout(() => {
                    form.reset();
                    const inputs = form.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        input.classList.remove('valid', 'invalid');
                        input.style.animation = '';
                    });
                    
                    if (authWrapper) {
                        authWrapper.style.animation = '';
                    }

                    // Redirect based on response
                    if (result.redirect) {
                        window.location.href = result.redirect;
                    } else {
                        // If daftar success, switch to login
                        if (formType === 'daftar') {
                            setTimeout(() => {
                                switchForm('login');
                            }, 500);
                        }
                    }
                }, 1500);
            } else {
                // Handle validation errors
                if (result.errors) {
                    Object.keys(result.errors).forEach(fieldName => {
                        const field = form.querySelector(`[name="${fieldName}"]`);
                        const fieldId = field ? field.id : null;
                        if (field && fieldId) {
                            const errorElement = document.getElementById(`error-${fieldId}`);
                            if (errorElement) {
                                showFieldError(field, errorElement, result.errors[fieldName][0]);
                            }
                        }
                    });
                    showMessage(`✗ ${result.message}`, false);
                } else {
                    showMessage(`✗ ${result.message}`, false);
                }
                
                if (authWrapper) {
                    authWrapper.style.animation = 'shakeForm 0.5s ease';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('✗ Terjadi kesalahan. Silakan coba lagi.', false);
            if (authWrapper) {
                authWrapper.style.animation = 'shakeForm 0.5s ease';
            }
        })
        .finally(() => {
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.classList.remove('loading');
            submitBtn.querySelector('.btn-text').style.display = 'inline';
            submitBtn.querySelector('.btn-loader').style.display = 'none';
        });
    }
});
