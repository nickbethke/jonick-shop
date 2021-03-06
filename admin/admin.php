<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!defined('ADMIN')) {
    define('ADMIN', true);
}

global $auth, $current_user, $menu;

require_once dirname(__DIR__) . "/load.php";

require_once ABSPATH . "admin/load.php";

require_once ABSPATH . 'admin/includes/admin.php';


function admin_page_head($hook_suffix, $page_title, $page_styles = [], $page_scripts = [])
{
    global $auth, $current_user, $menu, $title;

    $global_title = $title;

    if ($page_title) {
        $title = $page_title;
    } else {
        $title = $global_title;
    }


    session_start();

    $auth = new Admin\Auth();


    auth_redirect();

    $date_format = 'F j, Y';
    $time_format = 'g:i a';

    global $pagenow, $hook_suffix, $current_screen;

    $hook_suffix = '';

    if (isset($page_hook)) {
        $hook_suffix = $page_hook;
    } elseif (isset($pagenow)) {
        $hook_suffix = $pagenow;
    }

    set_current_screen();

    if (!in_array("jquery", $page_scripts)) {
        $page_scripts[] = 'jquery';
    }
    enqueue_style($page_styles);
    enqueue_scripts($page_scripts);

    if (!isset($_GET['noheader'])) {
        require_once ABSPATH . 'admin/admin-header.php';
    }
}

function admin_page_footer($hook_suffix, $page_styles = [], $page_scripts = [])
{
    global $auth, $current_user, $menu, $title;

    enqueue_style($page_styles);
    enqueue_scripts($page_scripts);

    if (!isset($_GET['nofooter'])) {
        require_once ABSPATH . 'admin/admin-footer.php';
    }
}
