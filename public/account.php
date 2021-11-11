<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");

if (is_post_request() && isset($_POST["register"])) {
    $args = $_POST["user"];
    $user = new User($args);
    $result = $user->save();
    if ($result) {
        $session->message($user->username . ", Accout Was Successfully Created !");
        redirect_to("account.php");
    } else {
        echo display_errors($user->errors);
    }
} else {
    $user = new User;
}

?>

<!-- Account-Page -->
<div class="page-account u-s-p-t-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">


                <ul class="nav nav-tabs nav-pills nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="Login-tab" data-toggle="tab" href="#Login" role="tab"
                            aria-controls="Login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                            aria-controls="register" aria-selected="false">register</a>
                    </li>
                </ul>



                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="Login" role="tabpanel" aria-labelledby="Login-tab">
                        <!-- Login -->
                        <div class="col-lg-6 my-5 mx-auto">
                            <div class="login-wrapper">
                                <h2 class="account-h2 u-s-m-b-20">Login</h2>
                                <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                                <form method="POST" action="<?php echo S_PRIVATE . "/user_auth_login.php"; ?>"
                                    id="login_form">
                                    <div class="u-s-m-b-30">
                                        <label for="user-name-email">Username or Email
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="user-name-email" class="text-field" value=""
                                            name="username" placeholder="Username / Email" required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label for="login-password">Password
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="password" id="login-password" class="text-field" value=""
                                            name="password" placeholder="Password" required>
                                    </div>
                                    <div class="group-inline u-s-m-b-30">
                                        <div class="group-1">
                                            <input type="checkbox" class="check-box" id="remember-me-token" checked>
                                            <label class="label-text" for="remember-me-token">Remember me</label>
                                        </div>
                                        <div class="group-2 text-right">
                                            <div class="page-anchor">
                                                <a href="lost-password.html">
                                                    <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Lost your
                                                    password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-b-45">
                                        <button class="button button-outline-secondary w-100" id="signin">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login /- -->
                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <!-- Register -->
                        <div class="col-lg-6 my-5 mx-auto">
                            <div class="reg-wrapper">
                                <h2 class="account-h2 u-s-m-b-20">Register</h2>
                                <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your
                                    orderstatus
                                    and history.</h6>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                    <div class="u-s-m-b-30">
                                        <label for="first-name">First Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="first-name" value="<?php echo $user->first_name; ?>"
                                            name="user[first_name]" class="text-field" placeholder="First Name"
                                            required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label for="last-name">Last Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="last-name" value="<?php echo $user->last_name; ?>"
                                            name="user[last_name]" class="text-field" placeholder="Last Name" required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label for="user-name">Username
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="user-name" value="<?php echo $user->username; ?>"
                                            name="user[username]" class="text-field" placeholder="Username" required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label for="email">Email
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="email" value="<?php echo $user->email; ?>"
                                            name="user[email]" class="text-field" placeholder="Email" required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label for="user-name">Phone
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="user-name" value="<?php echo $user->phone; ?>"
                                            name="user[phone]" class="text-field" placeholder="Phone Number(07xx..)"
                                            required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label for="password">Password
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="password" id="password" value="<?php echo $user->password; ?>"
                                            name="user[password]" class="text-field" placeholder="Password" required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label for="passwordconf">Password
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="password" id="passwordconf"
                                            value="<?php echo $user->confirm_password; ?>" name="user[confirm_password]"
                                            class="text-field" placeholder="Password" required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <input type="checkbox" class="check-box" id="accept" checked>
                                        <label class="label-text no-color" for="accept">I’ve read and accept the
                                            <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                        </label>
                                    </div>
                                    <div class="u-s-m-b-45">
                                        <input type=submit class="button button-primary w-100" name='register'
                                            value="Register">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Register /- -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var button = document.querySelector("#signin");


function disableSubmitButton() {
    button.disabled = true;
    button.classList.add("bg-danger");
    button.innerHTML = 'Authenticationg...';
}

function enableSubmitButton() {
    button.disabled = false;
    button.innerHTML = 'Login';
    button.classList.remove("bg-danger");
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
        timer: 500,
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
        window.location = "index.php";
    });
}




function login_user() {
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
    login_user();
});
</script>
<!-- Account-Page /- -->
<?php require_once(PRIVATE_PATH . "/shared/public_footer.php"); ?>