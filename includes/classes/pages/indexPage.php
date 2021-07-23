<?php

class PageIndex extends Page
{
    public function __construct()
    {
    }
    public function get_title()
    {
        return get_option('store_name');
    }
    public function render()
    {
        global $theme;
        $theme->get_index_page() ? require_once $theme->get_index_page() : false;
    }
    public function get_content()
    {
    }
}
