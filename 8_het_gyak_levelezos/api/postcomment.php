<?php
  include_once __DIR__ . '/../config/db.php';

  session_start();

  $data = json_decode(file_get_contents('php://input'), true);

  $content = $data["commentText"];
  $author = $_SESSION['username'];
  $id = $_GET['id'];
  $datum = date("Y-m-d H:i:s");

  if(!isset($id)) {
    echo json_encode([
      'success' => false,
      'message' => "Kommentelésnél poszt azonosítója kötelező!"
    ]);
    exit;
  }

  $sql = "INSERT INTO comments_l (post_id, author, content, commented_at) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ssss", $id, $author, $content, $datum);
  $result = mysqli_stmt_execute($stmt);

    if ($result){
        echo json_encode([
            'success' => true,
            'message' => "Sikeres komment írás"
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => "Hiba történt a komment írása során"
        ]);
    }
?>