<?php
/**
 * Template part for displaying posts
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
	<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope"  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php remax_store_entry_top(); ?>

			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<?php
						remax_store_posted_on();
						remax_store_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<?php remax_store_post_thumbnail(); ?>

			<div class="entry-content">
				<?php remax_store_entry_content_before(); ?>

				<?php
				if ( is_singular() ) :
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'remax-store' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );
				//the excerpt file
				else:
					the_excerpt();
				endif;
				?>
				<?php remax_store_entry_content_after(); ?>

				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'remax-store' ),
					'after'  => '</div>',
				) );
				?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php remax_store_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		
		<?php remax_store_entry_bottom(); ?>
	</article><!-- #post-<?php the_ID(); ?> -->
<?php remax_store_entry_after(); ?>