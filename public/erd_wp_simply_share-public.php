<?php

$plugin_dir_path = ABSPATH . 'wp-content/plugins/ERD_WP_SIMPLY_SHARE';

/**** Configuration pour l'affichage publique ****/
function erd_simply_share_display($atts, $content) {
    $atts = shortcode_atts(array('display' => 'horizontal', 'size' => 'medium'), $atts);
    $class = "erd_ss_horizontal";
    $display = null;

    if($atts['display'] == 'vertical') :
        if($atts['size'] == 'tiny') :
            $class = "erd_ss_vertical erd_ss_tiny";
        endif;
        if($atts['size'] == 'small') :
            $class = "erd_ss_vertical erd_ss_small";
        endif;
        if($atts['size'] == 'medium') :
            $class = "erd_ss_vertical erd_ss_medium";
        endif;
        if($atts['size'] == 'big') :
            $class = "erd_ss_vertical erd_ss_big";
        endif;
        if($atts['size'] == 'huge') :
            $class = "erd_ss_vertical erd_ss_huge";
        endif;
    endif;

    if($atts['display'] == 'horizontal') :
        if($atts['size'] == 'tiny') :
            $class = "erd_ss_horizontal erd_ss_tiny";
        endif;
        if($atts['size'] == 'small') :
            $class = "erd_ss_horizontal erd_ss_small";
        endif;
        if($atts['size'] == 'medium') :
            $class = "erd_ss_horizontal erd_ss_medium";
        endif;
        if($atts['size'] == 'big') :
            $class = "erd_ss_horizontal erd_ss_big";
        endif;
        if($atts['size'] == 'huge') :
            $class = "erd_ss_horizontal erd_ss_huge";
        endif;
    endif;

    $display = "<div class='erd_simply_share ".$class."'>";

    if($content != null) :
        $display .= '<p class="title">'.$content.'</p>';
    endif;

    $display .= '<ul class="erd_ss_social_links">';

    if(get_option('erd_wp_simply_share_twitter') == 1) :
        $display .= '<li><a href="http://www.twitter.com/home/?status='.get_the_title().' - '.get_the_permalink().'" rel="external no_follow" target="_blank" class="twitter_btn"><span class="fa fa-2x fa-twitter"></span></a></li>';
    endif;

    if(get_option('erd_wp_simply_share_facebook') == 1) :
        $display .= '<li><a href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" rel="external no_follow" target="_blank" class="facebook_btn"><span class="fa fa-2x fa-facebook"></span></a></li>';
    endif;

    if(get_option('erd_wp_simply_share_linkedin') == 1) :
        $display .= '<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;title='.get_the_title().'&amp;url='.get_the_permalink().'" rel="external no_follow" target="_blank" class="linkedin_btn"><span class="fa fa-2x fa-linkedin"></span></a></li>';
    endif;

    $display .= '</ul></div>';

    return $display;
}
add_shortcode('simply_share', 'erd_simply_share_display');

function erd_ss_hooking_styles() {
    if(!wp_style_is('fontawesome')) {
        wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css', array(), null, 'screen, projection');
    }

    wp_enqueue_style('ERD_Simply_Share-style', '/wp-content/plugins/ERD_WP_SIMPLY_SHARE/public/assets/css/screen.css', array('fontawesome'), null, 'screen, projection');
}
add_action('wp_enqueue_style', 'erd_ss_hooking_styles');
