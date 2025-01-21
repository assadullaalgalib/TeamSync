/* document.addEventListener('DOMContentLoaded', () => {
    // Proposal Form Validation
    var proposalForm = document.getElementById('proposalForm');
    if (proposalForm) {
        proposalForm.addEventListener('submit', validateProposalForm);
    }
    
    // Login Form Validation
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', loginValidate);
    }

    // Registration Form Validation
    var registrationForm = document.getElementById('registrationForm');
    if (registrationForm) {
        registrationForm.addEventListener('submit', regValidate);
    }

    
}); */

function loginValidate(event) {
    event.preventDefault();
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var emailError = document.getElementById('emailError');
    var passwordError = document.getElementById('passwordError');

    let valid = true;

    if (!email.value) {
        emailError.innerHTML = 'Email is required.';
        valid = false;
    } else if (!validateEmail(email.value)) {
        emailError.innerHTML = 'Invalid email format.';
        valid = false;
    } else {
        emailError.innerHTML = '';
    }
   

    if (!password.value) {
        passwordError.innerHTML = 'Password is required.';
        valid = false;
    } else {
        passwordError.innerHTML = '';
    }

    if (valid) {
        event.target.submit();
    }
}

function regValidate(event) {
    event.preventDefault();
    var firstName = document.getElementById('firstName');
    var lastName = document.getElementById('lastName');
    var username = document.getElementById('username');
    var email = document.getElementById('emailAddress');
    var password = document.getElementById('userPassword');
    var confirmPassword = document.getElementById('confirmPassword');
    var roleClient = document.getElementById('role_client');
    var roleDeveloper = document.getElementById('role_developer');
    var firstNameError = document.getElementById('firstNameError');
    var lastNameError = document.getElementById('lastNameError');
    var usernameError = document.getElementById('usernameError');
    var emailError = document.getElementById('emailError');
    var passwordError = document.getElementById('passwordError');
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    var roleError = document.getElementById('roleError');

    let valid = true;

    if (!firstName.value) {
        firstNameError.innerHTML = 'First name is required.';
        valid = false;
    } else {
        firstNameError.innerHTML = '';
    }

    if (!lastName.value) {
        lastNameError.innerHTML = 'Last name is required.';
        valid = false;
    } else {
        lastNameError.innerHTML = '';
    }

    if (!username.value) {
        usernameError.innerHTML = 'Username is required.';
        valid = false;
    } else {
        usernameError.innerHTML = '';
    }

    if (!email.value) {
        emailError.innerHTML = 'Email is required.';
        valid = false;
    } else if (!validateEmail(email.value)) {
        emailError.innerHTML = 'Invalid email format.';
        valid = false;
    } else {
        emailError.innerHTML = '';
    }

    if (!password.value) {
        passwordError.innerHTML = 'Password is required.';
        valid = false;
    } else if (!validatePassword(password.value)) {
        passwordError.innerHTML = 'Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.';
        valid = false;
    } else {
        passwordError.innerHTML = '';
    }

    if (password.value !== confirmPassword.value) {
        confirmPasswordError.innerHTML = 'Passwords do not match.';
        valid = false;
    } else {
        confirmPasswordError.innerHTML = '';
    }

    if (!roleClient.checked && !roleDeveloper.checked) {
        roleError.innerHTML = 'Please select a role.';
        valid = false;
    } else {
        roleError.innerHTML = '';
    }

    if (valid) {
        event.target.submit();
    }
}

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePassword(password) {
    return password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /[^a-zA-Z0-9]/.test(password);
}

function validateProposalForm(event) {

    event.preventDefault();
    var proposalname = document.getElementById('proposalname');
    var description = document.getElementById('description');
    var proposaldeadline = document.getElementById('proposaldeadline');

    var nameError = document.getElementById('nameError');
    var descriptionError = document.getElementById('descriptionError');
    var deadlineError = document.getElementById('deadlineError');

    let valid = true;

    // Validate project name
    if (!proposalname.value) {
        nameError.innerHTML = 'Project name is required.';
        valid = false;
    } else {
        nameError.innerHTML = '';
    }

    // Validate project description
    if (!description.value) {
        descriptionError.innerHTML = 'Project description is required.';
        valid = false;
    } else {
        descriptionError.innerHTML = '';
    }

    // Validate deadline
    if (!proposaldeadline.value) {
        deadlineError.innerHTML = 'Deadline is required.';
        valid = false;
    } else {
        deadlineError.innerHTML = '';
    }

    // Submit the form if all fields are valid
    if (valid) {
        event.target.submit();
    }
}