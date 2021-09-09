<?php

class PageCart extends Page
{
    public function get_title()
    {
        return "Cart";
    }
    public function render()
    {
        global $theme;
        $theme->get_cart_page() ? require_once $theme->get_cart_page() : false;
    }
    public function get_content()
    {
    }
}
