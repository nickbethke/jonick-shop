<?php
define("INC_PATH", ABSPATH . "includes/");
define("CONTENT_PATH", ABSPATH . "content/");

$required_php_version = "7.3";

require_once INC_PATH . "load.php";

check_php_versions();

global $db, $cache;

require_db();

require_once INC_PATH . "formatting.php";

require_once INC_PATH . "classes/cache.php";

$cache = new Cache();

require_once INC_PATH . "classes/imageHandler.php";

require_once INC_PATH . "classes/database/product.php";
require_once INC_PATH . "classes/database/category.php";

require_once INC_PATH . "classes/types/product.php";
require_once INC_PATH . "classes/types/category.php";

require_once INC_PATH . "classes/repos/productRepository.php";
require_once INC_PATH . "classes/repos/categoryRepository.php";


require_once INC_PATH . "classes/filter/equals.php";
require_once INC_PATH . "classes/filter/unequals.php";
require_once INC_PATH . "classes/filter/equalsAny.php";

require_once INC_PATH . "abstract/criteria.php";

require_once INC_PATH . "classes/criteria/productCriteria.php";
require_once INC_PATH . "classes/criteria/categoryCriteria.php";

require_once INC_PATH . "abstract/page.php";

require_once INC_PATH . "classes/pages/indexPage.php";
require_once INC_PATH . "classes/pages/categoryPage.php";
require_once INC_PATH . "classes/pages/cmsPage.php";
require_once INC_PATH . "classes/pages/productPage.php";
require_once INC_PATH . "classes/pages/404Page.php";
require_once INC_PATH . "classes/pages/cartPage.php";

require_once INC_PATH . "user.php";
require_once INC_PATH . "classes/user.php";

require_once INC_PATH . "classes/cms_page.php";

require_once INC_PATH . "options.php";
require_once INC_PATH . "http.php";
require_once INC_PATH . "formatting.php";

global $actions;

$actions = [];

require_once INC_PATH . "ajax.php";

require_once INC_PATH . "classes/dependency.php";
require_once INC_PATH . "classes/dependencies.php";
require_once INC_PATH . "classes/styles.php";
require_once INC_PATH . "classes/scripts.php";

global $styles, $scripts;
require_once INC_PATH . "styles.php";
require_once INC_PATH . "scripts.php";

require_once INC_PATH . "classes/Parsedown.php";

require_once INC_PATH . "classes/core.php";

require_once INC_PATH . "classes/core.php";

require_once INC_PATH . "function.php";

require_once INC_PATH . "general-template.php";

/* Plugins & Themes */
global $theme;
require_once INC_PATH . "themes.php";
require_once INC_PATH . "classes/types/theme.php";

load_theme();

$theme->get_function_file() ? require_once $theme->get_function_file() : false;

if (defined("USE_THEMES")) {
    global $CORE;
    $CORE = new Core();
    global $page;
    $CORE->load();

    $page = $CORE->getPage();



    $files_to_load = $theme->load();



    $page->render();
}
