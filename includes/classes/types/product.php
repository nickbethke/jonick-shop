<?php

if (!defined('ABSPATH')) {
    exit;
}

class Product
{
    protected $id = null;
    protected $data = array(
        'name'               => '',
        'slug'               => '',
        'date_created'       => null,
        'date_modified'      => null,
        'status'             => false,
        'featured'           => false,
        'catalog_visibility' => 'visible',
        'description'        => '',
        'short_description'  => '',
        'sku'                => '',
        'price'              => '',
        'regular_price'      => '',
        'sale_price'         => '',
        'quantity'           => '',
        'image'              => ''
    );

    public function __construct($product = 0)
    {
        if (is_numeric($product) && $product > 0) {
            $this->set_id($product);
        } elseif ($product instanceof self) {
            $this->set_id(absint($product->get_id()));
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
    public function get_id()
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

    public function get_status()
    {
        return $this->get_prop('status');
    }

    public function get_featured()
    {
        return $this->get_prop('featured');
    }

    protected function get_catalog_visibility()
    {
        return $this->get_prop('catalog_visibility');
    }

    public function get_description()
    {
        return $this->get_prop('description');
    }

    public function get_short_description()
    {
        return $this->get_prop('short_description');
    }

    public function get_sku()
    {
        return $this->get_prop('sku');
    }

    public function get_price()
    {
        return $this->get_prop('price');
    }

    public function get_regular_price()
    {
        return $this->get_prop('regular_price');
    }

    public function get_sale_price()
    {
        return $this->get_prop('sale_price');
    }

    public function get_image()
    {
        return $this->get_prop('image');
    }
    public function get_quantity()
    {
        return (int) $this->get_prop('quantity');
    }

    public function get_gallery_images()
    {
        return $this->get_prop('gallery_images');
    }

    protected function is_visible()
    {
        return $this->is_visible_core();
    }
    protected function is_visible_core()
    {
        $visible = 'visible' === $this->get_catalog_visibility();

        if ('trash' === $this->get_status()) {
            $visible = false;
        } elseif ('publish' !== $this->get_status()) {
            $visible = false;
        }
        return $visible;
    }
    private function load()
    {
        $is_loaded = true;
        $result = ProductDB::getByID($this->id);
        property_exists($result, 'id_product') ? $this->id = $result->id_product : $is_loaded = false;
        foreach ($this->data as $name => $value) {
            property_exists($result, $name) ? $this->data[$name] = $result->$name : $is_loaded = false;
        }

        if (!$is_loaded) {
            return NULL;
        } else {
            return $this;
        }
    }
}
