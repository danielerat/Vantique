<?php
require_once("../../private/initialize.php");
if (is_post_request()) {
    print_r($_POST);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>Vantique Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="vendor/sweetalert2/dist/sweetalert2.min.css">

</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class=" col-lg-5 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form method="POST" action="<?php echo S_PRIVATE . "/auth_login.php"; ?>"
                                        id="login_form" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="username"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small"
                                                style="line-height: 1.5rem;">
                                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                                    checked>
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button href="index.html" id="signin"
                                                class="btn btn-primary bg-gradient-primary signin btn-block">Login</button>
                                        </div>
                                        <hr>
                                        <a href="" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.php" class="btn btn-facebook btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
    var button = document.querySelector("#signin");


    function disableSubmitButton() {
        button.disabled = true;
        button.classList.add("bg-gradient-danger");
        button.innerHTML = 'Authenticationg...';
    }

    function enableSubmitButton() {
        button.disabled = false;
        button.innerHTML = 'Login';
        button.classList.remove("bg-gradient-danger");
    }

    function displayErrors(errors) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showCloseButton: true,
            showConfirmButton: false,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'error',
            title: 'Unknown Username Or Password'
        })
    }

    function successlogin() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
        }).then(function() {
            window.location = "admin/index.php";
        });
    }




    function login_admin() {
        disableSubmitButton();
        var form = document.querySelector("#login_form");
        var action = form.getAttribute("action");
        // gather form data
        var form_data = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                console.log('Result: ' + result);
                var json = JSON.parse(result);
                if (json.hasOwnProperty('Errors') && json.Errors.length > 0) {
                    displayErrors(json['Errors']);
                    enableSubmitButton();

                } else {
                    enableSubmitButton();
                    successlogin();
                }
            }
        };
        xhr.send(form_data);
    }

    button.addEventListener("click", function(event) {
        event.preventDefault();
        login_admin();
    });
    </script>

    <script src="vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
</body>

</html>