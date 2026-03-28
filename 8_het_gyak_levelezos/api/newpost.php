<?php
    include_once __DIR__ . '/../config/db.php';
    session_start();

    $data = json_decode(file_get_contents('php://input'), true);

    $content = $data["content"];
    $author = $_SESSION["username"];
    $posted_at = date('Y-m-d H:i:s');

    $insert_query = "INSERT INTO posts_l (author, content, posted_at) VALUES (?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, 'sss', $author, $content, $posted_at);
    $insert = mysqli_stmt_execute($insert_stmt);

    if ($insert){
        echo json_encode([
            'success' => true,
            'message' => "Sikeres poszt beküldés"
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => "Hiba történt a beküldés során"
        ]);
    }
?>