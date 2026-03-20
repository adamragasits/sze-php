<?php
include_once('../components/db.php');
include_once('../model/User.php');
include_once('../components/redis.php');

session_start();

header('Content-Type: application/json');

define('API_SECRET', 'titkoskulcs');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Csak POST kérések engedélyezve!']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Összes mező kitöltése kötelező!']);
    exit;
}

$check_query = "SELECT id, password, email FROM users WHERE username = ?";
$check_stmt = mysqli_prepare($conn, $check_query);
mysqli_stmt_bind_param($check_stmt, 's', $username);
mysqli_stmt_execute($check_stmt);
$result = mysqli_stmt_get_result($check_stmt);
$userinfo = mysqli_fetch_all($result);

if (count($userinfo) == 0) {
    echo json_encode(['success' => false, 'message' => 'Hibás felhasználónév / jelszó!']);
    mysqli_stmt_close($check_stmt);
    exit;
}

$hashedPassword = password_verify($password, $userinfo[0][1]);

if ($hashedPassword) {
    $user = new User($userinfo[0][0], $username, $userinfo[0][2]);

    $_SESSION["user"] = $user;
    $redis->rpush("online_users", $username);
    echo json_encode(['success' => true, 'message' => 'Sikeres bejelentkezés!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Hibás felhasználónév / jelszó!']);
}

mysqli_stmt_close($check_stmt);
?>