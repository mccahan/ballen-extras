<?php
/*
 * Plugin Name: Ballen Extras
 * Description: This plugin provides some extra functionality for Ballen sites
 * Author: Ryan McCahan
 * GitHub Plugin URI: https://github.com/mccahan/ballen-extras
 * Version: 1.0.4
 */

// Callback function to insert 'styleselect' into the $buttons array
function ballen_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'ballen_mce_buttons_2');

// Callback function to filter the MCE settings
function ballen_mce_before_init_insert_formats( $init_array ) {
    // Define the style_formats array
    $style_formats = array(
        // Each array child is a format with its own settings
        array(
            'title' => 'Button Link',
            'selector' => 'a',
            'classes' => 'button'
        )
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
add_filter( 'tiny_mce_before_init', 'ballen_mce_before_init_insert_formats' );

// Add custom CSS
function ballenExtrasCSS() {
    wp_enqueue_style('ballen-extras', plugins_url('extras.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'ballenExtrasCSS');