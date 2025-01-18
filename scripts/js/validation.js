document.addEventListener('DOMContentLoaded', () => {
    // Proposal Form Validation
    const proposalForm = document.getElementById('proposalForm');
    if (proposalForm) {
        proposalForm.addEventListener('submit', validateProposalForm);
    }
    
    // Login Form Validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', loginValidate);
    }

    // Registration Form Validation
    const registrationForm = document.getElementById('registrationForm');
    if (registrationForm) {
        registrationForm.addEventListener('submit', regValidate);
    }

    
});

function loginValidate(event) {
    event.preventDefault();
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    let valid = true;

    if (!email.value) {
        emailError.textContent = 'Email is required.';
        valid = false;
    } else if (!validateEmail(email.value)) {
        emailError.textContent = 'Invalid email format.';
        valid = false;
    } else {
        emailError.textContent = '';
    }

    

    if (!password.value) {
        passwordError.textContent = 'Password is required.';
        valid = false;
    } else {
        passwordError.textContent = '';
    }

    if (valid) {
        event.target.submit();
    }
}

function regValidate(event) {
    event.preventDefault();
    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const username = document.getElementById('username');
    const email = document.getElementById('emailAddress');
    const password = document.getElementById('userPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    const roleClient = document.getElementById('role_client');
    const roleDeveloper = document.getElementById('role_developer');
    const firstNameError = document.getElementById('firstNameError');
    const lastNameError = document.getElementById('lastNameError');
    const usernameError = document.getElementById('usernameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    const roleError = document.getElementById('roleError');

    let valid = true;

    if (!firstName.value) {
        firstNameError.textContent = 'First name is required.';
        valid = false;
    } else {
        firstNameError.textContent = '';
    }

    if (!lastName.value) {
        lastNameError.textContent = 'Last name is required.';
        valid = false;
    } else {
        lastNameError.textContent = '';
    }

    if (!username.value) {
        usernameError.textContent = 'Username is required.';
        valid = false;
    } else {
        usernameError.textContent = '';
    }

    if (!email.value) {
        emailError.textContent = 'Email is required.';
        valid = false;
    } else if (!validateEmail(email.value)) {
        emailError.textContent = 'Invalid email format.';
        valid = false;
    } else {
        emailError.textContent = '';
    }

    if (!password.value) {
        passwordError.textContent = 'Password is required.';
        valid = false;
    } else if (!validatePassword(password.value)) {
        passwordError.textContent = 'Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.';
        valid = false;
    } else {
        passwordError.textContent = '';
    }

    if (password.value !== confirmPassword.value) {
        confirmPasswordError.textContent = 'Passwords do not match.';
        valid = false;
    } else {
        confirmPasswordError.textContent = '';
    }

    if (!roleClient.checked && !roleDeveloper.checked) {
        roleError.textContent = 'Please select a role.';
        valid = false;
    } else {
        roleError.textContent = '';
    }

    if (valid) {
        event.target.submit();
    }
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePassword(password) {
    return password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /[^a-zA-Z0-9]/.test(password);
}

function validateProposalForm(event) {

    event.preventDefault();
    const proposalname = document.getElementById('proposalname');
    const description = document.getElementById('description');
    const proposaldeadline = document.getElementById('proposaldeadline');

    const nameError = document.getElementById('nameError');
    const descriptionError = document.getElementById('descriptionError');
    const deadlineError = document.getElementById('deadlineError');

    let valid = true;

    // Validate project name
    if (!proposalname.value) {
        nameError.textContent = 'Project name is required.';
        valid = false;
    } else {
        nameError.textContent = '';
    }

    // Validate project description
    if (!description.value) {
        descriptionError.textContent = 'Project description is required.';
        valid = false;
    } else {
        descriptionError.textContent = '';
    }

    // Validate deadline
    if (!proposaldeadline.value) {
        deadlineError.textContent = 'Deadline is required.';
        valid = false;
    } else {
        deadlineError.textContent = '';
    }

    // Submit the form if all fields are valid
    if (valid) {
        event.target.submit();
    }
}