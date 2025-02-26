document.addEventListener('DOMContentLoaded', function() {
    async function confirmarLogin() {
        const email = document.getElementById('inputEmail').value.trim();
        const contra = document.getElementById('inputContra').value.trim();

        // Validación básica
        if (!email || !contra) {
            alert("Por favor, complete todos los campos.");
            return;
        }

        // Enviar datos al servidor
        const response = await fetch('Controllers/login1Controller.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, contra })
        });

        const result = await response.json();

        if (result.success) {
            window.location.href = `main.php`; 
        } else {
            alert('Datos incorrectos');
        }
    }

    const loginForm = document.getElementById('formRegistro'); // Reemplaza con el ID correcto

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            confirmarLogin();
        });
    }
});

