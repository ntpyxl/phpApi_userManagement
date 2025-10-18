<?php
header('Content-Type: application/json');

$dsn = 'mysql:host=localhost;dbname=user_mgt_db;charset=utf8mb4';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';

if($action == "getAllUsers") {
    $search = '%' . ($input['search'] ?? '') . '%';
    $statement = $pdo->prepare('SELECT * FROM users
                            WHERE user_id LIKE ?
                            OR username LIKE ?
                            OR first_name LIKE ?
                            OR last_name LIKE ?
                            ORDER BY date_added DESC');
        
    $statement->execute([$search, $search, $search, $search]);
    $users = $statement->fetchAll();
    echo json_encode(['success' => true, 'data' => $users]);
}