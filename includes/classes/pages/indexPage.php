<?php

class PageIndex extends Page
{
    public function __construct()
    {
    }
    public function get_title()
    {
        return get_option('store_name');
    }
    public function render()
    {
?>
        <title><?php echo $this->get_title() ?></title>
<?php
    }
}
