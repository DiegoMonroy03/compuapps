document.addEventListener('DOMContentLoaded', function() {
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();

            var username = document.getElementById('loginUsername').value.trim();
            var password = document.getElementById('loginPassword').value.trim();

            if (!username || !password) {
                showError('Por favor, complete todos los campos.');
                return;
            }

            authenticateUser(username, password);
        });
    }

    function authenticateUser(username, password) {
        var formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);

        fetch('login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            handleLoginResponse(data);
        })
        .catch(error => {
            console.error('Error al procesar la solicitud:', error);
            showError('Error en el servidor. Inténtelo nuevamente más tarde.');
        });
    }

    function handleLoginResponse(response) {
        switch (response.status) {
            case 'success_admin':
                window.location.href = 'home_admin.php';
                break;
            case 'success_user':
                window.location.href = 'home_user.php';
                break;
            case 'error':
                showError(response.message);
                break;
            default:
                showError('Respuesta inesperada del servidor.');
                break;
        }
    }

    function showError(message) {
        var errorMsg = document.getElementById('error-msg');
        errorMsg.textContent = message;
        errorMsg.style.display = 'block';
    }

});



