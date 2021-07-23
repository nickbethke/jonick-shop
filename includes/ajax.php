<?php
function call_ajax($action, $priv)
{
    global $actions;
    if (array_key_exists($action, $actions)) {
        $a = $actions[$action];
        if (is_array($a)) {
            call_user_func_array($a, []);
        } elseif (is_string($a) && function_exists($a)) {
            call_user_func($a);
        }
    }
}
function add_ajax_handler($action, $callback)
{
    global $actions;
    $actions[$action] = $callback;
}
