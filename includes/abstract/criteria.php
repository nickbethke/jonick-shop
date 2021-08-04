<?php

abstract class Criteria
{
    const CHAIN_APPEND  = 'append';
    const CHAIN_PREPEND = 'prepend';

    protected $_filters = array();
    protected $_limit = null;
    protected $_offset = null;

    public function addLimit(int $limit)
    {
        $this->_limit = intval($limit);
        return $this;
    }

    public function addOffsett(int $offset)
    {
        $this->_offset = intval($offset);
        return $this;
    }

    public function addFilter($filter, $placement = self::CHAIN_APPEND)
    {
        if ($placement == self::CHAIN_PREPEND) {
            array_unshift($this->_filters, $filter);
        } else {
            $this->_filters[] = $filter;
        }
        return $this;
    }

    public function appendFilter($filter)
    {
        return $this->addFilter($filter, self::CHAIN_APPEND);
    }

    public function prependFilter($filter)
    {
        return $this->addFilter($filter, self::CHAIN_PREPEND);
    }

    public function getFilters()
    {
        return $this->_filters;
    }
    abstract public function run();
}
