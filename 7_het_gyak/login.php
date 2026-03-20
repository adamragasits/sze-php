<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>
<body>
    <h1>Bejelentkezés</h1>
    <form id="loginForm">
        <input type="text" id="username" name="username" placeholder="Felhasználónév">
        <input type="password" id="password" name="password" placeholder="Jelszó">
        <button type="submit">Bejelentkezés</button>
    </form>
    <div id="message"></div>
</body>
<script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const requestData = {
                username: username,
                password: password,
            };

            fetch('api/login.php', {
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
                    window.location.href = "dashboard.php";
                }
            })
            .catch(error => {
                const messageDiv = document.getElementById('message');
                messageDiv.textContent = 'Hálózati hiba történt!';
            });
        });
    </script>
</html>