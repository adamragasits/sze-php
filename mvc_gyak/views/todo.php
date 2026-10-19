<html>
    <h1>Teendő részletek</h1>
    <?php
        if(!$todo) {
            echo "Nem található teendő!";
            die();
        }

        echo "Azonosító: " . $todo["id"];
        echo "<br/>";
        echo "Cím: ". $todo["title"];
    ?>
</html>
