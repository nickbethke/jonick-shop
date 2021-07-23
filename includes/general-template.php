<?php

function language_attributes($doctype = 'html')
{
    echo get_language_attributes($doctype);
}
function get_language_attributes($doctype = 'html')
{
    $attributes = array();

    $lang = get_bloginfo('language');
    if ($lang) {
        if ('text/html' === get_option('html_type') || 'html' === $doctype) {
            $attributes[] = 'lang="' . esc_attr($lang) . '"';
        }

        if ('text/html' !== get_option('html_type') || 'xhtml' === $doctype) {
            $attributes[] = 'xml:lang="' . esc_attr($lang) . '"';
        }
    }
    return implode(' ', $attributes);
}
function get_bloginfo($show = '', $filter = 'raw')
{
    switch ($show) {
        case 'language':
            $output = 'en_US';
            $output = str_replace('_', '-', $output);
            break;
        case 'charset':
            $output = get_option('blog_charset');
            if ('' === $output) {
                $output = 'UTF-8';
            }
            break;
        case 'name':
        default:
            $output = get_option('store_name');
            break;
    }
    return $output;
}
function bloginfo($show = '')
{
    echo get_bloginfo($show, 'display');
}
function jn_title()
{
    global $page;
    echo $page->get_title();
}
function jn_head()
{
?>
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_site_url() ?>/includes/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_site_url() ?>/includes/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_site_url() ?>/includes/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_site_url() ?>/includes/fav/favicon-16x16.png">

<?php
    $styles = styles();
    $stylesHandler = $styles->do_items();
    $styles->reset();
}
function jn_header()
{
    global $theme;
    $theme->get_header() ? require_once $theme->get_header() : false;
}
function jn_footer()
{
    global $theme;
    $theme->get_footer() ? require_once $theme->get_footer() : false;
}
function get_content()
{
    global $page;
    return $page->get_content();
}
function get_the_title()
{
    global $page;
    return $page->get_title();
}
