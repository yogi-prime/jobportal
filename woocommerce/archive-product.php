<?php
/**
 * The Template for displaying product archives (shop page)
 *
 * @package JobPortal
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 */
do_action('woocommerce_before_main_content');

?>

<div class="jobportal-shop-container">
    <div class="jobportal-container">

        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <header class="woocommerce-products-header">
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                <?php
                /**
                 * Hook: woocommerce_archive_description.
                 */
                do_action('woocommerce_archive_description');
                ?>
            </header>
        <?php endif; ?>

        <div class="jobportal-shop-layout">

            <?php if (is_active_sidebar('sidebar-shop')) : ?>
                <aside class="jobportal-shop-sidebar">
                    <?php dynamic_sidebar('sidebar-shop'); ?>
                </aside>
            <?php endif; ?>

            <main class="jobportal-shop-main">

                <?php if (woocommerce_product_loop()) : ?>

                    <?php
                    /**
                     * Hook: woocommerce_before_shop_loop.
                     */
                    do_action('woocommerce_before_shop_loop');

                    woocommerce_product_loop_start();

                    if (wc_get_loop_prop('total')) {
                        while (have_posts()) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action('woocommerce_shop_loop');

                            wc_get_template_part('content', 'product');
                        }
                    }

                    woocommerce_product_loop_end();

                    /**
                     * Hook: woocommerce_after_shop_loop.
                     */
                    do_action('woocommerce_after_shop_loop');
                    ?>

                <?php else : ?>

                    <?php
                    /**
                     * Hook: woocommerce_no_products_found.
                     */
                    do_action('woocommerce_no_products_found');
                    ?>

                <?php endif; ?>

            </main>

        </div>

    </div>
</div>

<?php

/**
 * Hook: woocommerce_after_main_content.
 */
do_action('woocommerce_after_main_content');

get_footer('shop');
