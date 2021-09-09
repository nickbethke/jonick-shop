<?php

if (defined("USE_THEMES")) {
    enqueue_style('theme', get_theme_url("style.min.css"), ['tailwind'], '1.0.0');
    if (is_mobile()) {
        enqueue_style('tailwind', get_theme_url("css/tailwind.mobile.min.css"), [], '1.0.0');
    } else {
        enqueue_style('tailwind', get_theme_url("css/tailwind.min.css"), [], '1.0.0');
    }
}

add_ajax_handler("jn_action_no_priv_get_product", "test_function");

function test_function()
{
    echo json_encode([]);
    die;
}
function is_dark()
{
    return isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === "true";
}
