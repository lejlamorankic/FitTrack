
const pages = [
    "dashboard",
    "exercises",
    "workouts",
    "meals",
    "hydration",
    "progress",
    "profile",
    "login",
    "register"
];

async function loadPage() {

    const page =
        window.location.hash.substring(1) || "dashboard";

    const container =
        document.getElementById("app-content");

    if (!container) {
        return;
    }

    if (!pages.includes(page)) {
        container.innerHTML =
            "<h2>404 - Page Not Found</h2>";
        return;
    }

    try {

        const response = await fetch(
            `views/${page}.html`
        );

        if (!response.ok) {
            throw new Error("Page not found");
        }

        const html = await response.text();

        container.innerHTML = html;

        // Highlight active sidebar link
        document.querySelectorAll(
            ".sb-sidenav .nav-link"
        ).forEach(link => {

            link.classList.toggle(
                "active",
                link.getAttribute("href") === `#${page}`
            );

        });

    } catch (error) {

        container.innerHTML = `
            <div class="alert alert-warning">
                This page is not available yet.
            </div>
        `;

        console.error(error);
    }
}

window.addEventListener(
    "hashchange",
    loadPage
);

window.addEventListener(
    "DOMContentLoaded",
    loadPage
);



/* Temporary form handling for Milestone 1 */

document.addEventListener("submit", function (event) {

    if (event.target.id === "loginForm") {
        event.preventDefault();

        alert("Login functionality will be available in a future milestone.");
    }

    if (event.target.id === "registerForm") {
        event.preventDefault();

        const password = document.getElementById("registerPassword").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return;
        }

        alert("Registration functionality will be available in a future milestone.");
    }

});
