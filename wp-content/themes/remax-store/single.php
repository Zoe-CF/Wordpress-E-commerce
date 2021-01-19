<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
				<?php remax_store_content_top(); ?>

				<?php remax_store_content_loop(); ?>

				<?php remax_store_content_bottom(); ?>

				<?php
					/**
					 * Related Post Section
					 */
					get_template_part( 'themerelic/template-parts/single-related' );
				?>
			</div><!-- #primary -->

			<?php  if ( remax_store_page_layout() == 'remax-store-right-sidebar' ) : ?>

			<?php get_sidebar(); ?>

			<?php endif ?>
	<?php remax_store_after_mainsec(); ?>
<?php
get_footer();
