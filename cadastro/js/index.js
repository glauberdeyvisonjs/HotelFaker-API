function showPassword() {
    const eye = document.getElementById('eye');
    const eyeSlash = document.getElementById('eye-slash');
    const fieldPassword = document.getElementById('field-password');

    if (eye.style.display === 'none') {
        eye.style.display = 'block';
        eyeSlash.style.display = 'none';
        fieldPassword.type = 'text';
    } else {
        eye.style.display = 'none';
        eyeSlash.style.display = 'block';
        fieldPassword.type = 'password';
    }

}

function showPasswordC() {
    const eyeC = document.getElementById('eye-c');
    const eyeSlashC = document.getElementById('eye-slash-c');
    const fieldPasswordC = document.getElementById('field-password-c');

    if (eyeC.style.display === 'none') {
        eyeC.style.display = 'block';
        eyeSlashC.style.display = 'none';
        fieldPasswordC.type = 'text';
    } else {
        eyeC.style.display = 'none';
        eyeSlashC.style.display = 'block';
        fieldPasswordC.type = 'password';
    }

}

document.getElementById('btn-cadastro').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Você foi cadastrado com sucesso!')
})