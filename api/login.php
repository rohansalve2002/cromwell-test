<?php

session_start();

header('Content-Type: application/json');

require_once '../config.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';

$db = (new Database())->connect();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['email'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Email required'
    ]);
    exit;
}

if (empty($data['password'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Password required'
    ]);
    exit;
}

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) 
    echo json_encode([
        'status' => false,
        'message' => 'Invalid email format'
    ]);
    exit;
}

$userdata = $user->getUserByEmail($data['email']);

if (!$userdata) {
    echo json_encode([
        'status' => false,
        'message' => 'Email not found'
    ]);
    exit;
}

if (!password_verify($data['password'], $userdata['password'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Invalid password'
    ]);
    exit;
}

$_SESSION['user_id'] = $userdata['id'];
$_SESSION['user_name'] = $userdata['forename'];

echo json_encode([
    'status' => true,
    'message' => 'Login successful'
]);