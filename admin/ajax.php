<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/admin.php';

$action = array_key_exists('action', $_REQUEST) && $_REQUEST['action'] ? $_REQUEST['action'] : false;
header('Content-Type:application/json');

session_start();
$auth = new Admin\Auth();
if ($auth->is_logged_in()) {
    if (strpos($action, 'jn_action_') === 0 && !strpos($action, 'jn_action_no_priv_') === 0) {
        call_ajax($action, true);
    }
} else {
    if (strpos($action, 'jn_action_no_priv_') === 0) {
        call_ajax($action, false);
    }
}

jn_die(0);
