<?php

class ImageHandler
{
    private $filename = null;
    private $pathinfo;
    private $url = "";
    public function __construct($filename)
    {
        if (file_exists($filename)) {
            $this->filename = $filename;
            $this->url = get_site_url() . "/" . str_replace(ABSPATH, "", $this->filename);
            $this->pathinfo = pathinfo($this->filename);
        } else {
            return false;
        }
    }
    public function gen_thumbnail()
    {
        return $this->resize(100, 100);
    }
    public function resize($width, $height)
    {
        $original_img = imagecreatefromstring(file_get_contents($this->filename));
        $resized_img = imagecreatetruecolor($width, $height);

        imagecopyresampled($resized_img, $original_img, 0, 0, 0, 0, $width, $height, $this->get_width(), $this->get_height());

        $newFile = $this->get_dirname() . "/" . $this->get_filename() . "_" . $width . "_" . $height . "." . $this->get_extension();
        if (imagepng($resized_img, $newFile)) {
            return new self($newFile);
        }
        return false;
    }
    private function get_info()
    {
        return getimagesize($this->filename);
    }
    public function get_width()
    {
        return $this->get_info()[0];
    }
    public function get_height()
    {
        return $this->get_info()[1];
    }
    public function get_dirname()
    {
        return $this->pathinfo['dirname'];
    }
    public function get_basename()
    {
        return $this->pathinfo['basename'];
    }
    public function get_extension()
    {
        return $this->pathinfo['extension'];
    }
    public function get_filename()
    {
        return $this->pathinfo['filename'];
    }
    public function get_size()
    {
        return filesize($this->filename);
    }
    public function get_mime_type()
    {
        return mime_content_type($this->filename);
    }
    public function get_url()
    {
        return $this->url;
    }
}
