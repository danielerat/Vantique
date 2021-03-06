<?php
require_once("initialize.php");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];
if (is_blank($username)) {
    $errors[] = "Username cannot be blank.";
}
if (is_blank($password)) {
    $errors[] = "Password cannot be blank.";
}
if (is_ajax_request()) {

    $login_failure_msg = "Unknown Username or Password";

    if (empty($errors)) {
        $admin = Admin::find_by_username($username);
        // test if admin found and password is correct
        if ($admin != false && $admin->verify_password($password)) {
            // Mark admin as logged in
            $session_admin->login($admin);
            $session_admin->message("Welcome " . $admin->username);
            echo "true";
        } else {
            $errors[] = $login_failure_msg;
            $result_array = array('Errors' => $errors);
            echo json_encode($result_array);
            exit;
        }
    } else {
        $result_array = array('Errors' => $errors);
        echo json_encode($result_array);
        exit;
    }
} else {
    redirect_to(url_for('/admin/index.php'));
}