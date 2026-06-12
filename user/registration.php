<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>User Registration</h3>
                </div>

                <div class="card-body">

                    <form id="registerForm">

                        <div class="mb-3">
                            <label>Forename</label>
                            <input type="text" name="forename" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Title</label>
                            <select name="title" class="form-control">
                                <option value="">Select</option>
                                <option>Mr</option>
                                <option>Mrs</option>
                                <option>Miss</option>
                                <option>Dr</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Other Contact Number</label>
                            <input type="text" name="other_phone" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"  >
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control"  >
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" id="confirm_password" class="form-control"  >
                        </div>

                        <button id="registerBtn" type="submit" class="btn btn-primary w-100">
                            Register
                        </button>
                        <hr>

                        <div class="text-center">
                            <a href="login.php">
                                Already registered? Login Here
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function () {

    $('#registerForm').submit(function (e) {
        e.preventDefault();

        let forename = $('[name=forename]').val().trim();
        let surname = $('[name=surname]').val().trim();
        let title = $('[name=title]').val().trim();
        let dob = $('[name=dob]').val().trim();
        let mobile = $('[name=mobile]').val().trim();
        let other_phone = $('[name=other_phone]').val().trim();
        let email = $('[name=email]').val().trim();
        let password = $('#password').val();
        let confirmPassword = $('#confirm_password').val();

        // Required validations
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

        if (password === '') {
            alert('Password is required');
            return;
        }

        // Name validation
        let namePattern = /^[A-Za-z ]+$/;

        if (!namePattern.test(forename)) {
            alert('Forename should contain only letters');
            return;
        }

        if (!namePattern.test(surname)) {
            alert('Surname should contain only letters');
            return;
        }

        // Mobile validation
        let mobilePattern = /^[0-9]{10,15}$/;

        if (!mobilePattern.test(mobile)) {
            alert('Enter valid mobile number');
            return;
        }

        // Email validation
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
            alert('Invalid email format');
            return;
        }

        // DOB validation
        if (new Date(dob) > new Date()) {
            alert('DOB cannot be in future');
            return;
        }

        // Password validation
        if (password.length < 6) {
            alert('Password must be at least 6 characters');
            return;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match');
            return;
        }

        let data = {
            forename: forename,
            surname: surname,
            title: title,
            dob: dob,
            mobile: mobile,
            other_phone: other_phone,
            email: email,
            password: password
        };

        $('#registerBtn').prop('disabled', true).text('Registering...');

        $.ajax({
            url: '../api/user.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            dataType: 'json',

            success: function (response) {
                alert(response.message);

                $('#registerBtn').prop('disabled', false).text('Register');

                if (response.status) {
                    $('#registerForm')[0].reset();
                }
            },

            error: function (xhr) {
                console.log(xhr.responseText);
                $('#registerBtn').prop('disabled', false).text('Register');
                alert('Something went wrong');
            }
        });
    });

});
</script>

</body>
</html>