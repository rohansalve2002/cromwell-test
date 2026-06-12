<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit;
}

require_once '../config.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';

$db = (new Database())->connect();

$user = new User($db);

$users = $user->getAllUsers();

?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>User List</h2>

    <a href="dashboard.php" class="btn btn-primary mb-3">
        Dashboard
    </a>

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Forename</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Created</th>
            <th>Action</th>
        </tr>

        <?php foreach($users as $row){ ?>

        <tr>

            <td><?= $row['id'] ?></td>

            <td><?= htmlspecialchars($row['forename']) ?></td>

            <td><?= htmlspecialchars($row['surname']) ?></td>

            <td><?= htmlspecialchars($row['email']) ?></td>

            <td><?= $row['created_at'] ?></td>

            <td>

                <a href="edit.php?id=<?= $row['id'] ?>"
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <button
                    class="btn btn-danger btn-sm"
                    onclick="deleteUser(<?= $row['id'] ?>)">
                    Delete
                </button>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

<script>

function deleteUser(id)
{
    if(!confirm('Are you sure you want to delete this user?'))
    {
        return;
    }

    fetch('/cromwell-test/api/delete_user.php?id=' + id)
    .then(res => res.json())
    .then(data => {

        alert(data.message);

        location.reload();

    });
}

</script>

</body>
</html>