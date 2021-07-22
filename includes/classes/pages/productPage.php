<?php

class PageProduct extends Page
{
    private $product = NULL;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function getProduct()
    {
        if ($this->product instanceof Product) {
            return $this->product;
        } else {
            return false;
        }
    }
    public function get_title()
    {
        return $this->product->get_name('name');
    }
    public function render()
    {
?>
        <title><?php echo $this->get_title() ?></title>
<?php
    }
}
