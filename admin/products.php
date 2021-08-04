<?php

require_once __DIR__ . '/admin.php';

admin_page_head('products', 'Products', ['products', 'media-overlay']);
$page = isset($_GET['p']) ? $_GET['p'] : 1;
$ppp = 10;

$offset = ($ppp * ($page - 1));
$productsRepo = new ProductRepository();
$products = $productsRepo->getAll($ppp, $offset);
$paginationProducts = $productsRepo->getAll();
?>
<h1 class="text-5xl">Products</h1>
<p>-> View</p>
<p>-> Edit</p>
<p>-> Trash</p>
<p>-> Status Change</p>
<hr class="mb-2">
<table class="min-w-max w-full table-auto">
    <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase leading-normal">
            <th class="py-3 px-6 text-left">Name</th>
            <th class="py-3 px-6 text-left">Short Description</th>
            <th class="py-3 px-6 text-left">Quantity</th>
            <th class="py-3 px-6 text-center">Status</th>
            <th class="py-3 px-6 text-center">Date</th>
            <th class="py-3 px-6 text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 font-light">
        <?php foreach ($products as $product) : ?>
            <tr id="product-<?php echo $product->get_ID(); ?>" class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                        <span class="font-medium"><?php echo $product->get_name() ?></span>
                    </div>
                </td>
                <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <?php echo $product->get_short_description() ?>
                    </div>
                </td>
                <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <?php echo $product->get_quantity() ?>
                    </div>
                </td>
                <td class="py-3 px-6 text-center">
                    <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-sm font-bold"><?php echo $product->get_status() ?></span>
                </td>
                <td class="py-3 px-6 text-center">
                    <?php echo mysql2date(get_option('date_format') . " " . get_option('time_format'), $product->get_date_created()) ?>
                </td>
                <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center">
                        <div class="w-4 mr-2 transform hover:text-blue-600 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <a href="product_edit.php?product=<?php echo $product->get_ID(); ?>">
                            <div class="w-4 mr-2 transform hover:text-green-600 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                        </a>
                        <div class="w-4 mr-2 transform hover:text-red-600 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php

$productSum = sizeof($paginationProducts);
$pages = ceil($productSum / $ppp);


if ($pages > 1) : ?>
    <div>
        <ul class="flex pl-0 list-none rounded my-2">
            <?php for ($i = 1; $i < $pages; $i++) : ?>
                <a class="page-link" href="?p=<?php echo $i ?>">
                    <li class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 hover:bg-gray-200<?php echo $i == $page ? " bg-green-100" : false ?>"><?php echo $i ?></li>
                </a>
            <?php endfor; ?>

            <a class="page-link" href="?p=<?php echo $i ?>">
                <li class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 hover:bg-gray-200<?php echo $i == $page ? " bg-green-100" : false ?>"><?php echo $i ?></li>
            </a>
        </ul>
    </div>
<?php
endif;

admin_page_footer('products');
