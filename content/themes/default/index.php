<?php
jn_header();
?>
<div class="pt-24 text-white">

    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left mb-8 md:m-0">
            <p class="uppercase tracking-loose w-full">jonick Shop system</p>
            <h1 class="my-4 text-5xl font-bold leading-tight">Welcome to this new shop!</h1>
            <button class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg">Register</button>
        </div>
        <!--Right Col-->
        <div class="hidden md:block md:w-3/5 py-6 text-center">
            <img class="object-contain h-40 md:h-80 mb-4 md:m-0 w-full md:w-3/4 z-40" src="<?php echo get_theme_url() ?>/images/open.png" alt="open sign">
        </div>
    </div>
</div>
<div class="relative -mt-12 lg:-mt-24">
    <img style="margin-bottom: -1px;" src="<?php echo get_theme_url("/images/hero-bottom.svg") ?>" alt="hero bottom" srcset="<?php echo get_theme_url("/images/hero-bottom.svg") ?>">
</div>
<section class="bg-white border-b py-8">
    <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Title</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-5/6 sm:w-1/2 p-6">
                <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">Lorem ipsum dolor sit amet</h3>
                <p class="text-gray-600 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo posuere et sit amet ligula.
            </div>
            <div class="w-full sm:w-1/2 p-6">
                <img class="w-full sm:h-64 mx-auto" src="<?php echo get_theme_url("/images/travel-booking.svg") ?>" alt="travel booking" srcset="<?php echo get_theme_url("/images/travel-booking.svg") ?>">

            </div>
        </div>


        <div class="flex flex-wrap flex-col-reverse sm:flex-row">
            <div class="w-full sm:w-1/2 p-6 mt-6">
                <img class="w-5/6 sm:h-64 mx-auto" src="<?php echo get_theme_url("/images/connected-world.svg") ?>" alt="connected world" srcset="<?php echo get_theme_url("/images/connected-world.svg") ?>">
            </div>
            <div class="w-full sm:w-1/2 p-6 mt-6">
                <div class="align-middle">
                    <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">Lorem ipsum dolor sit amet</h3>
                    <p class="text-gray-600 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo posuere et sit amet ligula.
                </div>
            </div>

        </div>
    </div>
</section>
<img style="margin-top: -1px;" src="<?php echo get_theme_url("/images/wave-top.svg") ?>" alt="wave top" srcset="<?php echo get_theme_url("/images/wave-top.svg") ?>">
<section class="container mx-auto text-center py-6 mb-12">

    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">Call to Action</h1>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
    </div>

    <h3 class="my-4 text-3xl leading-tight">Main Hero Message to sell yourself!</h3>

    <button class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg">Action!</button>

</section>
<?php jn_footer();
