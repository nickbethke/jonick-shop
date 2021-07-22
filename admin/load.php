<?php

require_once ABSPATH . "admin/includes/classes/auth.php";
require_once ABSPATH . "admin/includes/screen.php";

function auth_redirect()
{
    global $auth;
    if (!$auth->is_logged_in()) {
        header('Location:/login.php');
        die();
    }
}
