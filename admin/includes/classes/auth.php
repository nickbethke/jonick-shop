<?php

namespace Admin;

use User;

class Auth
{
    private $user = NULL;
    private $logged_in = false;
    public function __construct()
    {
        global $current_user;
        if (!array_key_exists('user', $_SESSION) || !is_a($_SESSION['user'], 'User')) {
            $this->logged_in = false;
        } else {
            $this->logged_in = true;
            $this->user = $_SESSION['user'];
            $current_user = $this->user;
        }
    }
    public function is_logged_in()
    {
        return $this->logged_in;
    }
    public function login_redirect()
    {
        header('Location:login.php');
    }
}
