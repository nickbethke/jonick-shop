<?php

abstract class Criteria
{
    const CHAIN_APPEND  = 'append';
    const CHAIN_PREPEND = 'prepend';

    protected $_filters = array();

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
