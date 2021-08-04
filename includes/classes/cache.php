<?php

class Cache
{
    private $cache = array();
    public function __construct()
    {
    }
    public function replace($key, $data, $group = 'default')
    {
        if (empty($group)) {
            $group = 'default';
        }

        $id = $key;
        if (!$this->_exists($id, $group)) {
            return false;
        }

        return $this->set($key, $data, $group);
    }
    public function delete($key, $group)
    {
        unset($this->cache[$group][$key]);
    }

    public function flush()
    {
        $this->cache = array();

        return true;
    }
    public function get($key, $group = 'default')
    {
        if (empty($group)) {
            $group = 'default';
        }

        if ($this->_exists($key, $group)) {
            if (is_object($this->cache[$group][$key])) {
                return clone $this->cache[$group][$key];
            } else {
                return $this->cache[$group][$key];
            }
        }
        return false;
    }
    public function get_multiple($keys, $group = 'default', $force = false)
    {
        $values = array();

        foreach ($keys as $key) {
            $values[$key] = $this->get($key, $group, $force);
        }

        return $values;
    }

    public function set($key, $data, $group = 'default')
    {
        if (empty($group)) {
            $group = 'default';
        }

        if (is_object($data)) {
            $data = clone $data;
        }

        $this->cache[$group][$key] = $data;
        return true;
    }

    protected function _exists($key, $group)
    {
        return isset($this->cache[$group]) && (isset($this->cache[$group][$key]) || array_key_exists($key, $this->cache[$group]));
    }
}
