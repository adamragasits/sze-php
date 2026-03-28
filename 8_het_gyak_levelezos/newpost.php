<?php
  include_once 'config/restrict.php';
  include_once 'components/header.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Új poszt</title>
    <link rel="stylesheet" href="components/newpost.css">
</head>
<body>
    <button class='backToDashboardBtn' onClick="window.location.href = 'dashboard.php'">Vissza a főoldalra</button>
    <h1 class='headerText'>Új poszt írása</h1>

    <div class='newPostForm' id="newPostForm">
        <textarea rows=8 id="post_text" placeholder='Poszt szövege'></textarea>
        <button id='sendPostButton'>Poszt beküldése</button>
    </div>
        
</body>
<script>
    document.getElementById("sendPostButton").addEventListener("click", function(e){

        const content = document.getElementById('post_text').value;

        fetch("api/newpost.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                content: content
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if(data.success) {
                window.location.href = 'dashboard.php';
            }   
            else {
                document.getElementById("newPostForm").reset();
            }
            
        })
        .catch(error => {
            console.log("Hiba történt ", error);
        })
    })
</script>
</html>