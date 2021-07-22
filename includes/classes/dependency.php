<?php

class _Dependency
{

    public $handle;

    public $src;

    public $deps = array();


    public $ver = false;

    public $args = null;

    public $extra = array();

    public function __construct(...$args)
    {
        list($this->handle, $this->src, $this->deps, $this->ver, $this->args) = $args;
        if (!is_array($this->deps)) {
            $this->deps = array();
        }
    }
    public function add_data($name, $data)
    {
        if (!is_scalar($name)) {
            return false;
        }
        $this->extra[$name] = $data;
        return true;
    }
}
