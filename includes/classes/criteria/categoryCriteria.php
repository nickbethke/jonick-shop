<?php

class CategoryCriteria extends Criteria
{
    public function run()
    {
        global $db;
        $SQL = "SELECT `id_category` FROM `categories` ";
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
        $categories = [];
        $categoriesSQLs = $db->query($SQL)->fetchObject();
        foreach ($categoriesSQLs as $category) {
            $p = new Category($category->id_category);
            $p ? $categories[] = $p : false;
        }
        return $categories;
    }
}
