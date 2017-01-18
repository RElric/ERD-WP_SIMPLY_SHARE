<?php

/**** Paramètres d'affichage du menu d'administration ****/
/*** HOOKS style & script ***/
function erd_ss_admin_style() {
    if(!wp_style_is('fontawesome')) {
        wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css', array(), null, 'screen, projection');
    }

    wp_enqueue_style('ERD_Simply_Share-style', plugins_url('ERD_WP_SIMPLY_SHARE/admin/assets/css/screen.css'), array('fontawesome'), null, 'screen, projection');
}
add_action( 'admin_enqueue_scripts', 'erd_ss_admin_style' )

function erd_ss_admin_scripts() {
        wp_register_script( 'ERD_SS_JQUERY_UI', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js');
        wp_enqueue_script( 'ERD_SS_JQUERY_UI' );
        wp_register_script( 'ERD_SS_MAIN', plugins_url('ERD_WP_SIMPLY_SHARE/admin/assets/js/main.js'));
        wp_enqueue_script( 'ERD_SS_MAIN' );
}
add_action( 'admin_enqueue_scripts', 'erd_ss_admin_scripts' );
