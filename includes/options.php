<?php


function get_option($option, $default = false)
{
    global $db;

    $option = trim($option);
    if (empty($option)) {
        return false;
    }

    $row = $db->query("SELECT `value` FROM `options` WHERE `name` = '$option' LIMIT 1")->fetchRow(1);

    if (property_exists($row, 'value')) {
        return maybe_unserialize($row->value);
    }
    return $default;
}
