<?php

class ProductRepository
{
    public function get()
    {
    }
    public function getById($productId)
    {
        $criteria = new ProductCriteria();
        $criteria->addFilter(new EqualsFilter('id_product', $productId));
        return $criteria->run();
    }
    public function getByName($productName)
    {
        $criteria = new ProductCriteria();
        $criteria->addFilter(new EqualsFilter('name', $productName));
        return $criteria->run();
    }
    public function getByIds(array $ids)
    {
        $criteria = new ProductCriteria();
        $criteria->addFilter(new EqualsAnyFilter('id_product', $ids));
        return $criteria->run();
    }
    public function getAll()
    {
        $criteria = new ProductCriteria();
        return $criteria->run();
    }
    public function getFeatured()
    {
        $criteria = new ProductCriteria();
        $criteria->addFilter(new EqualsAnyFilter('featured', 1));
        return $criteria->run();
    }
}
