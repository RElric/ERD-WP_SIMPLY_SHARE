<?php

require_once(WP_PLUGIN_DIR.'/ERD_WP_SIMPLY_SHARE/erd_wp_simply_share-class_bdd_controler.php');
require_once(WP_PLUGIN_DIR.'/ERD_WP_SIMPLY_SHARE/erd_wp_simply_share-class_social_network.php');
require_once(plugin_dir_path(__FILE__).'erd_wp_simply_share-public-class_view.php');

/**** Configuration pour l'affichage publique ****/
function erd_simply_share_display($atts, $content) {
    $atts = shortcode_atts(array('display' => 'horizontal', 'size' => 'medium'), $atts);
    $erd_ss_public_view = new ERD_SS_PUBLIC_VIEW($atts, $content);

    return $erd_ss_public_view->retrieve_html();
}
add_shortcode('simply_share', 'erd_simply_share_display');

function erd_ss_hooking_styles() {
    if(!wp_style_is('fontawesome')) {
        wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css', array(), null, 'screen, projection');
    }

    wp_enqueue_style('ERD_Simply_Share-style', plugins_url('ERD_WP_SIMPLY_SHARE/public/assets/css/screen.css'), array('fontawesome'), null, 'screen, projection');
}
add_action('wp_enqueue_scripts', 'erd_ss_hooking_styles');
