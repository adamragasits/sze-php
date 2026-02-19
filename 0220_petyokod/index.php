<?php
require_once 'db.php';

// insert művelet, adatok feltöltése
if (isset($_POST['uj_feladat']) && !empty($_POST['feladat_szoveg'])) {
    $feladat = $_POST['feladat_szoveg'];
    $datum = date('Y-m-d H:i:s');
    
    // beágyazott query
    $insert_sql = "INSERT INTO todo (teendo, feltoltes_idopontja) VALUES ('$feladat', '$datum')";
    mysqli_query($conn, $insert_sql);

    // mysqli_multi_query($conn, $insert_sql);
    // Vége', '2026-01-01'); DROP TABLE todo; --

    // prepared statement
    // $sql = "INSERT INTO todo (teendo, feltoltes_idopontja) VALUES (?, ?)";
    // mysqli_execute_query($conn, $sql, [$feladat, $datum]);

    // header("Location: index.php");
}

// if (isset($_POST['torol_gomb']) && !empty($_POST['torlendo_id'])) {
//     $id = $_POST['torlendo_id'];

//     $stmt = mysqli_prepare($conn, "DELETE FROM todo WHERE id = ?");
//     mysqli_stmt_bind_param($stmt, "i", $id); 
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_close($stmt);
    
//     header("Location: index.php");
// }

// lekérés művelet
$sql = "SELECT * FROM todo ORDER BY feltoltes_idopontja DESC";
$eredmeny = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>todo lista</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 350px; }
        input[type="text"] { width: 70%; padding: 8px; }
        input[type="submit"] { padding: 8px; cursor: pointer; }
        ul { list-style: none; padding: 0; margin-top: 20px; }
        li { background: #eee; margin-bottom: 5px; padding: 10px; border-radius: 4px; display: flex; justify-content: space-between; }
    </style>
</head>
<body>

<div class="container">
    <h2>Todo lista</h2>

    <form method="POST" action="index.php">
        <input type="text" name="feladat_szoveg" placeholder="Mit kell tenned?" required>
        <input type="submit" name="uj_feladat" value="Hozzáad">
    </form>
    <!-- <form method="POST" action="index.php">
        <input type="number" name="torlendo_id" placeholder="ID" required>
        <input type="submit" name="torol_gomb" value="Törlés">
    </form> -->

    <ul>
        <?php while($row = mysqli_fetch_assoc($eredmeny)): ?>
            <li>
                <!-- <?php echo htmlspecialchars($row['id']); ?> -  -->
                <?php echo htmlspecialchars($row['teendo']); ?>
                <small><?php echo $row['feltoltes_idopontja']; ?></small>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

</body>
</html>