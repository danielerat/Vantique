<?php

class Session
{
    /**
     * The Idea of having a separate class to work with is that  ,we might in the future want to add 
     * Some Complexity to it , not only checking if the user was logged out a log time ago
     * but also getting users ip address , or user agent etc..
     *  */
    private $admin_id;
    public $admin_username;
    public $account_type;
    private $last_login;


    public const MAX_LOGIN_AGE = 60 * 60 * 24; // 1 day

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->check_stored_login();
    }

    public function login($admin)
    {
        if ($admin) {
            // prevent session fixation attacks
            session_regenerate_id();
            $this->admin_id = $_SESSION['admin_id'] = $admin->id;
            $this->admin_username = $_SESSION['admin_username'] = $admin->username;
            $this->account_type = $_SESSION['account_type'] = $admin->account_type;
            $this->last_login = $_SESSION['last_login'] = time();
        }
        return true;
    }

    public function is_logged_in()
    {
        // return isset($this->admin_id);
        return isset($this->admin_id) && $this->last_login_is_recent();
    }

    public function logout()
    {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        unset($_SESSION['account_type']);
        unset($_SESSION['last_login']);
        unset($this->admin_id);
        unset($this->admin_username);
        unset($this->last_login);
        unset($this->account_type);
        return true;
    }

    private function check_stored_login()
    {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->admin_username = $_SESSION['admin_username'];
            $this->last_login = $_SESSION['last_login'];
            $this->account_type = $_SESSION['account_type'];
        }
    }

    private function last_login_is_recent()
    {
        if (!isset($this->last_login)) {
            return false;
        } elseif (($this->last_login + self::MAX_LOGIN_AGE) < time()) {
            $this->message($this->admin_username . " Login Expired,Login Again");
            return false;
        } else {
            return true;
        }
    }

    // We want to use this function to set our msg if a param is passed 
    public function message($msg = "")
    {
        if (!empty($msg)) {
            //  This is the set since it has no parameter
            $_SESSION['message'] = $msg;
            return true;
        } else {
            return $_SESSION['message'] ?? "";
            //this is a get message 
        }
    }
    //used to clear the message from the session once displayed
    public function clear_message()
    {
        unset($_SESSION['message']);
        return true;
    }
}