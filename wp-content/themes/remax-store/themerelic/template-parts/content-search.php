<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */

?>
<?php remax_store_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php remax_store_entry_top(); ?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				remax_store_posted_on();
				remax_store_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php remax_store_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php remax_store_entry_content_before(); ?>
		<?php the_excerpt(); ?>
		<?php remax_store_entry_content_after(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php remax_store_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php remax_store_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php remax_store_entry_after(); ?>