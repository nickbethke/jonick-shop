<?php

class ProductCriteria extends Criteria
{
    public function run()
    {
        global $db;
        $SQL = "SELECT `id_product` FROM `products` ";
        if (sizeof($this->_filters)) {
            foreach ($this->_filters as $key => $filter) {
                if ($key === 0) {
                    $SQL .= "WHERE ";
                } else {
                    $SQL .= " AND ";
                }
                $SQL .= $filter->toString();
            }
        }
        $this->_limit ? $SQL .= " LIMIT " . $this->_limit : false;
        $this->_offset ? $SQL .= " OFFSET " . $this->_offset : false;

        $products = [];
        $productSQLs = $db->query($SQL)->fetchObject();
        foreach ($productSQLs as $product) {
            $p = new Product($product->id_product);
            $p ? $products[] = $p : false;
        }
        return $products;
    }
}
