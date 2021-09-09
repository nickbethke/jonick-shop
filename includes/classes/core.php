<?php

if (!defined('ABSPATH')) {
    exit;
}

class Core
{
    private $page = NULL;
    private $type = "404";

    private $productPageController = "PageProduct";
    private $indexPageController = "PageIndex";

    public function __construct()
    {
    }

    public function load()
    {
        $request = self::handleRequest();
        $requestArray = explode("/", $request);

        /* Homepage */
        if ($requestArray[0] === 'index') {
            $this->page = new $this->indexPageController();
            $this->type = "index";
            return;
        }

        /* Category */
        if (sizeof($requestArray) >= 2 && CATEGORY_URL_PREFIX === $requestArray[0]) {
            $repo = new CategoryRepository();
            $category = $repo->getBySlug($requestArray[1]);
            if (is_array($category) && !empty($category)) {
                $category = $category[0];
            }
            if (!empty($category) && $category instanceof Category) {
                $this->page = new PageCategory($category);
                $this->type = "category";
            } else {
                $this->page = new Page404();
            }
            return;
        }

        /* Product */
        if (sizeof($requestArray) == 2 && PRODUCT_URL_PREFIX === $requestArray[0]) {
            $slug = $requestArray[1];
            $this->page = $this->loadProductPage($slug);
            $this->type = "product";
            return;
        }

        /* Cart */
        if ($requestArray[0] === 'cart') {
            $this->page = new PageCart();
            $this->type = "cart";
            return;
        }

        /* CMS */
        $requestSlug = implode('/', $requestArray);
        if (PageCMS::page_exists($requestSlug)) {
            $page = new PageCMS($requestSlug);
            if ($page->is_public()) {
                $this->page = $page;
                $this->type = "cms";
                return;
            } else {
                $this->page = new Page404;
                return;
            }
        }
        $this->page = new Page404;
    }
    public function set_page($page)
    {
        $this->page = $page;
    }
    public function get_page_type()
    {
        return $this->type;
    }

    private static function handleRequest()
    {
        return ltrim(rtrim(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != "/" ? $_SERVER['REQUEST_URI'] : "index", "/"), "/");
    }

    private function loadProductPage($slug)
    {
        $criteria = new ProductCriteria();
        $criteria->addFilter(new EqualsFilter('slug', $slug));
        $product = $criteria->run();
        if (is_array($product) && !empty($product)) {
            $product = $product[0];
            $productPageController = $this->productPageController;
            return new $productPageController($product);
        }
        return new Page404();
    }

    public static function callStack()
    {
        print "<pre>";
        print str_repeat("=", 50) . "\n";
        $i = 1;
        foreach (debug_backtrace() as $node) {
            print "$i. " . basename($node['file']) . " : " . $node['function'] . " (" . $node['line'] . ")\n";
            $i++;
        }
        print str_repeat("=", 50);
        print "</pre>";
    }
    /**
     * @return Page $page
     */
    public function getPage()
    {
        return $this->page;
    }

    public function addProductPageController($className)
    {
        if (class_exists($className) && "Page" === get_parent_class($className)) {
            $this->productPageController = $className;
        }
    }

    public function addIndexPageController($className)
    {
        if (class_exists($className) && "Page" === get_parent_class($className)) {
            $this->indexPageController = $className;
        }
    }
}
