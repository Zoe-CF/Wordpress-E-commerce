<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage shopall
	 * @since shopall 1.0.0
	 */

	/**
	 * shopall_doctype hook
	 *
	 * @hooked shopall_doctype -  10
	 *
	 */
	do_action( 'shopall_doctype' );

?>
<head>
<?php
	/**
	 * shopall_before_wp_head hook
	 *
	 * @hooked shopall_head -  10
	 *
	 */
	do_action( 'shopall_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php
	/**
	 * shopall_page_start_action hook
	 *
	 * @hooked shopall_page_start -  10
	 *
	 */
	do_action( 'shopall_page_start_action' ); 

	/**
	 * shopall_loader_action hook
	 *
	 * @hooked shopall_loader -  10
	 *
	 */
	do_action( 'shopall_before_header' );

	/**
	 * shopall_header_action hook
	 *
	 * @hooked shopall_header_start -  10
	 * @hooked shopall_site_branding -  20
	 * @hooked shopall_site_navigation -  30
	 * @hooked shopall_header_end -  50
	 *
	 */
	do_action( 'shopall_header_action' );

	/**
	 * shopall_content_start_action hook
	 *
	 * @hooked shopall_content_start -  10
	 *
	 */
	do_action( 'shopall_content_start_action' );

	/**
	 * shopall_header_image_action hook
	 *
	 * @hooked shopall_header_image -  10
	 *
	 */
	do_action( 'shopall_header_image_action' );

    if ( shopall_is_frontpage() ) {
    	$options = shopall_get_theme_options();
    	$sorted = array();
    	if ( ! empty( $options['sortable'] ) ) {
			$sorted = explode( ',' , $options['sortable'] );
		}

		foreach ( $sorted as $section ) {
			add_action( 'shopall_primary_content', 'shopall_add_'. $section .'_section' );
		}
		do_action( 'shopall_primary_content' );
	}