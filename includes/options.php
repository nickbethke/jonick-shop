<?php


function get_option($option, $default = false)
{
    global $db, $cache;

    $option = trim($option);
    if (empty($option)) {
        return false;
    }
    $value = get_cache($option, 'options');

    if (false === $value) {


        $row = $db->query("SELECT `value` FROM `options` WHERE `name` = '$option' LIMIT 1")->fetchRow(1);

        if (property_exists($row, 'value')) {
            $value = maybe_unserialize($row->value);
            set_cache($option, $value, 'options');
            return $value;
        }
    } else {
        return $value;
    }
    return $default;
}
