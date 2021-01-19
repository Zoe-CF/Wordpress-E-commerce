<?php
/**
 * Register Custom Controls
 * 
 * @since 1.0.0
*/
function remax_store_controls( $wp_customize ){

    
    //Customizer Settings
    load_template( REMAX_STORE_THEME_DIR . 'themerelic/customizer/custom-controls/toggle/class-toggle-control.php');
    load_template( REMAX_STORE_THEME_DIR . 'themerelic/customizer/custom-controls/sortable/class-sortable-control.php');
    load_template( REMAX_STORE_THEME_DIR . 'themerelic/customizer/custom-controls/multicheck/class-multicheck-control.php');

    //Repeater Section
    load_template( REMAX_STORE_THEME_DIR . 'themerelic/customizer/custom-controls/repeater/class-repeater-setting.php');
    load_template( REMAX_STORE_THEME_DIR . 'themerelic/customizer/custom-controls/repeater/class-control-repeater.php');
    

    //Register the customizer control
    $wp_customize->register_control_type( 'Remax_Store_MultiCheck_Control' );
    $wp_customize->register_control_type( 'Remax_Store_Toggle_Control' );
    $wp_customize->register_control_type( 'Remax_Store_Drag_Section_Control' );

}
add_action( 'customize_register', 'remax_store_controls' );