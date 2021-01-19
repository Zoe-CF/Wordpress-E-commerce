<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */


if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

	<aside id="secondary" class="widget-area">
		<?php remax_store_sidebars_before(); ?>

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

		<?php remax_store_sidebars_after(); ?>
	</aside><!-- #secondary -->
