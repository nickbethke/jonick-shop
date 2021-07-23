<?php

class PageCMS extends Page
{
    private $slug = "";
    private $data = [
        'title' => "",
        'content' => "",
        'slug' => "",
        'author' => "",
        'meta_title' => "",
        'meta_keywords' => "",
        'meta_description' => "",
        'status' => "draft",
        'date_created' => "",
        'date_modified' => ""
    ];
    public function __construct($slug)
    {
        $this->slug = $slug;
        $this->init();
    }
    private function init()
    {
        global $db;
        $SQL = "SELECT * FROM `cms_pages` WHERE `slug` = '$this->slug' LIMIT 1";
        $row = $db->query($SQL)->fetchRow(1);
        foreach ($this->data as $name => $value) {
            property_exists($row, $name) ? $this->data[$name] = $row->$name : $is_loaded = false;
        }
        return true;
    }
    protected function get_prop($prop)
    {
        if (array_key_exists($prop, $this->data)) {
            return $this->data[$prop];
        }

        return null;
    }

    public function get_title()
    {
        return $this->get_prop('title');
    }
    public function get_content()
    {
        return $this->get_prop('content');
    }
    public function render()
    {
        global $theme;
        $theme->get_cms_page() ? require_once $theme->get_cms_page() : false;
    }
    public static function page_exists($slug)
    {
        global $db;
        $SQL = "SELECT * FROM `cms_pages` WHERE `slug` = '$slug' LIMIT 1";
        $row = $db->query($SQL)->fetchRow();
        if (empty($row)) {
            return false;
        }
        return true;
    }
    public static function page_public_and_exists($slug)
    {
        global $db;
        $SQL = "SELECT * FROM `cms_pages` WHERE `slug` = '$slug' AND `status` = 'publish' LIMIT 1";
        $row = $db->query($SQL)->fetchRow();
        if (empty($row)) {
            return false;
        }
        return true;
    }
    public function is_public()
    {
        return $this->get_prop('status') == 'publish';
    }
}
