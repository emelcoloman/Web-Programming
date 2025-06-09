document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login");
    const registerForm = document.getElementById("register");
    const logoutBtn = document.getElementById("logoutBtn");
    const authModal = document.getElementById("authModal");

    // Helper: get users from localStorage or empty array
    function getUsers() {
        return JSON.parse(localStorage.getItem("mockUsers") || "[]");
    }

    // Helper: save users array to localStorage
    function saveUsers(users) {
        localStorage.setItem("mockUsers", JSON.stringify(users));
    }

    // LOGIN SUBMIT HANDLER
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const email = document.getElementById("loginEmail").value.trim();
            const password = document.getElementById("loginPassword").value;

            const users = getUsers();
            const user = users.find(u => u.email === email && u.password === password);

            if (user) {
                // Save user to localStorage as logged in
                localStorage.setItem("user", JSON.stringify(user));
                if (authModal) authModal.style.display = "none";
                updateNavbar(user.role);
                window.location.hash = "#home";
            } else {
                alert("Invalid email or password.");
            }
        });
    }

    // REGISTER SUBMIT HANDLER
    if (registerForm) {
        registerForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const email = document.getElementById("registerEmail").value.trim();
            const password = document.getElementById("registerPassword").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return;
            }

            const users = getUsers();
            const exists = users.some(u => u.email === email);
            if (exists) {
                alert("User with this email already exists.");
                return;
            }

            // Save new user with default role "user"
            const newUser = { email, password, role: "user" };
            users.push(newUser);
            saveUsers(users);

            alert("Registration successful. Please log in.");
            // Switch to login form after registration
            document.getElementById("registerForm").style.display = "none";
            document.getElementById("loginForm").style.display = "block";
        });
    }

    // LOGOUT BUTTON HANDLER
    if (logoutBtn) {
        logoutBtn.addEventListener("click", function () {
            localStorage.removeItem("user");
            updateNavbar(null);
            window.location.hash = "#home";
        });
    }

    // INITIALIZE NAVBAR ON PAGE LOAD
    const existingUser = JSON.parse(localStorage.getItem("user"));
    if (existingUser) {
        updateNavbar(existingUser.role);
    } else {
        updateNavbar(null);
    }

    // NAVBAR ROLE-BASED UPDATE FUNCTION
    function updateNavbar(role) {
        const menu = document.getElementById("roleBasedMenu");
        const logoutBtn = document.getElementById("logoutBtn");

        if (menu) menu.innerHTML = "";

        if (role === "admin") {
            menu.innerHTML = `<li class="nav-item"><a class="nav-link" href="#admin">Admin Dashboard</a></li>`;
        } else if (role === "user") {
            menu.innerHTML = `<li class="nav-item"><a class="nav-link" href="#profile">My Profile</a></li>`;
        }

        if (logoutBtn) {
            if (role) {
                logoutBtn.classList.remove("d-none");
            } else {
                logoutBtn.classList.add("d-none");
            }
        }
    }

    // TOGGLE BETWEEN LOGIN AND REGISTER FORM LINKS
    const showRegister = document.getElementById("showRegister");
    const showLogin = document.getElementById("showLogin");

    if (showRegister) {
        showRegister.addEventListener("click", (e) => {
            e.preventDefault();
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("registerForm").style.display = "block";
        });
    }

    if (showLogin) {
        showLogin.addEventListener("click", (e) => {
            e.preventDefault();
            document.getElementById("registerForm").style.display = "none";
            document.getElementById("loginForm").style.display = "block";
        });
    }
});
