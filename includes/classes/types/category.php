<?php

if (!defined('ABSPATH')) {
    exit;
}

class Category
{
    protected $id = null;
    protected $data = array(
        'id_parent'          => null,
        'name'               => '',
        'slug'               => '',
        'description'        => '',
        'meta_title'         => '',
        'meta_description'   => '',
        'active'             => false,
        'date_created'       => null,
        'date_modified'      => null,
        'position'           => false,
        'is_root_category'   => true,
    );

    public function __construct($category = 0)
    {
        if (is_numeric($category) && $category > 0) {
            $this->set_id($category);
        } elseif ($category instanceof self) {
            $this->set_id(absint($category->get_id()));
        }
        if ($this->get_id() > 0) {
            return $this->load();
        } else {
            return NULL;
        }
    }
    protected function set_id($id)
    {
        $this->id = absint($id);
    }
    protected function get_id()
    {
        return (int) $this->id;
    }
    protected function get_prop($prop)
    {
        if (array_key_exists($prop, $this->data)) {
            return $this->data[$prop];
        }

        return null;
    }

    public function get_name()
    {
        return $this->get_prop('name');
    }


    public function get_slug()
    {
        return $this->get_prop('slug');
    }


    public function get_date_created()
    {
        return $this->get_prop('date_created');
    }


    public function get_date_modified()
    {
        return $this->get_prop('date_modified');
    }

    public function get_description()
    {
        return $this->get_prop('description');
    }

    protected function is_active()
    {
        return $this->get_prop('active');
    }

    private function load()
    {
        $is_loaded = true;
        $result = CategoryDB::getByID($this->id);
        property_exists($result, 'id_category') ? $this->id = $result->id_category : $is_loaded = false;
        foreach ($this->data as $name => $value) {
            property_exists($result, $name) ? $this->data[$name] = $result->$name : $is_loaded = false;
        }
        if (!$is_loaded) {
            return NULL;
        }
    }
}
