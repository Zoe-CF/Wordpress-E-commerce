<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */
$options = shopall_get_theme_options();
get_header(); 
?>

<div id="inner-content-wrapper" class="wrapper page-section">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="blog-posts-wrapper archive-blog-wrapper <?php echo  ( $options['sidebar_position'] == 'no-sidebar' )  ? 'col-3' : 'col-2' ; ?> clear">
				<?php
				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div>
			<?php  
			/**
			* Hook - shopall_action_pagination.
			*
			* @hooked shopall_pagination 
			*/
			do_action( 'shopall_action_pagination' ); 

			/**
			* Hook - shopall_infinite_loader_spinner_action.
			*
			* @hooked shopall_infinite_loader_spinner 
			*/
			do_action( 'shopall_infinite_loader_spinner_action' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php  
	if ( shopall_is_sidebar_enable() ) {
		get_sidebar();
	}
	?>
</div><!-- .wrapper -->

<?php
get_footer();
