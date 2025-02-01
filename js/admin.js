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
