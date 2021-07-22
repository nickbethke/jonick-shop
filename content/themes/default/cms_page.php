<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title><?php jn_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php jn_head(); ?>
</head>

<body>
    <h1><?php echo get_the_title() ?></h1>
    <hr>
    <div>
        <?php echo get_content() ?>
    </div>
</body>

</html>