<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Shopall Pro
 * @since Shopall Pro 1.0.0
 */

if ( ! function_exists( 'shopall_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since Shopall Pro 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function shopall_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'shopall_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'shopall_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since Shopall Pro 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function shopall_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'shopall_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'shopall_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Shopall Pro 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function shopall_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'shopall_theme_options[pagination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'shopall_is_static_homepage_enable' ) ) :
	/**
	 * Check if static homepage is enabled.
	 *
	 * @since Shopall Pro 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function shopall_is_static_homepage_enable( $control ) {
		return ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() );
	}
endif;

/**
 * Front Page Active Callbacks
 */

/**
 * Check if topbar section is enabled.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_topbar_section_enable( $control ) {
	return ( $control->manager->get_setting( 'shopall_theme_options[topbar_section_enable]' )->value() );
}

/**
 * Check if slider section is enabled.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_slider_section_enable( $control ) {
	return ( $control->manager->get_setting( 'shopall_theme_options[slider_section_enable]' )->value() );
}


/**
 * Check if service section is enabled.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_service_section_enable( $control ) {
	return ( $control->manager->get_setting( 'shopall_theme_options[service_section_enable]' )->value() );
}


/**
 * Check if recent_product section is enabled.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_recent_product_section_enable( $control ) {
	return ( $control->manager->get_setting( 'shopall_theme_options[recent_product_section_enable]' )->value() );
}

function shopall_is_recent_product_section_content_product_enable( $control ) {
	$content_type = $control->manager->get_setting( 'shopall_theme_options[recent_product_content_type]' )->value();
	return shopall_is_recent_product_section_enable( $control ) && ( 'product' == $content_type );
}

function shopall_is_recent_product_section_content_product_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'shopall_theme_options[recent_product_content_type]' )->value();
	return shopall_is_recent_product_section_enable( $control ) && ( 'product_cat' == $content_type );
}

/**
 * Check if featured_product section is enabled.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_featured_product_section_enable( $control ) {
	return ( $control->manager->get_setting( 'shopall_theme_options[featured_product_section_enable]' )->value() );
}

/**
 * Check if featured_product section content type is category.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_featured_product_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'shopall_theme_options[featured_product_content_type]' )->value();
	return shopall_is_featured_product_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if featured_product section content type is page.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_featured_product_section_content_page_enable( $control ) {
	$content_type = $control->manager->get_setting( 'shopall_theme_options[featured_product_content_type]' )->value();
	return shopall_is_featured_product_section_enable( $control ) && ( 'page' == $content_type );
}

/**
 * Check if featured_product section content type is post.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_featured_product_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'shopall_theme_options[featured_product_content_type]' )->value();
	return shopall_is_featured_product_section_enable( $control ) && ( 'post' == $content_type );
}



/**
 * Check if blog section is enabled.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_blog_section_enable( $control ) {
	return ( $control->manager->get_setting( 'shopall_theme_options[blog_section_enable]' )->value() );
}

/**
 * Check if blog section content type is post.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_blog_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'shopall_theme_options[blog_content_type]' )->value();
	return shopall_is_blog_section_enable( $control ) && ( 'post' == $content_type );
}


/**
 * Check if blog section content type is recent.
 *
 * @since Shopall Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function shopall_is_blog_section_content_recent_enable( $control ) {
	$content_type = $control->manager->get_setting( 'shopall_theme_options[blog_content_type]' )->value();
	return shopall_is_blog_section_enable( $control ) && ( 'recent' == $content_type );
}



