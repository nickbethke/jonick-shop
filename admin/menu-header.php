<?php

$self = preg_replace('|^.*/admin/network/|i', '', $_SERVER['PHP_SELF']);
$self = preg_replace('|^.*/admin/|i', '', $self);
$self = preg_replace('|^.*/plugins/|i', '', $self);

global $menu;

require_once ABSPATH . "admin/includes/menu.php";

?>
<div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">
    <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
        <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-green-800 dark:bg-gray-800 border-none">
            <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden bg-white" src="<?php echo get_gravatar(jn_get_current_user()->data->email) ?>" />
            <span class="hidden md:block"><?php echo jn_get_current_user()->data->displayname ?></span>
        </div>
        <div class="flex justify-between items-center h-14 bg-green-800 dark:bg-gray-800 header-right">
            <div class="flex items-center w-full max-w-xl">
            </div>
            <ul class="flex items-center">
                <li>
                    <a href="/login.php?action=logout" class="flex items-center mr-4 hover:text-green-100">
                        <span class="inline-flex mr-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </span>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-green-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10 sidebar">
        <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
            <ul class="flex flex-col py-4 space-y-1">

                <?php
                foreach ($menu as $key => $menu_item) {
                    if ($menu_item[2] == $self) {
                        $css_class = "relative flex flex-row items-center h-9 focus:outline-none bg-green-500 text-white-600 text-white-800 border-l-4 border-transparent border-green-800 pr-6";
                    } else {
                        $css_class = "relative flex flex-row items-center h-9 focus:outline-none hover:bg-green-800 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-green-500 pr-6";
                    }
                ?><li>
                        <a href="<?php echo $menu_item[2] ?>" class="<?php echo $css_class ?>">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas <?php echo isset($menu_item[3])?$menu_item[3]:"fa-clog";?>"></i>
                            </span>

                            <span class="ml-2 text-sm tracking-wide truncate"><?php echo $menu_item[0] ?></span>
                        </a>
                    </li><?php
                        }
                            ?>
            </ul>
        </div>
    </div>