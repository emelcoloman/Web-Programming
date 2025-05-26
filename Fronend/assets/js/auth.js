document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login");
    const logoutBtn = document.getElementById("logoutBtn");
    const authModal = document.getElementById("authModal");

    // LOGIN SUBMIT HANDLER
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent reload

            const email = document.getElementById("loginEmail").value;
            const password = document.getElementById("loginPassword").value;

            fetch("http://localhost/EmelColoman/Web-Programming/Backend/auth/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ email, password }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.success) {
                        localStorage.setItem("user", JSON.stringify(data.user));
                        if (authModal) authModal.style.display = "none";
                        updateNavbar(data.user.role);
                        window.location.hash = "#home";
                    } else {
                        alert(data.message || "Invalid credentials");
                    }
                })
                .catch((err) => {
                    console.error("Login error:", err);
                });
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
});
