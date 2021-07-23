<?php

require_once __DIR__ . '/admin.php';

admin_page_head('cms', 'CMS', ['cms', 'media-overlay']);
$pages = get_cms_pages_by("status", 'publish');

?>
<h1 class="text-5xl">CMS pages</h1>
<hr class="mb-2">
<div class="table w-full">
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="border-r p-2">
                    <input type="checkbox">
                </th>
                <th class="p-2 border-r cursor-pointer font-thin text-gray-500">
                    <div class="flex items-center font-bold">
                        Title
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer font-thin text-gray-500">
                    <div class="flex items-center font-bold">
                        Author
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer font-thin text-gray-500">
                    <div class="flex items-center font-bold">
                        Date
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer font-thin text-gray-500">
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page) : ?>
                <tr class="bg-gray-100 border-b hover:bg-gray-200" data-id="<?php echo $page->get_ID() ?>">
                    <td class="border-r p-2 text-center w-1/12">
                        <input type="checkbox">
                    </td>
                    <td class="p-2 border-r"><?php echo $page->get_prop('title') ?></td>
                    <td class="p-2 border-r w-1/6"><?php echo get_user_by("ID", $page->get_prop('author'))->data->displayname ?></td>
                    <td class="p-2 border-r w-1/6"><?php echo mysql2date(get_option('date_format') . " " . get_option('time_format'), $page->get_prop('date_created')) ?></td>
                    <td class="w-1/6">
                        <a href="/<?php echo $page->get_prop('slug') ?>/" target="_blank" class="bg-green-500 p-2 text-white hover:shadow-lg text-xs font-thin" data-id="<?php echo $page->get_ID() ?>"><i class="fas fa-eye"></i></a>
                        <a href="cms_edit.php?id=<?php echo $page->get_ID() ?>" class="bg-blue-500 p-2 text-white hover:shadow-lg text-xs font-thin" data-id="<?php echo $page->get_ID() ?>"><i class="fas fa-pen"></i></a>
                        <a href="#" class="bg-red-500 p-2 text-white hover:shadow-lg text-xs font-thin" data-id="<?php echo $page->get_ID() ?>"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php


admin_page_footer('cms');
