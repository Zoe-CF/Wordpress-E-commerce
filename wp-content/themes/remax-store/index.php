<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */


get_header(); ?>
<?php remax_store_before_mainsec(); ?>

<?php if ( remax_store_page_layout() == 'remax-store-left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" class="content-area" >

		<?php remax_store_content_top(); ?>

		<?php remax_store_content_loop(); ?>

		<?php remax_store_pagination(); ?>

		<?php remax_store_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( remax_store_page_layout() == 'remax-store-right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>
<?php remax_store_after_mainsec(); ?>

<?php get_footer(); ?>
