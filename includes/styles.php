<?php

function enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all')
{
    $styles = styles();

    if ($src) {
        $_handle = explode('?', $handle);
        $styles->add($_handle[0], $src, $deps, $ver, $media);
    }

    $styles->enqueue($handle);
}


function styles()
{
    global $styles;

    if (!($styles instanceof Styles)) {
        $styles = new Styles();
    }

    return $styles;
}

function admin_print_styles()
{
    $styles = styles();
    $stylesHandler = $styles->do_items();
    $styles->reset();
}
function load_default_admin_style()
{
    $styles = styles();
    $styles->add('tailwind', "/admin/includes/css/tailwind/tailwind.min.css");
    $styles->add('common-admin', "/admin/includes/css/common.min.css", ['tailwind']);
    $styles->add('dashboard', "/admin/includes/css/dashboard.min.css", ['tailwind']);
    $styles->add('fontawesome', "https://pro.fontawesome.com/releases/v5.10.0/css/all.css");
    $styles->add('tailwind-custom', "/admin/includes/css/tailwind/custom.min.css", ['tailwind']);
    $styles->add('modal', "/admin/includes/css/tailwind/modal.css", ['tailwind']);
}
