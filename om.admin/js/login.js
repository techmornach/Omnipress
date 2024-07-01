const forgotPasswordForm = document.getElementById("forgot-password");
const loginForm = document.getElementById("login");
const forgotPasswordButton = document.getElementById("forgot-password-button");
const loginButton = document.getElementById("login-button");

// Function to get URL parameters
function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Function to set URL parameter
function setUrlParameter(name, value) {
    const urlParams = new URLSearchParams(window.location.search);
    if (value) {
        urlParams.set(name, value);
    } else {
        urlParams.delete(name);
    }
    window.history.replaceState(
        {},
        "",
        `${window.location.pathname}?${urlParams}`
    );
}

// Check URL parameter on page load
if (getUrlParameter("forgot-password")) {
    loginForm.setAttribute("class", "hidden");
    forgotPasswordForm.setAttribute("class", "form");
} else {
    forgotPasswordForm.setAttribute("class", "hidden");
    loginForm.setAttribute("class", "form");
}

forgotPasswordButton.onclick = (e) => {
    e.preventDefault();
    loginForm.setAttribute("class", "hidden");
    forgotPasswordForm.setAttribute("class", "form");
    setUrlParameter("forgot-password", "true");
};

loginButton.onclick = (e) => {
    e.preventDefault();
    forgotPasswordForm.setAttribute("class", "hidden");
    loginForm.setAttribute("class", "form");
    setUrlParameter("forgot-password", null);
};
