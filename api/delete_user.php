<?php

header('Content-Type: application/json');

require_once '../config.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';

$db = (new Database())->connect();

$user = new User($db);

$id = $_GET['id'];

$user->deleteUser($id);

echo json_encode([
    'status' => true,
    'message' => 'User deleted successfully'
]);