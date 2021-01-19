<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */

?>
<!doctype html>
<?php remax_store_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
	<?php remax_store_head_top(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php remax_store_head_bottom(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php remax_store_body_top(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'remax-store' ); ?></a>

	<div id="content" class="site-content">
		<?php remax_store_content_top(); ?>

		<?php remax_store_header_before(); ?>

		<?php remax_store_header(); ?>

		<?php remax_store_header_after(); ?>

		<?php remax_store_content_before(); ?>
		
		<!-- ht-banner -->
		<div class="th-wrapper">
			<div class="<?php if( !( is_front_page()) ) { echo 'breadcum-with-cart-icon'; } ?>">
				<?php if(remax_store_is_woocommerce_activated()): ?>
					<?php if( !(is_woocommerce()) ): ?>
						<?php if( !( is_front_page())  ): remax_store_breadcrumb(); endif; ?> 
					<?php endif; ?>
				<?php else: ?>
					<?php if( !( is_front_page()) ) remax_store_breadcrumb(); ?> 
				<?php endif; ?>
				<?php remax_store_header_cart(); ?>
			</div>
