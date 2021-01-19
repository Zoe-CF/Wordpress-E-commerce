
<div class="section related-post-section">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-3" ><?php echo esc_html__('Related','remax-store'); ?></h2>
        </div>
        
        <?php
        $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 2, 'post__not_in' => array($post->ID) ) );
        if( $related ) foreach( $related as $post ) {
        setup_postdata($post); ?>
         <div class="col-md-6 col-sm-12">
            <article class="post post-tp-5">
                <figure>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </figure>
                <h3 class="title-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="p"><?php echo substr( get_the_excerpt(),0,60 ); ?></p>
            </article>
        </div>
        <?php }
        wp_reset_postdata(); ?>
    </div>  
</div>