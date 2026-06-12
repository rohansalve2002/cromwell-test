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

$user->updateUser($data);

echo json_encode([
    'status'=>true,
    'message'=>'User updated successfully'
]);