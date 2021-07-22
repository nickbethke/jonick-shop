<?php
class Page404 extends Page
{
    public function get_title()
    {
        return "404";
    }
    public function render()
    {
?>
        <title><?php echo $this->get_title() ?></title>
<?php
    }
}
