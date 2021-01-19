<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

/**
 * shopall_footer_primary_content hook
 *
 * @hooked shopall_add_contact_section -  10
 *
 */
do_action( 'shopall_footer_primary_content' );

/**
 * shopall_content_end_action hook
 *
 * @hooked shopall_content_end -  10
 *
 */
do_action( 'shopall_content_end_action' );

/**
 * shopall_content_end_action hook
 *
 * @hooked shopall_footer_start -  10
 * @hooked shopall_Footer_Widgets->add_footer_widgets -  20
 * @hooked shopall_footer_site_info -  40
 * @hooked shopall_footer_end -  100
 *
 */
do_action( 'shopall_footer' );

/**
 * shopall_page_end_action hook
 *
 * @hooked shopall_page_end -  10
 *
 */
do_action( 'shopall_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
