<?php

function require_login()
{
    global $session_admin;
    if (!$session_admin->is_logged_in()) {
        redirect_to('./../logout.php');
    }
}

function require_user_login()
{
    global $session_user;
    if (!$session_user->is_logged_in()) {
        redirect_to('index.php');
    }
}

function display_errors($errors = array())
{
    $output = "<div class='alert alert-fixed alert-danger alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    <h6><i class='fas fa-ban'></i><b> Stop!</b></h6>
    <ul>
    ";
    if (!empty($errors)) {
        foreach ($errors as $error) {
            $output .= "<li>" . h($error) . "</li>";
        }
    }
    $output .= "</ul></div>";
    return $output;
}


function display_session_message()
{
    global $session_admin;
    $msg = $session_admin->message();
    if (isset($msg) && $msg != '') {
        $session_admin->clear_message();
        $output = "<div class='alert alert-success alert-fixed alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <h6><i class='fas fa-check'></i><b> Success !</b></h6>
                    " . h($msg) . "
                  </div>";
        return $output;
    }
}
function display_user_session_message()
{
    global $session_user;
    $msg = $session_user->message();
    if (isset($msg) && $msg != '') {
        $session_user->clear_message();
        $output = "<div class='alert alert-success alert-fixed alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <h6><i class='fas fa-check'></i><b> Success !</b></h6>
                    " . h($msg) . "
                  </div>";
        return $output;
    }
}