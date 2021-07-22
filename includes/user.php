<?php

function signon($credentials = array())
{
    if (empty($credentials)) {
        $credentials = array(); // Back-compat for plugins passing an empty string.

        if (!empty($_POST['log'])) {
            $credentials['user_login'] = unslash($_POST['log']);
        }
        if (!empty($_POST['pwd'])) {
            $credentials['user_password'] = $_POST['pwd'];
        }
        if (!empty($_POST['rememberme'])) {
            $credentials['remember'] = $_POST['rememberme'];
        }
    }

    if (!empty($credentials['remember'])) {
        $credentials['remember'] = true;
    } else {
        $credentials['remember'] = false;
    }
    $user = User::authenticate(null, $credentials['user_login'], $credentials['user_password']);
    return $user;
}

function logout()
{
    session_start();
    session_destroy();
    header('Location:/login.php');
    die();
}

function check_password($password, $hash)
{
    require_once INC_PATH . 'classes/phpass.php';
    // By default, use the portable hash from phpass.
    $hasher = new PasswordHash(8, true);
    $check = $hasher->CheckPassword($password, $hash);
    return $check;
}
