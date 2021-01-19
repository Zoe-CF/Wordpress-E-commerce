jQuery(document).ready( function(){    

    /**
	 * Remax_Store Homepage Main Slider Section
     * 
	 * @since 1.0.0
     * @description Call the homepage main slider section.
	 */
    jQuery('.th-homepage-main-slider').owlCarousel({
        items : 1,
        itemsCustom : false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true,
            },
            768:{
                items:1,
                nav:false,
            },
            1000:{
                items:1,
                nav:true,
            }
        },
        margin:0,
        dots : true,
        nav: false,
        autoplay : true,
        loop:true,
    });


    /**
	 * Remax_Store Homepage Blog Slider
     * 
	 * @since 1.0.0
     * @description Call the blog slider section.
	 */
    jQuery('.th-homepage-blog-slider').owlCarousel({
        items : 2,
        itemsCustom : false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            768:{
                items:2,
            },
            1000:{
                items:2,
            }
        },
        margin:0,
        dots : true,
        nav: true,
        autoplay : true,
        loop:true,
    });
    

    /**
     * Header Breadcrumb 
     * 
     * @since 1.0.0
     * @description sticky breadcrumb section
     */
    jQuery(window).scroll(function(){
        var scrollTop = jQuery(window).scrollTop();

        /**
         * top to scroll above 80px then add the class and removeclass
         * 
         * @since 1.0.0
         */
        if ( scrollTop > 50) {
            jQuery('.breadcum-with-cart-icon').addClass('th-nav-sticky');
        } else {
            jQuery('.breadcum-with-cart-icon').removeClass('th-nav-sticky');
            
        }
    });


    /**
     * Woocommerce Add To Cart
     * 
     * @since 1.0.0
     */
    jQuery('li.product  a.add_to_cart_button').on('click', function (event) {
        var listElements = jQuery( "li.product" ).css( "color", "blue" );
        var  imgtodrag = jQuery( event.target ).closest( listElements ).find("img").eq(0);
        //update the section
        var cart = jQuery('#site-header-cart');
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
                .appendTo(jQuery('body'))
                .animate({
                'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo');
            
            setTimeout(function () {
                cart.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                jQuery(this).detach()
            });
        }
    });

    /**
     * Match Height Js
     * @since 1.0.0
     */
    jQuery('ul.products li.product div.th-products-wrapper').matchHeight();
    jQuery('div#remax_store_homepage_tabs_section .product-tab li.product').matchHeight();
    jQuery('section#remax_store_homepage_blog_section .th-homepage-blog-slider .item article.default_class').matchHeight();

    
    
    
    /**
	 * Remax_Store Tabs active calss
     * 
	 * @since 1.0.0
     * @description woocommerce products tab section display options
	 */
    jQuery('ul.th-product-categories li').click(function(){
        jQuery('ul.th-product-categories li').removeClass('current');
        jQuery(this).addClass('current');
    });


    /**
	 * Remax_Store Tabs active calss
     * 
	 * @since 1.0.0
     * @description woocommerce products tab section display options
	 */
    jQuery( ".remax-store-sidenav-dropdown" ).before( "<div class='remax-store-submenu-section added'></div>" );
    
    jQuery( "div.remax-store-submenu-section" ).click(function() {
        jQuery( this ).toggleClass( "added" );

        var remax_store_submenu = jQuery(this).hasClass( "added" );
        if( remax_store_submenu == false ){
            jQuery(this).parent().find('.remax-store-sidenav-dropdown').first().show();
        }else{
            jQuery(this).parent().find('.remax-store-sidenav-dropdown').first().hide();
        }
    });



});


/**
 * Hotdeal countdown jquery file
 * 
 * @since 1.0.0
 */
