<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */

get_header();
?>
	<?php remax_store_before_mainsec(); ?>

	<?php if ( remax_store_page_layout() == 'remax-store-left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

	<?php endif ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php remax_store_content_top(); ?>

		<?php remax_store_content_page_loop(); ?>

		<?php remax_store_content_bottom(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php if ( remax_store_page_layout() == 'remax-store-right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

	<?php endif ?>
	
	<?php remax_store_after_mainsec(); ?>
<?php
get_footer();
