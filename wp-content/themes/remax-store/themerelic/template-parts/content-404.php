<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */
?>
<section class="error-404 not-found">
    <header class="page-header">
        <h1 class="page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'remax-store' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <p><?php  echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'remax-store' ); ?></p>
    </div><!-- .page-content -->
</section><!-- .error-404 -->