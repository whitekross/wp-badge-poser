<?php
/*
 * Plugin Name: Wp-badge-poser
 * Version: 0.1-alpha
 * Description: PugX Badge Poser For Wordpress
 * Author: Alessandro Fiore
 * Author URI: https://github.com/whitekross
 * Plugin URI: https://github.com/whitekross/wp-badge-poser
 * Text Domain: wp-badge-poser
 * Domain Path: /languages
 */

if ( ! defined( 'WPINC' ) ) {
    die('WPINC is not defined');
}

add_shortcode( 'badge-poser', 'badge_poser_shortcode' );
function badge_poser_shortcode( $atts ) {

    $atts = shortcode_atts(
        array(
            'package' => '',
            'version' => 'stable',
            'download' => false
        ), $atts, 
           'badge-poser');

    // do nothing if package is emtpy
    if(empty($atts['package'])) {
        return false;
    }
    
    if($atts['download'] === false) {
        $img = "<img src='https://poser.pugx.org/{$atts['package']}/v/{$atts['version']}' alt='Latest {$atts['version']} version of {$atts['package']}' />";
    } else {
        $img = "<img src='https://poser.pugx.org/{$atts['package']}/d/{$atts['download']}' alt='{$atts['download']} downloads for {$atts['package']}' />";
    }

    return "<a href='https://packagist.org/packages/{$atts['package']}'>$img</a>";

}
