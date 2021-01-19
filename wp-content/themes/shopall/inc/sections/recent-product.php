<?php
/**
 * recent_product section
 *
 * This is the template for the content of recent_product section
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */
if ( ! function_exists( 'shopall_add_recent_product_section' ) ) :
    /**
    * Add recent_product section
    *
    *@since shopall 1.0.0
    */
    function shopall_add_recent_product_section() {
    	$options = shopall_get_theme_options();
        // Check if recent_product is enabled on frontpage
        $recent_product_enable = apply_filters( 'shopall_section_status', true, 'recent_product_section_enable' );

        if ( true !== $recent_product_enable ) {
            return false;
        }
        // Get recent_product section details
        $section_details = array();
        $section_details = apply_filters( 'shopall_filter_recent_product_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        if ( !class_exists('WooCommerce') ) {
            return;
        }
        // Render recent_product section now.
        shopall_render_recent_product_section( $section_details );
    }
endif;

if ( ! function_exists( 'shopall_get_recent_product_section_details' ) ) :
    /**
    * recent_product section details.
    *
    * @since shopall 1.0.0
    * @param array $input recent_product section details.
    */
    function shopall_get_recent_product_section_details( $input ) {
        $options = shopall_get_theme_options();
    
        $recent_product_count = ! empty( $options['recent_product_count'] ) ? $options['recent_product_count'] : 3;
  
        
        $content = array();
    

     
        $page_ids = array();

        for ( $i = 1; $i <= $recent_product_count; $i++ ) {
            if ( ! empty( $options['recent_product_content_page_' . $i] ) )
                $page_ids[] = $options['recent_product_content_page_' . $i];
        }

        $args = array(
            'post_type'         => 'product',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => count( $page_ids ),
            'orderby'           => 'post__in',
            );
        
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
// recent_product section content details.
add_filter( 'shopall_filter_recent_product_section_details', 'shopall_get_recent_product_section_details' );


if ( ! function_exists( 'shopall_render_recent_product_section' ) ) :
  /**
   * Start recent_product section
   *
   * @return string recent_product content
   * @since shopall 1.0.0
   *
   */
   function shopall_render_recent_product_section( $content_details = array() ) {
        $options = shopall_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
       <div id="recent-products" class="relative page-section same-background">
            <div class="wrapper">
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html( $options['recent_product_title'] ) ; ?></h2>
                </div><!-- .section-header -->

                <div class="section-content">
                    <ul class="products col-4">
                        <?php foreach ( $content_details as $content ): 
                            $image = $content['image'] == '' ? get_template_directory_uri().'/assets/uploads/no-featured-image-590x650.jpg' : $content['image'] ;
                        ?>
                            <li class="product featured-products">
                                <a href="<?php echo esc_url( $content['url'] ) ; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                    <?php 
                                        $product = new WC_Product( $content['id'] );
                                        if ( $product->get_sale_price() ): 
                                    ?>
                                            <span class="onsale">
                                                <?php esc_html_e('Sale!', 'shopall'); ?>
                                            </span>
                                    <?php endif ?>
                                    <img width="330" height="400" src="<?php echo esc_url($image); ?>">
                                    </a>
                                    <div class="product_meta">
                                        <?php 
                                            $terms = get_the_terms ( $content['id'], 'product_cat' );
                                            foreach ( $terms as $term ) { ?>
                                                <span class="posted_in">
                                                    <a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ) ?>"><?php echo esc_html( $term->name) ; ?></a>
                                                </span><!-- .posted_in -->
                                               
                                            <?php }
                                        ?>
                                    </div><!-- .product-meta -->
                                    <h2 class="woocommerce-loop-product__title"><?php echo esc_html( $content['title'] ) ?></h2>
                                    <span class="price">
                                         <?php 
                                            $product = new WC_Product( $content['id'] );
                                            echo $product->get_price_html();
                                        ?>
                                    </span>
                                
                                <a href="<?php echo do_shortcode( '[add_to_cart_url id="' . absint( $content['id'] ) . '"]' ); ?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart"> 
                                    <?php esc_html_e('Add to cart', 'shopall') ?>
                                        
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul><!-- .product-slider -->
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div>
    <?php }
endif;