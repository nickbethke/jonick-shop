<?php

function set_current_screen($hook_name = '')
{
    if ($hook_name) {
        $id = $hook_name;
    } else {
        $id = $GLOBALS['hook_suffix'];
    }
    if ('.php' === substr($id, -4)) {
        $id = substr($id, 0, -4);
    }
    load_default_admin_style();
    load_default_admin_scripts();
}
