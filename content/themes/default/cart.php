<?php
jn_header();
?>
<div class="pt-24 cart container mx-auto">
    <div class="text-white text-center">
        <h1 class="my-4 text-5xl font-bold leading-tight">Cart</h1>
    </div>
    <div class="flex justify-center my-6 md:my-12">
        <div class="flex flex-col md:flex-row w-full text-gray-800 shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5 md:rounded-md bg-white dark:bg-gray-900 dark:text-white">
            <div class="md:w-2/3 md:p-8 p-4">
                <table class="w-full text-sm lg:text-base" cellspacing="0">
                    <thead>
                        <tr class="h-12 uppercase">
                            <th class="text-left">Product</th>
                            <th class="lg:text-right text-left pl-5 lg:pl-0">
                                <span class="lg:hidden" title="Quantity">Qtd</span>
                                <span class="hidden lg:inline">Quantity</span>
                            </th>
                            <th class="hidden text-right md:table-cell">Unit price</th>
                            <th class="text-right">Total price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td>
                                <a href="#">
                                    <p class="mb-2 md:ml-4">Earphone</p>
                                    <form action="" method="POST">
                                        <button type="submit" class="text-gray-700 dark:text-gray-300 md:ml-4">
                                            <small>(Remove item)</small>
                                        </button>
                                    </form>
                                </a>
                            </td>
                            <td class="justify-center md:justify-end md:flex mt-6">
                                <div class="w-20 h-10">
                                    <div class="relative flex flex-row w-full h-8">
                                        <input type="number" value="2" class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black">
                                    </div>
                                </div>
                            </td>
                            <td class="hidden text-right md:table-cell">
                                <span class="text-sm lg:text-base font-medium">
                                    10.00€
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="text-sm lg:text-base font-medium">
                                    20.00€
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="mb-2 md:ml-4">Tesla Model 3</p>
                                <form action="" method="POST">
                                    <button type="submit" class="text-gray-700 dark:text-gray-300 md:ml-4">
                                        <small>(Remove item)</small>
                                    </button>
                                </form>
                            </td>
                            <td class="justify-center md:justify-end md:flex md:mt-4">
                                <div class="w-20 h-10">
                                    <div class="relative flex flex-row w-full h-8">
                                        <input type="number" value="3" class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black">
                                    </div>
                                </div>
                            </td>
                            <td class="hidden text-right md:table-cell">
                                <span class="text-sm lg:text-base font-medium">
                                    49,600.01€
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="text-sm lg:text-base font-medium">
                                    148,800.03€
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="mb-2 md:ml-4">Bic 4 colour pen</p>
                                <form action="" method="POST">
                                    <button type="submit" class="text-gray-700 dark:text-gray-300 md:ml-4">
                                        <small>(Remove item)</small>
                                    </button>
                                </form>
                            </td>
                            <td class="justify-center md:justify-end md:flex md:mt-8">
                                <div class="w-20 h-10">
                                    <div class="relative flex flex-row w-full h-8">
                                        <input type="number" value="5" class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black">
                                    </div>
                                </div>

                            </td>
                            <td class="hidden text-right md:table-cell">
                                <span class="text-sm lg:text-base font-medium">
                                    1.50€
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="text-sm lg:text-base font-medium">
                                    7.50€
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="md:w-1/3 p-4 md:p-8 bg-gray-100 dark:bg-gray-800 md:rounded-md">
                <div class="w-full lg:flex">
                    <div class="lg:px-2">
                        <div>
                            <h1 class="mb-6 font-bold uppercase">Order Details</h1>
                            <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>
                            <div class="flex justify-between border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-md lg:text-lg font-bold text-center text-gray-800 dark:text-gray-100">
                                    Subtotal
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-md font-bold text-center text-gray-900 dark:text-gray-50">
                                    148,827.53€
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-md lg:text-lg font-bold text-center text-gray-800 dark:text-gray-100">
                                    New Subtotal
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-md font-bold text-center text-gray-900 dark:text-gray-50">
                                    14,882.75€
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-md lg:text-lg font-bold text-center text-gray-800 dark:text-gray-100">
                                    Tax
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-md font-bold text-center text-gray-900 dark:text-gray-50">
                                    2,976.55€
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-md lg:text-lg font-bold text-center text-gray-800 dark:text-gray-100">
                                    Total
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-md font-bold text-center text-gray-900 dark:text-gray-50">
                                    17,859.3€
                                </div>
                            </div>
                            <a href="#">
                                <button class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-900 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                                    <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"></path>
                                    </svg>
                                    <span class="ml-2 mt-5px">Procceed to checkout</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php jn_footer();
