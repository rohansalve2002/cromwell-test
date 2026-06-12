<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Dashboard</h3>
        </div>

        <div class="card-body">

            <h4>Welcome User 👋</h4>

            <p class="text-muted">
                User Management System
            </p>

            <div class="d-flex gap-2">

                <a href="registration.php"
                   class="btn btn-success">
                    Add User
                </a>

                <a href="list.php"
                   class="btn btn-primary">
                    View Users
                </a>

                <a href="logout.php"
                   class="btn btn-danger">
                    Logout
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>