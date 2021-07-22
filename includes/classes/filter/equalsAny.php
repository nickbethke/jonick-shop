<?php

class EqualsAnyFilter
{
    private $field;
    private $values;
    public function __construct($field, $values)
    {
        $this->field = $field;
        $this->values = $values;
    }
    public function toString()
    {
        return $this->build();
    }
    private function build()
    {
        if (is_int($this->values)) {
            return "$this->field IN (" . $this->values . ")";
        } elseif (is_string($this->values)) {
            return "$this->field IN ('" . $this->values . "')";
        } elseif (is_array($this->values)) {
            foreach ($this->values as $key => $value) {
                if (is_string($value)) {
                    $this->values[$key] = "'" . $value . "'";
                }
            }
            return "$this->field IN (" . implode(",", $this->values) . ")";
        }
    }
}
