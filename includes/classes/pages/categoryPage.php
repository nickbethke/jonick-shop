<?php

class PageCategory extends Page
{
    private $category = NULL;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function get_title()
    {
        return $this->category->get_name();
    }
    public function render()
    {
?>
        <title><?php echo $this->get_title() ?></title>
<?php
    }
    public function get_content()
    {
    }
}
