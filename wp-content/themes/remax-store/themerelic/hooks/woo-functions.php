<?php
/**
 * WooCommerce Compatibility Functions
 *
 * @link https://woocommerce.com/
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */



/**
 * Remax Store get the woocommerce category id by slug
 */
function  remax_store_woo_cat_id_by_slug( $slug ){
	/**
	 * Get all Term data from database by Term field and data.
	 * 
	 * @param int $category_id is woocommerce category id
	 * @since 1.0.0
	 * @return object
	 */
	$term = get_term_by('slug', $slug, 'product_cat', 'ARRAY_A');
	return $term['term_id'];//return the woocommerce category id       
}



/** 
 * Function to list post categories in customizer options
 * */
if( ! function_exists( 'remax_store_get_products_categories' ) ) {
	/**
	 * Woocommerce get category
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function remax_store_get_products_categories( ){
		if(!remax_store_is_woocommerce_activated()): return; endif;
		
		/* Option list of all categories */
		$taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );
		
		
		foreach( $all_categories as $category ){
			$categories[$category->term_id] = $category->name;    
		}
		
		return $categories;
	}

}




/**
 * Multiple Category
 */
if( ! function_exists( 'remax_store_get_multiple_product_categories' ) ) {
	/**
	 * Function to list post categories in customizer options
	 * 
	 * @since 1.0.0
	 * @return array
	*/
	function remax_store_get_multiple_product_categories( ){
		if(!remax_store_is_woocommerce_activated()): return; endif;
		//Default cat
        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );


		//Default Select
		$category_count = 0;
        foreach( $all_categories as $cat )  { 
			//Select default category Hear
			
			$default_product_cat = array();
            if( $category_count < 5  ){
                $default_product_cat[$category_count] = $cat->term_id; 
			}

			//empty 
			if(empty($default_product_cat)){
				$default_product_cat[$category_count] = $cat->term_id; 
			}

			//increment count
			$category_count++;
        }

        //Return default cat
        return $default_product_cat;
	}

}



/**
 *  Default woocommerce Default category
 */
if( ! function_exists( 'remax_store_get_default_products_categories' ) ) {
	
	/**
	 * Defaul category section 
	 * 
	 * @since 1.0.0
	 * @return catid
	*/
	function remax_store_get_default_products_categories( ){
		if(!remax_store_is_woocommerce_activated()): return; endif;
		
		//Default cat
        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );


		//Default Select
		$default_product_cat = '';
        foreach( $all_categories as $cat )  { 
            //Select default category Hear
            if( $cat->count >= 4 ){
                $default_product_cat = $cat->term_id; 
            }
        }

        //not category select then
        if( empty($default_product_cat) ){
            foreach( $all_categories as $cat )  { 
                //Select default category Hear
                $default_product_cat = $cat->term_id;
            }
        }


        //Return default cat
        return $default_product_cat;
	}

}


/**
 * get Woocommerce Products Id
 */
if( ! function_exists( 'remax_store_get_woocommerce_products_id' ) ) {
	/**
	 * Function to list post categories in customizer options
	*/
	function remax_store_get_woocommerce_products_id( ){
		
		if(!remax_store_is_woocommerce_activated()): return; endif;
		/**
         * Sinele products id get
         * 
         * @since 1.0.0
         */
        $categories = array();//default array
		$product_args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
		);
		$query = new WP_Query( $product_args );
		if($query->have_posts()) { while( $query->have_posts() ) { $query->the_post();
			$categories[ get_the_ID() ] = get_the_title();  
		}}
		
		return $categories;
	}

}


/**
 * Default products section is hear
 * 
 * 
 * @since 
 * @return default products loop
 */
function remax_store_default_products(){
    ?>
        <div class="defaultproducts item">
            <figure>
                <img src="<?php echo esc_url(REMAX_STORE_THEME_IMG.'default-product.png'); ?>" >
            </figure>
        </div>
    <?php
}