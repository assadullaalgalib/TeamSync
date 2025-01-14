document.getElementById("loginForm").addEventListener("submit", function (event) {
    
    let errors = [];
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;

    // Validate email
    if (email === "") {
        errors.push("Email is required.");
    } else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        errors.push("Invalid email format.");
    }

    // Validate password
    if (password === "") {
        errors.push("Password is required.");
    } else if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[^a-zA-Z0-9]/.test(password)) {
        errors.push("Password must contain at least one uppercase letter, one lowercase letter, and one special character.");
    }

    // If there are errors, prevent form submission and show alert
    if (errors.length > 0) {
        alert(errors.join("\n"));
        event.preventDefault();
    }
});
