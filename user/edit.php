<?php

session_start();

require_once '../config.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';

$db = (new Database())->connect();

$userObj = new User($db);

$user = $userObj->getUserById($_GET['id']);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header">
                    <h3>Edit User</h3>
                </div>

                <div class="card-body">

                    <form id="editForm">

                        <input type="hidden"
                               name="id"
                               value="<?= $user['id'] ?>">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Forename</label>
                                <input type="text"
                                       name="forename"
                                       class="form-control"
                                       value="<?= $user['forename'] ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Surname</label>
                                <input type="text"
                                       name="surname"
                                       class="form-control"
                                       value="<?= $user['surname'] ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Title</label>
                                <select name="title" class="form-control">
                                    <option value="Mr" <?= $user['title']=='Mr'?'selected':'' ?>>Mr</option>
                                    <option value="Mrs" <?= $user['title']=='Mrs'?'selected':'' ?>>Mrs</option>
                                    <option value="Miss" <?= $user['title']=='Miss'?'selected':'' ?>>Miss</option>
                                    <option value="Dr" <?= $user['title']=='Dr'?'selected':'' ?>>Dr</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Date of Birth</label>
                                <input type="date"
                                       name="dob"
                                       class="form-control"
                                       value="<?= $user['dob'] ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Mobile Number</label>
                                <input type="text"
                                       name="mobile"
                                       class="form-control"
                                       value="<?= $user['mobile'] ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Other Contact Number</label>
                                <input type="text"
                                       name="other_phone"
                                       class="form-control"
                                       value="<?= $user['other_phone'] ?>">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="<?= $user['email'] ?>">
                            </div>

                        </div>

                        <button type="submit"
                                class="btn btn-primary">
                            Update User
                        </button>

                        <a href="list.php"
                           class="btn btn-secondary">
                            Back
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
<script>
$(document).ready(function () {

    $('#editForm').submit(function (e) {
        e.preventDefault();

        let id = $('[name=id]').val();
        let forename = $('[name=forename]').val().trim();
        let surname = $('[name=surname]').val().trim();
        let title = $('[name=title]').val().trim();
        let dob = $('[name=dob]').val().trim();
        let mobile = $('[name=mobile]').val().trim();
        let other_phone = $('[name=other_phone]').val().trim();
        let email = $('[name=email]').val().trim();

        if (forename === '') {
            alert('Forename is required');
            return;
        }

        if (surname === '') {
            alert('Surname is required');
            return;
        }

        if (title === '') {
            alert('Please select title');
            return;
        }

        if (dob === '') {
            alert('Date of birth is required');
            return;
        }

        if (mobile === '') {
            alert('Mobile number is required');
            return;
        }

        if (email === '') {
            alert('Email is required');
            return;
        }

        let namePattern = /^[A-Za-z ]+$/;

        if (!namePattern.test(forename)) {
            alert('Forename should contain only letters');
            return;
        }

        if (!namePattern.test(surname)) {
            alert('Surname should contain only letters');
            return;
        }

        let mobilePattern = /^[0-9]{10,15}$/;

        if (!mobilePattern.test(mobile)) {
            alert('Enter valid mobile number');
            return;
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
            alert('Invalid email format');
            return;
        }

        if (new Date(dob) > new Date()) {
            alert('DOB cannot be in future');
            return;
        }

        $.ajax({
            url: '/cromwell-test/api/update_user.php',
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',

            data: JSON.stringify({
                id: id,
                forename: forename,
                surname: surname,
                title: title,
                dob: dob,
                mobile: mobile,
                other_phone: other_phone,
                email: email
            }),

            success: function (response) {
                alert(response.message);

                if (response.status) {
                    window.location.href = 'list.php';
                }
            },

            error: function (xhr) {
                console.log(xhr.responseText);
                alert('Something went wrong');
            }
        });

    });

});
</script>

</body>
</html>