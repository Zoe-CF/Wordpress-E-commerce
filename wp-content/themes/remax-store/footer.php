<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
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
		<?php remax_store_content_bottom(); ?>

		<?php remax_store_content_after(); ?>

		<?php remax_store_footer_before(); ?>

		<?php remax_store_footer(); ?>

		<?php remax_store_footer_after(); ?>
		</div><!-- #content -->
	</div><!-- #page -->
	<?php remax_store_body_bottom(); ?>

<?php wp_footer(); ?>

</body>
</html>