<?php

function enqueue_scripts($handle, $src = '', $deps = array(), $ver = false, $media = 'all')
{
    $scripts = scripts();

    if ($src) {
        $_handle = explode('?', $handle);
        $scripts->add($_handle[0], $src, $deps, $ver, $media);
    }

    $scripts->enqueue($handle);
}

function scripts()
{

    global $scripts;

    if (!($scripts instanceof Scripts)) {
        $scripts = new Scripts();
    }

    return $scripts;
}

function admin_print_scripts()
{
    $scripts = scripts();
    $scriptsHandler = $scripts->do_items();
    $scripts->reset();
}
function load_default_admin_scripts()
{
    $scripts = scripts();
    $scripts->add('tinymce', "https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.8.2/tinymce.min.js");
    $scripts->add('jquery', "/admin/includes/js/jquery-3.6.0.min.js");
    $scripts->add('action', "/admin/includes/js/action.js", ['jquery']);
    $scripts->add('modal', "/admin/includes/js/modal.js", ['jquery']);
}
