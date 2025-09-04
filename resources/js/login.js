// Login form functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Login form initialized');
    
    const form = document.getElementById('login-form');
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('password-toggle');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeOffIcon = document.getElementById('eye-off-icon');
    const submitButton = document.getElementById('submit-button');
    const loadingText = document.getElementById('loading-text');
    const defaultText = document.getElementById('default-text');

    // Password visibility toggle
    if (passwordToggle && passwordInput) {
        passwordToggle.addEventListener('click', function() {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            
            if (eyeIcon && eyeOffIcon) {
                eyeIcon.style.display = isPassword ? 'none' : 'block';
                eyeOffIcon.style.display = isPassword ? 'block' : 'none';
            }
        });
    }

    // Form submission loading state
    if (form && submitButton) {
        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            if (loadingText && defaultText) {
                loadingText.style.display = 'flex';
                defaultText.style.display = 'none';
            }
        });
    }
});
