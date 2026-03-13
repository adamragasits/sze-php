<!DOCTYPE html>
<html>
<head>
    <title>Polling</title>
</head>
<body>

    <h1>Darabszám: <span id="ertek">0</span></h1>
    <p>Utolsó frissítés: <span id="frissites">-</span></p>

    <script>
        function frissites() {
            fetch('check_status.php')
                .then(res => res.json())
                .then(adat => {
                    document.getElementById('ertek').innerText = adat.szam;
                    document.getElementById('frissites').innerText = adat.ido;
                });
        }

        setInterval(frissites, 3000);

        frissites();
    </script>

</body>
</html>