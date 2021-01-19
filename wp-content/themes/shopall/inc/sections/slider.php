<?php
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */
if ( ! function_exists( 'shopall_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since shopall 1.0.0
    */
    function shopall_add_slider_section() {
    	$options = shopall_get_theme_options();
        // Check if slider is enabled on frontpage
        $slider_enable = apply_filters( 'shopall_section_status', true, 'slider_section_enable' );

        if ( true !== $slider_enable ) {
            return false;
        }
        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'shopall_filter_slider_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render slider section now.
        shopall_render_slider_section( $section_details );
    }
endif;

if ( ! function_exists( 'shopall_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since shopall 1.0.0
    * @param array $input slider section details.
    */
    function shopall_get_slider_section_details( $input ) {
        $options = shopall_get_theme_options();

        $slider_count = ! empty( $options['slider_count'] ) ? $options['slider_count'] : 3;
        
        $content = array();
        	
        $page_ids = array();

        for ( $i = 1; $i <= $slider_count; $i++ ) {
            if ( ! empty( $options['slider_content_page_' . $i] ) )
                $page_ids[] = $options['slider_content_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => absint( $slider_count ),
            'orderby'           => 'post__in',
            );                    


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = shopall_trim_content( 30 );
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : '';

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
// slider section content details.
add_filter( 'shopall_filter_slider_section_details', 'shopall_get_slider_section_details' );


if ( ! function_exists( 'shopall_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since shopall 1.0.0
   *
   */
   function shopall_render_slider_section( $content_details = array() ) {
        $options = shopall_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="featured-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": true, "arrows": true, "autoplay": <?php echo esc_attr( $options['slider_autoplay'] ); ?>, "draggable": true, "fade": false }'>    
            <?php $i = 1 ; foreach ($content_details as $content): 
                $image = $content['image'] == '' ? get_template_directory_uri().'/assets/uploads/no-featured-image-590x650.jpg' : $content['image'] ;
            ?>
                <article style="background-image:url('<?php echo esc_url( $image ); ?>');">
                    <div class="overlay" style="opacity: 0;"></div>
                    <div class="wrapper">
                        <div class="featured-content-wrapper">
                            <header class="entry-header">
                                <p class="subtitle" > <?php echo esc_html( $options['slider_sub_title'] ) ; ?></p>
                                <h2 class="entry-title"><a href="<?php echo esc_url($content['url']); ?>" ><?php echo esc_html( $content['title'] ); ?></a></h2>
                            </header>

                            <div class="entry-content">
                                <p ><?php echo wp_kses_post( $options['slider_offer_label'] ); ?></p>
                            </div><!-- .entry-content-->

                            <div class="read-more">
                                <a href="<?php echo esc_url($content['url']); ?>" class="btn" > <?php echo esc_html( $options['slider_btn_label'] ) ?></a>
                            </div><!-- .read-more -->
                        </div><!-- .featured-content-wrapper -->
                    </div><!-- .wrapper -->
                </article>
            <?php $i++; endforeach ; ?>
        </div><!-- #featured-slider -->
                       
    <?php }
endif;