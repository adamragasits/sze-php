<?php
  include_once __DIR__ . '/../config/db.php';

  session_start();

  $username = $_SESSION['username'];
  $id = $_GET['id'];

  if(!isset($id)) {
    echo json_encode([
      'success' => false,
      'message' => "Törlésre szánt komment azonosítója kötelező!"
    ]);
    exit;
  }

  $sql = "UPDATE comments_l SET deleted = 1 WHERE id = ? AND author = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $id, $username);
  $result = mysqli_stmt_execute($stmt);

    if ($result){
        echo json_encode([
            'success' => true,
            'message' => "Sikeres komment törlés"
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => "Hiba történt a törlés során"
        ]);
    }
?>