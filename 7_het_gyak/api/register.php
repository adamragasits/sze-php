<?php
include_once('../components/db.php');

header('Content-Type: application/json');

define('API_SECRET', 'titkoskulcs');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Csak POST kérések engedélyezve!']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$dataForHmac = $data['username'] . $data['email'] . $data['password'] . ($data['timestamp'] ?? '');
$hashedData = hash_hmac('sha256', $dataForHmac, API_SECRET);

$username = trim($data['username'] ?? '');
$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';
$password_confirm = $data['password_confirm'] ?? '';

if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
    echo json_encode(['success' => false, 'message' => 'Összes mező kitöltése kötelező!']);
    exit;
}

if ($password !== $password_confirm) {
    echo json_encode(['success' => false, 'message' => 'A jelszavak nem egyeznek!']);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'A jelszó legalább 6 karakter hosszú legyen!']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Nem érvényes email cím!']);
    exit;
}

$check_query = "SELECT id FROM users WHERE username = ? OR email = ?";
$check_stmt = mysqli_prepare($conn, $check_query);
mysqli_stmt_bind_param($check_stmt, 'ss', $username, $email);
mysqli_stmt_execute($check_stmt);
$result = mysqli_stmt_get_result($check_stmt);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(['success' => false, 'message' => 'Ez a felhasználónév vagy email már foglalt!']);
    mysqli_stmt_close($check_stmt);
    exit;
}
mysqli_stmt_close($check_stmt);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$insert_stmt = mysqli_prepare($conn, $insert_query);
mysqli_stmt_bind_param($insert_stmt, 'sss', $username, $email, $hashed_password);

if (mysqli_stmt_execute($insert_stmt)) {
    echo json_encode(['success' => true, 'message' => 'Sikeres regisztráció! Bejelentkezhetsz.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Hiba történt az adatbázisban.']);
}

mysqli_stmt_close($insert_stmt);
?>