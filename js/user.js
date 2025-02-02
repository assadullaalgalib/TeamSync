function showFileInput() {
    document.getElementById('profile_picture').style.display = 'block';
}

function previewImage(event) {
    var preview = document.getElementById('current-profile-pic');
    var file = event.target.files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

function deleteProfilePicture() {
    if (confirm('Are you sure you want to delete your profile picture?')) {
        document.getElementById('delete-profile-picture-form').submit();
    }
}

function deleteAccount() {
    if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        document.getElementById('delete-account-form').submit();
    }
}
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

function validateEditProfileForm(event) {
    event.preventDefault();
    var firstName = document.getElementById('firstname');
    var lastName = document.getElementById('lastname');
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var confirmPassword = document.getElementById('confirm_password');
    var profilePicture = document.getElementById('profile_picture');

    var firstNameError = document.getElementById('firstNameError');
    var lastNameError = document.getElementById('lastNameError');
    var usernameError = document.getElementById('usernameError');
    var emailError = document.getElementById('emailError');
    var passwordError = document.getElementById('passwordError');
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    var fileError = document.getElementById('fileError');

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

    if (password.value && !validatePassword(password.value)) {
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

    if (profilePicture.files.length > 0 && !validateFileType(profilePicture.files[0])) {
        fileError.innerHTML = 'Invalid file type or size. Only jpeg, jpg, gif, and png are allowed and must be less than 5MB.';
        valid = false;
    } else {
        fileError.innerHTML = '';
    }

    if (valid) {
        event.target.submit();
    }
}

function validateFileType(file) {
    var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    var maxSize = 5 * 1024 * 1024; // 5MB in bytes
    if (!allowedTypes.includes(file.type)) {
        return false;
    }
    if (file.size > maxSize) {
        return false;
    }
    return true;
}