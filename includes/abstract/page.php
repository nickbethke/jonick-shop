<?php

abstract class Page
{
    abstract function get_title();
    abstract function render();
    abstract function get_content();
}
