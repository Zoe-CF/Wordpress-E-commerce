<?php
/**
 * featured_product section
 *
 * This is the template for the content of featured_product section
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */
if ( ! function_exists( 'shopall_add_featured_product_section' ) ) :
    /**
    * Add featured_product section
    *
    *@since shopall 1.0.0
    */
    function shopall_add_featured_product_section() {
        $options = shopall_get_theme_options();
        // Check if featured_product is enabled on frontpage
        $featured_product_enable = apply_filters( 'shopall_section_status', true, 'featured_product_section_enable' );

        if ( true !== $featured_product_enable ) {
            return false;
        }
        if ( !class_exists('WooCommerce') ) {
            return;
        }
        // Get featured_product section details
        $section_details = array();
        $section_details = apply_filters( 'shopall_filter_featured_product_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render featured_product section now.
        shopall_render_featured_product_section( $section_details );
    }
endif;

if ( ! function_exists( 'shopall_get_featured_product_section_details' ) ) :
    /**
    * featured_product section details.
    *
    * @since shopall 1.0.0
    * @param array $input featured_product section details.
    */
    function shopall_get_featured_product_section_details( $input ) {
        $options = shopall_get_theme_options();


        $featured_product_count = ! empty( $options['featured_product_count'] ) ? $options['featured_product_count'] : 3;
        
        $content = array();
   
        $page_ids = array();

        for ( $i = 1; $i <= $featured_product_count; $i++ ) {
            if ( ! empty( $options['featured_product_content_page_' . $i] ) )
                $page_ids[] = $options['featured_product_content_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => absint( $featured_product_count ),
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
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : '';
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
// featured_product section content details.
add_filter( 'shopall_filter_featured_product_section_details', 'shopall_get_featured_product_section_details' );


if ( ! function_exists( 'shopall_render_featured_product_section' ) ) :
  /**
   * Start featured_product section
   *
   * @return string featured_product content
   * @since shopall 1.0.0
   *
   */
   function shopall_render_featured_product_section( $content_details = array() ) {
        $options = shopall_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
       <div id="featured-products" class="relative page-section same-background">
            <div class="wrapper">
                <div class="section-content clear col-2">
                    <?php $i = 1; foreach ( $content_details as $content ): 
                        
                        $image = $content['image'] == '' ? get_template_directory_uri().'/assets/uploads/no-featured-image-590x650.jpg' : $content['image'] ;
                        $background = shopall_image_brightness($image);
                        $color = $background == '#000' ? '#fff' : '#000' ;
                        $options['featured_product_btn_url_'.$i] = isset($options['featured_product_btn_url_'.$i]) ? $options['featured_product_btn_url_'.$i] : '';
                        $options['featured_product_btn_title_'.$i] = isset($options['featured_product_btn_title_'.$i]) ? $options['featured_product_btn_title_'.$i] : esc_html__('Start Shopping', 'shopall' );
                    ?>
                        <article>
                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $image ) ; ?>');">
                                <div class="entry-container">
                                    <span class="cat-links">
                                        <ul class="post-categories">
                                            <?php foreach ( get_the_category( $content['id'] ) as $category ): ?>
                                                <li>
                                                    <a href="<?php echo esc_url( get_category_link($category->term_id) ) ; ?>" rel="category" style="color:<?php echo $background ?>">
                                                        <?php echo esc_html( $category->name ); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach ?>                                                
                                        </ul>
                                    </span>
                                    
                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="#" style="color:<?php echo $background ?>"><?php echo esc_html( $content['title'] ) ; ?></a>
                                        </h2>
                                    </header>

                                    <div class="entry-content">
                                        <p style="color:<?php echo $background ?>">
                                            <?php echo esc_html( $content['excerpt'] ) ; ?>
                                        </p>
                                    </div><!-- .entry-content -->

                                    <?php if ( !empty( $options['featured_product_btn_url_'.$i] ) && !empty( $options['featured_product_btn_title_'.$i] ) ): ?>
                                        <div class="read-more">
                                            <a href="<?php echo esc_html( $options['featured_product_btn_url_'.$i] ) ; ?>" class="btn" style="color:<?php echo $color ?>; background:<?php echo $background ; ?>; border-color:<?php echo $background ; ?>" onMouseOver="this.style.background='#fa311f';this.style.border='<?php echo $color ; ?>';this.style.color='#fff'" onMouseOut="this.style.background='<?php echo $background ; ?>';this.style.border='<?php echo $background ; ?>';this.style.color='<?php echo $color ; ?>'">
                                                <?php echo esc_html( $options['featured_product_btn_title_'.$i] ) ; ?>
                                            </a>
                                        </div><!-- .read-more -->
                                    <?php endif ?>
                                    
                                </div><!-- .entry-container -->
                            </div><!-- .featured-image -->
                        </article>
                    <?php $i++ ; endforeach ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div>
        
    <?php }
endif;