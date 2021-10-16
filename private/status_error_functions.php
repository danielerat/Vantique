<?php

function require_login()
{
    global $session;
    if (!$session->is_logged_in()) {
        redirect_to(url_for('/staff/login.php'));
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
    global $session;
    $msg = $session->message();
    if (isset($msg) && $msg != '') {
        $session->clear_message();
        $output = "<div class='alert alert-success alert-fixed alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <h6><i class='fas fa-check'></i><b> Stop!</b></h6>
                    " . h($msg) . "
                  </div>";
        return $output;
    }
}