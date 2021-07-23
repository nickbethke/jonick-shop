<?php

global $title, $hook_suffix;

$title = strip_tags($title);

$admin_title = "jonick Shop";

if ($admin_title === $title) {
    $admin_title = sprintf('%s', $title);
} else {
    $admin_title = sprintf('%1$s &lsaquo; %2$s', $title, $admin_title);
}

enqueue_style("common-admin");
enqueue_style("tailwind");
enqueue_style("tailwind-custom");
enqueue_style('fontawesome');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $admin_title ?></title>
    <link rel="icon" type="image/png" sizes="192x192" href="/includes/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/includes/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/includes/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/includes/fav/favicon-16x16.png">
    <?php admin_print_styles() ?>
</head>

<body class="jn-admin no-js">
    <script type="text/javascript">
        document.body.className = document.body.className.replace('no-js', 'js');
    </script>

    <div id="wrap">
        <?php require ABSPATH . 'admin/menu-header.php'; ?>
        <div id="content" class="h-full ml-16 mt-0 md:mt-14 mb-10 md:ml-64 px-4 pt-2">