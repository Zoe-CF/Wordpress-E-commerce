<?php
/**
 * Service section
 *
 * This is the template for the content of service section
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */
if ( ! function_exists( 'shopall_add_service_section' ) ) :
    /**
    * Add service section
    *
    *@since shopall 1.0.0
    */
    function shopall_add_service_section() {
    	$options = shopall_get_theme_options();
        // Check if service is enabled on frontpage
        $service_enable = apply_filters( 'shopall_section_status', true, 'service_section_enable' );

        if ( true !== $service_enable ) {
            return false;
        }
        // Get service section details
        $section_details = array();
        $section_details = apply_filters( 'shopall_filter_service_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render service section now.
        shopall_render_service_section( $section_details );
    }
endif;

if ( ! function_exists( 'shopall_get_service_section_details' ) ) :
    /**
    * service section details.
    *
    * @since shopall 1.0.0
    * @param array $input service section details.
    */
    function shopall_get_service_section_details( $input ) {
        $options = shopall_get_theme_options();

        $service_count = ! empty( $options['service_count'] ) ? $options['service_count'] : 3;
        
        $content = array();
        
        $page_ids = array();

        for ( $i = 1; $i <= $service_count; $i++ ) {
            if ( ! empty( $options['service_content_page_' . $i] ) )
                $page_ids[] = $options['service_content_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => absint( $service_count ),
            'orderby'           => 'post__in',
            );                    
            
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = shopall_trim_content( 25 );

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
// service section content details.
add_filter( 'shopall_filter_service_section_details', 'shopall_get_service_section_details' );


if ( ! function_exists( 'shopall_render_service_section' ) ) :
  /**
   * Start service section
   *
   * @return string service content
   * @since shopall 1.0.0
   *
   */
   function shopall_render_service_section( $content_details = array() ) {
        $options = shopall_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="our-services" class="relative page-section same-background">
                <div class="wrapper">
                    <div class="<?php echo esc_attr( $options['service_column_layout'] ) ; ?> clear">
                        <?php $i =1 ; foreach ($content_details as $content): 
                        $icon    = isset($options['service_content_icon_'.$i]) ? $options['service_content_icon_'.$i] : '';
                        ?>
                            <article>
                                <div class="service-item-wrapper">
                                    <?php if ( $icon !== '' ): ?>
                                        <div class="service-icon">
                                            <a href="<?php echo esc_url( $content['url'] ) ; ?>"><i class="fa <?php echo esc_attr( $icon ) ; ?>"></i></a>
                                        </div><!-- .service-icon -->
                                    <?php endif ?>
                                    

                                    <div class="entry-container">
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ) ; ?>"><?php echo esc_html( $content['title'] ) ; ?></a></h2>
                                        </header>

                                        <div class="entry-content">
                                            <p><?php echo esc_html( $content['excerpt'] ) ; ?></p>
                                        </div><!-- .entry-content -->
                                    </div><!-- .entry-container -->
                                </div><!-- .service-item-wrapper -->
                            </article>
                        <?php $i++; endforeach ?>
                       
                    </div><!-- .col-3 -->
                </div><!-- .wrapper -->
            </div><!-- #our-services -->
        
    <?php }
endif;