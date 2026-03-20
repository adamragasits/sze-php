<?php
include_once('components/db.php');
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
</head>
<body>
    <h1>Regisztráció</h1>
    <form id="registerForm">
        <input type="text" id="username" name="username" placeholder="Felhasználónév" required>
        <input type="text" id="email" name="email" placeholder="Email cím" required>
        <input type="password" id="password" name="password" placeholder="Jelszó" required>
        <input type="password" id="password_confirm" name="password_confirm" placeholder="Jelszó megerősítése" required>
        <button type="submit">Regisztráció</button>
    </form>

    <div id="message"></div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const password_confirm = document.getElementById('password_confirm').value;

            const requestData = {
                username: username,
                email: email,
                password: password,
                password_confirm: password_confirm
            };

            fetch('api/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('message');
                messageDiv.textContent = data.message;

                if (data.success) {
                    document.getElementById('registerForm').reset();
                }
            })
            .catch(error => {
                const messageDiv = document.getElementById('message');
                messageDiv.textContent = 'Hálózati hiba történt!';
            });
        });
    </script>
</body>
</html>