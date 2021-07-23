<?php

function get_server_protocol()
{
    $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : '';
    if (!in_array($protocol, array('HTTP/1.1', 'HTTP/2', 'HTTP/2.0'), true)) {
        $protocol = 'HTTP/1.0';
    }
    return $protocol;
}

function require_db()
{
    global $db;

    require_once INC_PATH . 'classes/db.php';

    if (isset($db)) {
        return;
    }

    $dbuser     = defined('DB_USER') ? DB_USER : '';
    $dbpassword = defined('DB_PASSWORD') ? DB_PASSWORD : '';
    $dbname     = defined('DB_NAME') ? DB_NAME : '';
    $dbhost     = defined('DB_HOST') ? DB_HOST : '';

    $db = new DataBase($dbhost, $dbuser, $dbpassword, $dbname);
}

function check_php_versions()
{
    global $required_php_version;
    $php_version = phpversion();

    if (version_compare($required_php_version, $php_version, '>')) {
        $protocol = get_server_protocol();
        header(sprintf('%s 500 Internal Server Error', $protocol), true, 500);
        header('Content-Type: text/html; charset=utf-8');
        printf('Your server is running PHP version %1$s but requires at least %2$s.', $php_version, $required_php_version);
        exit(1);
    }
}
function get_user_by($field, $value)
{
    $userdata = User::get_data_by($field, $value);

    if (!$userdata) {
        return false;
    }
    $user = new User;
    $user->init($userdata);

    return $user;
}

function jn_get_current_user()
{

    if (array_key_exists('user', $_SESSION) && is_a($_SESSION['user'], 'User')) {
        return $_SESSION['user'];
    } else {
        return false;
    }
}

function get_cms_page_by($field, $value)
{
    $pagedata = CMSPage::get_data_by($field, $value);

    if (!$pagedata) {
        return false;
    }
    $cms_page = new CMSPage($pagedata);
    return $cms_page;
}
function get_cms_pages_by($field, $value)
{
    $pagedatas = CMSPage::get_datas_by($field, $value);
    if (!$pagedatas) {
        return false;
    }
    $cms_pages = [];
    foreach ($pagedatas as $data) {
        $cms_page = new CMSPage($data);
        $cms_pages[]  = $cms_page;
    }

    return $cms_pages;
}
