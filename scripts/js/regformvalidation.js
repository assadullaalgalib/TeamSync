document.getElementById("registrationForm").addEventListener("submit", function (event) {
    
    let errors = [];
    let firstName = document.getElementById("first_name").value.trim();
    let lastName = document.getElementById("last_name").value.trim();
    let username = document.getElementById("username").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm_password").value;
    const roleRadios = document.getElementsByName("role");

    // Validate role
    let isRoleSelected = false;
    for (const radio of roleRadios) {
        if (radio.checked) {
            isRoleSelected = true;
            break;
        }
    }

    // Validate role
    if (!isRoleSelected) {
        errors.push("Role is required.");
    }

    // Validate first name
    if (firstName === "") {
        errors.push("First name is required.");
    }

    // Validate last name
    if (lastName === "") {
        errors.push("Last name is required.");
    }

    // Validate username
    if (username === "") {
        errors.push("Username is required.");
    }

    // Validate email
    if (email === "") {
        errors.push("Email is required.");
    } else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        errors.push("Invalid email format.");
    }

    // Validate password
    if (password.length < 8 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[^a-zA-Z0-9]/.test(password)) {
        errors.push("Password must be at least 8 characters long, with at least one uppercase, one lowercase, and one special character.");
    }

    // Validate confirm password
    if (password !== confirmPassword) {
        errors.push("Passwords do not match.");
    }

    // If there are errors, prevent form submission and show alert
    if (errors.length > 0) {
        alert(errors.join("\n"));
        event.preventDefault();
    }
});