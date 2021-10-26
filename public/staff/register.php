<?php
require_once("../../private/initialize.php");
if (is_post_request()) {
    $args = $_POST["admin"];
    $admin = new Admin($args);
    $result = $admin->save();
    if ($result) {
        $session->message($admin->username . ", Accout Was Successfully Created !");
        redirect_to("index.php");
    } else {
        echo display_errors($admin->errors);
    }
} else {
    $admin = new Admin;
}

echo display_session_message();

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
    <title>RuangAdmin - Register</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>

<body class="bg-gradient-login">
    <!-- Register Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo $admin->first_name; ?>" name="admin[first_name]" id=""
                                                placeholder="*Enter First Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo $admin->last_name; ?>" name="admin[last_name]" id=""
                                                placeholder="*Enter Last Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo $admin->username; ?>" name="admin[username]" id=""
                                                aria-describedby="emailHelp" placeholder="*Enter Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control"
                                                value="<?php echo $admin->email; ?>" name="admin[email]" id=""
                                                aria-describedby="emailHelp" placeholder="*Enter Email Address"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control"
                                                value="<?php echo $admin->password; ?>" name="admin[password]" id=""
                                                placeholder="*Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Repeat Password</label>
                                            <input type="password" class="form-control"
                                                value="<?php echo $admin->confirm_password; ?>"
                                                name="admin[confirm_password]" id="" placeholder="*Repeat Password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>

                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Register with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="index.php">Already have an account?</a>
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
    <!-- Register Content -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>

</html>