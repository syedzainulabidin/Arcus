document.addEventListener('DOMContentLoaded', function () {
    const wrappers = document.querySelectorAll('.input-wrapper');

    wrappers.forEach(wrapper => {
        const passwordInput = wrapper.querySelector('input[type="password"], input[type="text"]');
        const eyeIcon = wrapper.querySelector('i');

        if (passwordInput && eyeIcon) {
            eyeIcon.addEventListener('click', function () {
                const isHidden = passwordInput.type === 'password';
                passwordInput.type = isHidden ? 'text' : 'password';
                this.classList.toggle('bx-eye');
                this.classList.toggle('bx-eye-slash');
            });
        }
    });
});
