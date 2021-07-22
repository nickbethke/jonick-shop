<?php

class CategoryRepository
{
    public function get()
    {
    }
    public function getById($categoryId)
    {
        $criteria = new CategoryCriteria();
        $criteria->addFilter(new EqualsFilter('id_category', $categoryId));
        return $criteria->run();
    }
    public function getByName($categoryName)
    {
        $criteria = new CategoryCriteria();
        $criteria->addFilter(new EqualsFilter('name', $categoryName));
        return $criteria->run();
    }
    /**
     * @return Category $category
     */
    public function getBySlug($categorySlug)
    {
        $criteria = new CategoryCriteria();
        $criteria->addFilter(new EqualsFilter('slug', $categorySlug));
        return $criteria->run();
    }
    public function getByIds(array $ids)
    {
        $criteria = new CategoryCriteria();
        $criteria->addFilter(new EqualsAnyFilter('id_category', $ids));
        return $criteria->run();
    }
    public function getAll()
    {
        $criteria = new CategoryCriteria();
        return $criteria->run();
    }
    public function getFeatured()
    {
        $criteria = new CategoryCriteria();
        $criteria->addFilter(new EqualsAnyFilter('featured', 1));
        return $criteria->run();
    }
}
