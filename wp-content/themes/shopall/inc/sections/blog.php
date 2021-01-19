<?php
/**
 * Blog section
 *
 * This is the template for the content of blog section
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */
if ( ! function_exists( 'shopall_add_blog_section' ) ) :
    /**
    * Add blog section
    *
    *@since shopall 1.0.0
    */
    function shopall_add_blog_section() {
    	$options = shopall_get_theme_options();
        // Check if blog is enabled on frontpage
        $blog_enable = apply_filters( 'shopall_section_status', true, 'blog_section_enable' );

        if ( true !== $blog_enable ) {
            return false;
        }
        // Get blog section details
        $section_details = array();
        $section_details = apply_filters( 'shopall_filter_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render blog section now.
        shopall_render_blog_section( $section_details );
    }
endif;

if ( ! function_exists( 'shopall_get_blog_section_details' ) ) :
    /**
    * blog section details.
    *
    * @since shopall 1.0.0
    * @param array $input blog section details.
    */
    function shopall_get_blog_section_details( $input ) {
        $options = shopall_get_theme_options();

        $blog_count = ! empty( $options['blog_count'] ) ? $options['blog_count'] : 3;
        $content = array();
        $blog_content_type  = $options['blog_content_type'];
        switch ( $blog_content_type ) {
            
            case 'post':
                $post_ids = array();

                for ( $i = 1; $i <= $blog_count; $i++ ) {
                    if ( ! empty( $options['blog_content_post_' . $i] ) )
                        $post_ids[] = $options['blog_content_post_' . $i];
                }
                
                $args = array(
                    'post_type'         => 'post',
                    'post__in'          => ( array ) $post_ids,
                    'posts_per_page'    => absint( $blog_count ),
                    'orderby'           => 'post__in',
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            case 'recent':
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => absint( $blog_count ),
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            default:
            break;
        }
    
          
        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = shopall_trim_content( 20 );
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : '';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

    
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// blog section content details.
add_filter( 'shopall_filter_blog_section_details', 'shopall_get_blog_section_details' );


if ( ! function_exists( 'shopall_render_blog_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog content
   * @since shopall 1.0.0
   *
   */
   function shopall_render_blog_section( $content_details = array() ) {
        $options = shopall_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="latest-posts" class="relative page-section">
            <div class="wrapper">
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html( $options['blog_title'] ) ; ?></h2>
                </div><!-- .section-header -->

                <div class="archive-blog-wrapper col-3 clear">
                    <?php foreach ( $content_details as $content ) { 
                         $image = $content['image'] == '' ? get_template_directory_uri().'/assets/uploads/no-featured-image-590x650.jpg' : $content['image'] ;
                    ?>
                         <article class="has-post-thumbnail">
                            <div class="post-item-wrapper">
                                <div class="featured-image">
                                    <a href="<?php echo esc_url( $content['url'] ) ; ?>"><img src="<?php echo esc_url(  $image ); ?>"></a>
                                    <span class="cat-links">
                                        <?php the_category( '', '', $content['id'] ) ; ?>
                                    </span><!-- .cat-links -->
                                </div><!-- .featured-image -->

                                <div class="entry-container">
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <span class="screen-reader-text"><?php esc_html_e( 'Posted on', 'shopall' ) ; ?></span> 
                                            <a href="<?php echo esc_url( $content['url'] ) ; ?>" rel="bookmark">
                                                <?php 
                                                    $day = get_the_date( 'j', $content['id'] );
                                                    $month = get_the_date( 'M', $content['id'] );
                                                ?>
                                                <time class="entry-date published updated" ><?php echo esc_html($day) ; ?><span><?php echo esc_html($month) ; ?></span></time>
                                            </a>
                                        </span><!-- .posted-on -->
                                    </div>

                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="<?php echo esc_url( $content['url'] ) ; ?>">
                                                <?php echo esc_html( $content['title'] ) ; ?>
                                                    
                                            </a>
                                        </h2>
                                    </header>
                                </div><!-- .entry-container -->
                            </div><!-- .post-item-wrapper -->
                        </article>
                   <?php } ?>
                </div><!-- .archive-blog-wrapper -->
            </div><!-- .wrapper -->
        </div>
    <?php }
endif;