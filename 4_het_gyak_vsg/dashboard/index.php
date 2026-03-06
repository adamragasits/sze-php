<?php
    include_once __DIR__ . '/../restrict.php';

    echo "Felhasználó be van lépve!";
    echo '<br>';
    echo $_SESSION['username'];
    echo '<br>';
    echo $_SESSION['fullname'];
    echo '<br>';
    echo "_---------_";
    echo '<br>';
    print_r($_SESSION);
?>