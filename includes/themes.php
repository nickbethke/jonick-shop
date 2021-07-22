<?php

global $theme;

function load_theme()
{
    global $theme;
    $theme_dir = get_option('active_theme', 'default');
    if (file_exists(ABSPATH . "content/themes/$theme_dir/info.json")) {
        $theme = new Theme(ABSPATH . "content/themes/$theme_dir/");
    }
}
