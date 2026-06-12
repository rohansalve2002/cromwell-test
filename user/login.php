<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>User Login</h3>
                </div>

                <div class="card-body">

                    <form id="loginForm">

                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email"
                                   name="email"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control">
                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                    <hr>

                    <div class="text-center">
                        <a href="registration.php">
                            New User? Register Here
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

$('#loginForm').submit(function(e){

    e.preventDefault();

    let email = $('[name=email]').val();
    let password = $('[name=password]').val();

    if(email == '')
    {
        alert('Email is required');
        return;
    }

    if(password == '')
    {
        alert('Password is required');
        return;
    }

    $.ajax({

        url:'/cromwell-test/api/login.php',

        type:'POST',

        contentType:'application/json',

        dataType:'json',

        data: JSON.stringify({

            email: email,
            password: password

        }),

        success:function(response){

            alert(response.message);

            if(response.status)
            {
                window.location.href =
                '/cromwell-test/user/dashboard.php';
            }

        },

        error:function(xhr){

            console.log(xhr.responseText);

            alert('Login failed');
        }

    });

});

</script>

</body>
</html>
