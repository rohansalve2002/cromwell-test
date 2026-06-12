<?php

header('Content-Type: application/json');

require_once '../config.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';

$db = (new Database())->connect();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['forename'])) {
    echo json_encode(['status'=>false,'message'=>'Forename required']);
    exit;
}

if (empty($data['surname'])) {
    echo json_encode(['status'=>false,'message'=>'Surname required']);
    exit;
}

if (empty($data['title'])) {
    echo json_encode(['status'=>false,'message'=>'Title required']);
    exit;
}

if (empty($data['dob'])) {
    echo json_encode(['status'=>false,'message'=>'DOB required']);
    exit;
}

if (empty($data['mobile'])) {
    echo json_encode(['status'=>false,'message'=>'Mobile required']);
    exit;
}

if (empty($data['email'])) {
    echo json_encode(['status'=>false,'message'=>'Email required']);
    exit;
}

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status'=>false,'message'=>'Invalid email']);
    exit;
}

if (empty($data['password'])) {
    echo json_encode(['status'=>false,'message'=>'Password required']);
    exit;
}

if (strlen($data['password']) < 6) {
    echo json_encode(['status'=>false,'message'=>'Password minimum 6 characters']);
    exit;
}

if ($user->emailExists($data['email'])) {
    echo json_encode([
        'status' => false,
        'message' => 'Email already exists'
    ]);
    exit;
}

$stmt = $db->prepare("SELECT id FROM users WHERE mobile = ?");
$stmt->execute([$data['mobile']]);

if($stmt->fetch())
{
    echo json_encode([
        'status' => false,
        'message' => 'Mobile already exists'
    ]);
    exit;
}

$user->register($data);

echo json_encode([
    'status' => true,
    'message' => 'User registered successfully'
]);