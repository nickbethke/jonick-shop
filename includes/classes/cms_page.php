<?php

class CMSPage
{
    public $data;
    public $ID = 0;
    public function __construct($id = 0)
    {
        if ($id instanceof self) {
            $this->init($id->data);
            return;
        } elseif (is_object($id)) {
            $this->init($id);
            return;
        }
        if ($id) {
            $data = self::get_data_by('id', $id);
        }

        if ($data) {
            $this->init($data);
        } else {
            $this->data = new stdClass;
        }
    }
    public function init($data)
    {
        if (!isset($data->ID)) {
            $data->ID = 0;
        }
        $this->data = $data;
        $this->ID   = (int) $data->id_cms_page;
    }
    static function get_data_by($field, $value)
    {
        global $db;
        if ($field === 'ID') {
            $field = 'id';
        }
        if ('id' === $field) {
            // Make sure the value is numeric to avoid casting objects, for example,
            // to int 1.
            if (!is_numeric($value)) {
                return false;
            }
            $value = (int) $value;
            if ($value < 1) {
                return false;
            }
        } else {
            $value = trim($value);
        }

        if (!$value) {
            return false;
        }

        switch ($field) {
            case 'id':
                $value    = $value;
                $db_field = 'id_cms_page';
                break;
            case 'slug':
                $value    = $value;
                $db_field = 'email';
                break;
            case 'status':
                $value    = $value;
                $db_field = 'status';
                break;
            default:
                return false;
        }

        $page = $db->query("SELECT * FROM `cms_pages` WHERE $db_field = '" . $value . "' LIMIT 1")->fetchRow(1);
        if (!$page || empty($page)) {
            return false;
        } else {
            $page = json_decode(json_encode($page));
        }
        return $page;
    }
    static function get_datas_by($field, $value)
    {
        global $db;
        if ($field === 'ID') {
            $field = 'id';
        }
        if ('id' === $field) {
            // Make sure the value is numeric to avoid casting objects, for example,
            // to int 1.
            if (!is_numeric($value)) {
                return false;
            }
            $value = (int) $value;
            if ($value < 1) {
                return false;
            }
        } else {
            $value = trim($value);
        }

        if (!$value) {
            return false;
        }

        switch ($field) {
            case 'id':
                $value    = $value;
                $db_field = 'id_cms_page';
                break;
            case 'slug':
                $value    = $value;
                $db_field = 'email';
                break;
            case 'status':
                $value    = $value;
                $db_field = 'status';
                break;
            default:
                return false;
        }

        $pages = $db->query("SELECT * FROM `cms_pages` WHERE $db_field = '" . $value . "'")->fetchObject();
        if (is_array($pages)) {
            return $pages;
        }
        return false;
    }
    public function get_ID()
    {
        return $this->ID;
    }
    public function get_prop($prop)
    {
        if (property_exists($this->data, $prop)) {
            return $this->data->$prop;
        }

        return null;
    }
}
