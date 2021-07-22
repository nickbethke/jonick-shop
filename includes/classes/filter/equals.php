<?php

class EqualsFilter
{
    private $field;
    private $value;
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }
    public function toString()
    {
        return $this->build();
    }
    private function build()
    {
        if (is_int($this->value)) {
            return "$this->field = $this->value";
        } elseif (is_string($this->value)) {
            return "$this->field = '" . $this->value . "'";
        }
    }
}
