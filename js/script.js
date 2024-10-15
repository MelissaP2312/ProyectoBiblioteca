$(document).ready(function() {
    $('#password').on('keyup', function() {
        var password = $(this).val();
        var passwordHelp = $('#passwordHelp');

        // Expresión regular para verificar la seguridad de la contraseña
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,12}$/;

        if (!regex.test(password)) {
            passwordHelp.text('La contraseña debe tener entre 8 y 12 caracteres, con al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.');
            $('#registerBtn').attr('disabled', true);
        } else {
            passwordHelp.text('');
            // Verificar si las contraseñas coinciden
            validatePasswordsMatch();
        }
    });

    $('#password-confirm').on('keyup', function() {
        // Verificar si las contraseñas coinciden
        validatePasswordsMatch();
    });

    function validatePasswordsMatch() {
        var password = $('#password').val();
        var confirmPassword = $('#password-confirm').val();
        var passwordMatchHelp = $('#passwordMatchHelp');

        if (password !== confirmPassword) {
            passwordMatchHelp.text('Las contraseñas no coinciden.');
            $('#registerBtn').attr('disabled', true);
        } else {
            passwordMatchHelp.text('');
            $('#registerBtn').attr('disabled', false); // Habilitar el botón si todo está bien
        }
    }
});