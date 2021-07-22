<?php

class Theme
{
    protected $dir = "";
    protected $info = null;
    public function __construct($dir)
    {
        $this->dir = $dir;
        $this->info = json_decode(file_get_contents($this->dir . "info.json"));
    }
    protected function get_prop($prop)
    {
        if (property_exists($this->info, $prop)) {
            return $this->info->$prop;
        }

        return null;
    }
    public function get_name()
    {
        return $this->get_prop('name');
    }
    public function get_version()
    {
        return $this->get_prop('version');
    }
    public function get_author()
    {
        return $this->get_prop('author');
    }
    public function get_author_URI()
    {
        return $this->get_prop('author_URI');
    }
    public function get_function_file()
    {
        if (file_exists($this->dir . "function.php")) {
            return $this->dir . "function.php";
        } else {
            return false;
        }
    }
    public function get_header()
    {
        if (file_exists($this->dir . "header.php")) {
            return $this->dir . "header.php";
        } else {
            return false;
        }
    }
    public function get_footer()
    {
        if (file_exists($this->dir . "footer.php")) {
            return $this->dir . "footer.php";
        } else {
            return false;
        }
    }
    public function load()
    {
        $files = [];
        return $files;
    }
    public function get_cms_page()
    {
        if (file_exists($this->dir . "cms_page.php")) {
            return $this->dir . "cms_page.php";
        } elseif (file_exists($this->dir . "index.php")) {
            return $this->dir . "index.php";
        } else {
            return false;
        }
    }
}
