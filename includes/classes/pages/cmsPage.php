<?php

class PageCMS extends Page
{
    public function __construct()
    {
    }
    public function get_title()
    {
        return "%Page Title%";
    }
    public function render()
    {
?>
        <title><?php echo $this->get_title() ?></title>
<?php
    }
}
