<?php
session_start();
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

if($action == "addUser") {
    $formData = $input['data'];

    // username check
    $statement = $pdo->prepare('SELECT COUNT(*) AS usernameCount FROM users WHERE username = ?');

    $statement->execute([$formData['username']]);
    $usernameCount = $statement->fetch()['usernameCount'];

    if($usernameCount !== 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Username already exists.']);
        exit;
    }

    // password char length check (must be >=8)
    if(strlen($formData['password']) < 8) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Password is too short. It must be 8+ characters.']);
        exit;
    }

    // password match
    if($formData['password'] !== $formData['confirmPassword']) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Password confirmation does not match.']);
        exit;
    }

    $statement = $pdo->prepare('INSERT INTO users (username, first_name, last_name, is_admin, user_password) VALUES (?, ?, ?, ?, ?)');
    $statement->execute([$formData['username'], $formData['firstname'], $formData['lastname'], $formData['role'], $formData['password']]);

    echo json_encode(['success' => true]);
}

if($action == "loginUser") {
    $formData = $input['data'];

    // username check
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = ?');

    $statement->execute([$formData['username']]);
    $userData = $statement->fetch();

    if($userData === false) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Username does not exist.']);
        exit;
    }

    // password check
    if($formData['password'] !== $userData['user_password']) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
        exit;
    }

    $_SESSION['user_id'] = $userData['user_id'];
    $_SESSION['first_name'] = $userData['first_name'];
    $_SESSION['last_name'] = $userData['last_name'];
    $_SESSION['is_admin'] = $userData['is_admin'];

    echo json_encode(['success' => true]);
}

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