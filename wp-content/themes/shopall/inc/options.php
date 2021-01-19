<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */

function shopall_product_choices() {
    $query = new WC_Product_Query( array(
        'return' => 'ids',
        ) );
    $products = $query->get_products();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'shopall' );
    foreach ( $products as $page ) {
        $choices[ $page ] = $page;
    }
    return  $choices;
}

function shopall_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'shopall' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function shopall_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'shopall' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    wp_reset_postdata();    
    return  $choices;
}




if ( ! function_exists( 'shopall_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function shopall_selected_sidebar() {
        $shopall_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'shopall' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'shopall' ),
            'optional-sidebar-2'    => esc_html__( 'Optional Sidebar 2', 'shopall' ),
            'optional-sidebar-3'    => esc_html__( 'Optional Sidebar 3', 'shopall' ),
            'optional-sidebar-4'    => esc_html__( 'Optional Sidebar 4', 'shopall' ),
        );

        $output = apply_filters( 'shopall_selected_sidebar', $shopall_selected_sidebar );

        return $output;
    }
endif;

if ( ! function_exists( 'shopall_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function shopall_site_layout() {
        $shopall_site_layout = array(
            'wide-layout'  => esc_url( get_template_directory_uri() . '/assets/images/full.png'),
            'boxed-layout' => esc_url( get_template_directory_uri() . '/assets/images/boxed.png'),
        );

        $output = apply_filters( 'shopall_site_layout', $shopall_site_layout );
        return $output;
    }
endif;


if ( ! function_exists( 'shopall_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function shopall_global_sidebar_position() {
        $shopall_global_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() . '/assets/images/right.png'),
            'no-sidebar'    => esc_url( get_template_directory_uri() . '/assets/images/full.png'),
        );

        $output = apply_filters( 'shopall_global_sidebar_position', $shopall_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'shopall_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function shopall_sidebar_position() {
        $shopall_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() . '/assets/images/right.png'),
            'no-sidebar'    => esc_url( get_template_directory_uri() . '/assets/images/full.png'),
        );

        $output = apply_filters( 'shopall_sidebar_position', $shopall_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'shopall_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function shopall_pagination_options() {
        $shopall_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'shopall' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'shopall' ),
        );

        $output = apply_filters( 'shopall_pagination_options', $shopall_pagination_options );

        return $output;
    }
endif;


if ( ! function_exists( 'shopall_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function shopall_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'shopall' ),
            'off'       => esc_html__( 'Disable', 'shopall' )
        );
        return apply_filters( 'shopall_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'shopall_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function shopall_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'shopall' ),
            'off'       => esc_html__( 'No', 'shopall' )
        );
        return apply_filters( 'shopall_hide_options', $arr );
    }
endif;




if ( ! function_exists( 'shopall_testimonial_content_type' ) ) :
    /**
     * Destination Options
     * @return array site gallery options
     */
    function shopall_testimonial_content_type() {
        $shopall_testimonial_content_type = array(
            'page'      => esc_html__( 'Page', 'shopall' ),
            'post'      => esc_html__( 'Post', 'shopall' ),
            'custom'  => esc_html__( 'Custom', 'shopall' ),
        );

        $output = apply_filters( 'shopall_testimonial_content_type', $shopall_testimonial_content_type );


        return $output;
    }
endif;

if ( ! function_exists( 'shopall_latest_product' ) ) :
    /**
     * List of latest product
     * @return array List of latest product.
     */
    function shopall_latest_product() {
        $arr = array(
            'page'          => esc_html__( 'Page', 'shopall' ),
            'post'          => esc_html__( 'Post', 'shopall' ),
            'category'      => esc_html__( 'Post Category', 'shopall' ),
        );
        if ( class_exists( 'WooCommerce' ) ) {
            $arr = array_merge( $arr, 
                array( 
                    'product'           => esc_html__( 'Product', 'shopall' ), 
                    'product-category'  => esc_html__( 'Product Category', 'shopall' ), 
                    'latest-product'    => esc_html__( 'Latest Products', 'shopall' ), 
                    ) 
                );
        }

        return apply_filters( 'shopall_latest_options', $arr );
    }
endif;

if ( ! function_exists( 'shopall_recent_product_options' ) ) :
    /**
     * List of recent_product options
     * @return array List of recent_product options.
     */
    function shopall_recent_product_options() {
    
        if ( class_exists( 'WooCommerce' ) ) {
                $arr = array(
                'product'           => esc_html__( 'Product', 'shopall' ),
                'product_cat'       => esc_html__( 'Product Category', 'shopall' ),
                'recent_product'    => esc_html__( 'Recent Product', 'shopall' ),
            );
        }

        return apply_filters( 'shopall_recent_product_options', $arr );
    }
endif;