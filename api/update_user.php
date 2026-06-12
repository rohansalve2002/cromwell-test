<?php

header('Content-Type: application/json');

require_once '../config.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';

$db = (new Database())->connect();
$user = new User($db);

$data = json_decode(
    file_get_contents("php://input"),
    true
);

// Required validations
if (empty($data['forename'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Forename required'
    ]);
    exit;
}

if (empty($data['surname'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Surname required'
    ]);
    exit;
}

if (empty($data['title'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Title required'
    ]);
    exit;
}

if (empty($data['dob'])) {
    echo json_encode([
        'status' => false,
        'message' => 'DOB required'
    ]);
    exit;
}

if (empty($data['mobile'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Mobile required'
    ]);
    exit;
}

if (empty($data['email'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Email required'
    ]);
    exit;
}

// Email validation
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => false,
        'message' => 'Invalid email format'
    ]);
    exit;
}

$user->updateUser($data);

echo json_encode([
    'status' => true,
    'message' => 'User updated successfully'
]);