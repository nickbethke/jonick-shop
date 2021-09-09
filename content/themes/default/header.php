<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php echo is_dark() ? "class='dark'" : false; ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php jn_title(); ?></title>
    
    <?php jn_head(); ?>
</head>

<body class="leading-normal tracking-normal text-white">
    <nav id="header" class="fixed w-full z-30 top-0 bg-white dark:bg-gray-900">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div class="pl-4 flex items-center">
                <a class="toggleColour no-underline hover:no-underline font-bold text-2xl lg:text-4xl text-white" href="<?php echo get_site_url() ?>">
                    <img class="h-8 md:h-16" src="/includes/images/logo.webp" alt="logo" srcset="/includes/images/logo.webp">
                </a>
            </div>
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </button>
            </div>
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:relative lg:block lg:bg-transparent text-black p-4 lg:p-0 z-20 bg-gray-100 dark:bg-gray-900" id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-black font-bold no-underline dark:text-white" href="<?php echo get_site_url("/cart/") ?>" title="Cart">
                            <svg class="h-8 hidden md:block hover:scale-150 transform duration-500 dark:text-white text-black fill-current" version="1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489 489" title="Cart">
                                <path d="M440 423l-28-316c0-7-6-12-13-12h-58a97 97 0 0 0-193 0H90c-7 0-13 5-13 12L49 423v1c0 36 33 65 73 65h245c40 0 73-29 73-65v-1zM245 27c37 0 68 30 69 68H175c1-38 32-68 70-68zm122 435H122c-25 0-46-17-46-37l27-303h45v41c0 8 6 14 13 14s14-6 14-14v-41h139v41c0 8 6 14 14 14s13-6 13-14v-41h45l27 303c0 20-21 37-46 37z"></path>
                            </svg>
                            <span class="md:hidden">Cart</span>
                        </a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-black font-bold no-underline dark:text-white" href="#" id="darkModeHandler">
                            <svg class="h-8 hidden md:block hover:scale-150 transform duration-500 dark:text-white text-black fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
                                <path d="M10,20C4.5,20,0,15.5,0,10S4.5,0,10,0s10,4.5,10,10S15.5,20,10,20z M10,2c-4.4,0-8,3.6-8,8s3.6,8,8,8s8-3.6,8-8S14.4,2,10,2z"></path>
                                <path class="contrast" d="M10,4v12c3.3,0,6-2.7,6-6S13.3,4,10,4z"></path>
                                <span class="md:hidden">Dark Mode</span>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0">
    </nav>