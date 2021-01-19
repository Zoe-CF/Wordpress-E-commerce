<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */
$class = has_post_thumbnail() ? 'has-post-thumbnail' : '';
$options = shopall_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <div class="post-item-wrapper">
        <div class="featured-image">
            <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink() ; ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title() ; ?>"></a>
            <?php endif; ?>
            <?php if ( $options['hide_category'] == false ): ?>
                <span class="cat-links"><?php the_category(); ?> </span>
            <?php endif; ?> 
        </div><!-- .featured-image -->

        <div class="entry-container">
            <?php if ($options['hide_date'] == false): ?>
                <div class="entry-meta">                
                    <span class="posted-on">
                        <span class="screen-reader-text"><?php esc_html_e( 'Posted on', 'shopall' ) ; ?></span> 
                        <a href="<?php the_permalink() ; ?>" rel="bookmark">
                            <?php 
                                $day = get_the_date( 'j', get_the_id() );
                                $month = get_the_date( 'M', get_the_id() );
                            ?>
                            <time class="entry-date published updated" ><?php echo esc_html($day) ; ?><span><?php echo esc_html($month) ; ?></span></time>
                        </a>
                    </span><!-- .posted-on -->                            
                </div><!-- .entry-meta -->
            <?php endif ?>  
            <header class="entry-header">
               <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>
        </div><!-- .entry-container -->
    </div><!-- .post-item-wrapper -->
</article>