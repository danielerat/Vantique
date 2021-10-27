<?php

class SessionUser
{
    /**
     * The Idea of having a separate class to work with is that  ,we might in the future want to add 
     * Some Complexity to it , not only checking if the user was logged out a log time ago
     * but also getting users ip address , or user agent etc..
     *  */
    private $user_id;
    public $username;
    public $first_name;
    private $last_login;


    public const MAX_LOGIN_AGE = 60 * 60 * 24; // 1 day

    public function __construct()
    {
        session_start();
        $this->check_stored_login();
    }

    public function login($user)
    {
        if ($user) {
            // prevent session fixation attacks
            session_regenerate_id();
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $this->first_name = $_SESSION['first_name'] = $user->first_name;
            $this->last_login = $_SESSION['last_login'] = time();
        }
        return true;
    }

    public function is_logged_in()
    {
        // return isset($this->user_id);
        return isset($this->user_id) && $this->last_login_is_recent();
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_login']);
        unset($this->user_id);
        unset($this->username);
        unset($this->last_login);
        unset($this->first_name);
        return true;
    }

    private function check_stored_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->last_login = $_SESSION['last_login'];
            $this->first_name = $_SESSION['first_name'];
        }
    }

    private function last_login_is_recent()
    {
        if (!isset($this->last_login)) {
            return false;
        } elseif (($this->last_login + self::MAX_LOGIN_AGE) < time()) {
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