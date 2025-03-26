document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("authModal");
    const userIcon = document.getElementById("userIcon");
    const closeModalBtn = document.querySelector(".close");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const showRegister = document.getElementById("showRegister");
    const showLogin = document.getElementById("showLogin");
    const registerBtn = document.getElementById("registerBtn");

    if (!modal || !userIcon || !closeModalBtn || !loginForm || !registerForm || !showRegister || !showLogin || !registerBtn) {
        console.error("Modal elements not found!");
        return;
    }

    // Ensure modal starts hidden
    modal.style.display = "none";

    // Open modal when user icon is clicked
    userIcon.addEventListener("click", (e) => {
        e.preventDefault();
        modal.style.display = "flex"; // Show modal
    });

    // Close modal
    closeModalBtn.addEventListener("click", () => {
        modal.style.display = "none"; // Hide modal
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none"; // Hide modal when clicking outside
        }
    });

    // Switch to Register
    showRegister.addEventListener("click", (e) => {
        e.preventDefault();
        loginForm.style.display = "none"; // Hide login form
        registerForm.style.display = "block"; // Show register form
    });

    // Switch to Login
    showLogin.addEventListener("click", (e) => {
        e.preventDefault();
        registerForm.style.display = "none"; // Hide register form
        loginForm.style.display = "block"; // Show login form
    });

    // Validate Registration
    registerBtn.addEventListener("click", (e) => {
        e.preventDefault();

        const email = document.getElementById("registerEmail").value;
        const password = document.getElementById("registerPassword").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        if (!validateEmail(email)) {
            alert("Invalid email format!");
            return;
        }

        if (!validatePassword(password)) {
            alert("Password must be at least 6 characters long and contain a number!");
            return;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return;
        }

        alert("Registration Successful!");
        // Optionally, you can redirect to login page or close the modal
        modal.style.display = "none";
    });

    // Email Validation
    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Password Validation (Min 6 chars, at least 1 number)
    function validatePassword(password) {
        return /^(?=.*\d)[A-Za-z\d]{6,}$/.test(password);
    }

    // Dynamically load content with hashchange listener
    function loadContent() {
        const hash = window.location.hash;
        console.log("Current Hash:", hash);

        const section = document.querySelector(hash);
        console.log("Selected section:", section);

        if (section && section.hasAttribute('data-load')) {
            const url = section.getAttribute('data-load');

            if (!section.innerHTML.trim()) {
                document.querySelectorAll('section').forEach(sec => {
                    sec.innerHTML = '';
                });

                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        section.innerHTML = data;

                        const navHeight = document.querySelector('nav').offsetHeight;
                        window.scrollTo(0, navHeight);
                    })
                    .catch(error => {
                        console.error('Error loading content:', error);
                    });
            }
        } else {
            console.error("No data-load attribute or section found for hash:", hash);
        }
    }

    loadContent();
    window.addEventListener('hashchange', loadContent);
});
