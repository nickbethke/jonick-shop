<?php
class Page404 extends Page
{
    public function get_title()
    {
        return "404";
    }
    public function render()
    {
        global $theme;
        $theme->get_404_page() ? require_once $theme->get_404_page() : false;
    }
    public function get_content()
    {
    }
}
