<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php jn_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php jn_head(); ?>
</head>

<body>
    <div class="w-full bg-center bg-cover h-16" style="background-image: url(https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80);">
        <div class="flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50">
            <div class="text-center">
                <h1 class="text-2xl font-semibold text-white uppercase lg:text-3xl"><?php echo get_the_title() ?></span></h1>
            </div>
        </div>
    </div>
    <div class="mt-2 container mx-auto">