jQuery(document).ready(function($){
     /**
	 * Remax_Store Remax Store Hotoffer section
     * 
	 * @since 1.0.0
     * @description Call the Remax Store Hotoffer section.
	 */
    var ringer = {
            
        element_class : 'canvastime',
        rings: {
                'DAYS': { 
                    s: 86400000, // mseconds in a day,
                    max: 14
                },
                'HOURS': {
                    s: 3600000, // mseconds per hour,
                    max: 24
                },
                'MINS': {
                    s: 60000, // mseconds per minute
                    max: 60
                },
                'SECS': {
                    s: 1000,
                    max: 60
                }
        },
        r_count: 4,
        r_spacing: 13, // px
        r_size: 80, // px
        r_thickness: 5, // px
        update_interval: 100, // ms
        
        
        init: function(countdown_to, elm_class){
        
                $r = ringer;
                $r.countdown_to = countdown_to;
                $r.element_class = elm_class || 'canvastime';

                $r.cvs = document.createElement('canvas'); 
                
                $r.size = { 
                    w: ($r.r_size + $r.r_thickness) * $r.r_count + ($r.r_spacing*($r.r_count-1)), 
                    h: ($r.r_size + $r.r_thickness) 
                };
                

                //added devicePixelRatio for retina screens
                $r.cvs.setAttribute('width',$r.size.w * window.devicePixelRatio);         
                $r.cvs.setAttribute('height',$r.size.h * window.devicePixelRatio);
                
                
                $r.ctx = $r.cvs.getContext('2d');
                
                //*1 multiply for non-retinas
                $r.ctx.scale(window.devicePixelRatio, window.devicePixelRatio);
                
                $('#'+ $r.element_class).html($r.cvs);
                $r.cvs = $($r.cvs);    
                $r.ctx.textAlign = 'center';
                $r.actual_size = $r.r_size + $r.r_thickness;
                $r.countdown_to_time = new Date($r.countdown_to).getTime();
                $r.cvs.css({ width: $r.size.w+"px", height: $r.size.h+"px" });
                $r.go();
                
        },
        ctx: null,
        go: function(){
                var idx=0;
                
                $r.time = (new Date().getTime()) - $r.countdown_to_time;
                
                for(var r_key in $r.rings) $r.unit(idx++,r_key,$r.rings[r_key]);      
                
                setTimeout($r.go,$r.update_interval);
        },
        unit: function(idx,label,ring) {
                var x,y, value, ring_secs = ring.s;
                value = parseFloat($r.time/ring_secs);
                $r.time-=Math.round(parseInt(value)) * ring_secs;
                value = Math.abs(value);
                
                x = ($r.r_size*.5 + $r.r_thickness*.5);
                x +=+(idx*($r.r_size+$r.r_spacing+$r.r_thickness));
                y = $r.r_size*.5;
                y += $r.r_thickness*.5;

                
                // calculate arc end angle
                var degrees = 270-(value / ring.max) * 360.0;
                var endAngle = degrees * (Math.PI / 180);
                
                $r.ctx.save();

                $r.ctx.translate(x,y);
                $r.ctx.clearRect($r.actual_size*-0.5,$r.actual_size*-0.5,$r.actual_size,$r.actual_size);

                // first circle
                $r.ctx.strokeStyle = "#fff";
                $r.ctx.beginPath();
                $r.ctx.arc(0,0,$r.r_size/2,1.5*Math.PI,-0.5*Math.PI, 1);
                $r.ctx.lineWidth =$r.r_thickness;
                $r.ctx.stroke();
                
                // second circle
                $r.ctx.strokeStyle = "#eb6e1a";
                $r.ctx.beginPath();
                $r.ctx.arc(0,0,$r.r_size/2,1.5*Math.PI,endAngle, 1);
                $r.ctx.lineWidth =$r.r_thickness;
                $r.ctx.stroke();
                
                // label
                $r.ctx.fillStyle = "#ffffff";
                
                $r.ctx.font = '200 10px sans-serif';
                $r.ctx.fillText(label, 0, 20);  
                
                $r.ctx.font = '400 18px Poppins';
                $r.ctx.fillStyle = "#ffffff";
                $r.ctx.fillText(Math.floor(value), 0, 5);
                
                $r.ctx.restore();
        }
    }

    // ringer.init('8/24/2018');
    setInterval(function() { 
        var date = jQuery('#hotoffer_countdown_sec').attr('data-time');
            
            ringer.init(date, 'hotoffer_countdown_sec');
             
    }, 1000);

});
