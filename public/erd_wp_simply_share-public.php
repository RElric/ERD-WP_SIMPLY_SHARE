<?php

$plugin_dir_path = ABSPATH . 'wp-content/plugins/ERD_WP_SIMPLY_SHARE';

/**** Configuration pour l'affichage publique ****/
function erd_simply_share_display($atts, $content) {
  $atts = shortcode_atts(array('display' => 'horizontal'), $atts);
  $class = "erd_ss_horizontal";
  $display = null;

  if($atts['display'] == 'vertical') :
    $class = "erd_ss_vertical";
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

if(!wp_style_is('fontawesome')) {
  wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css', array(), null, 'screen, projection');
}

wp_enqueue_style('ERD_Simply_Share-style', '/wp-content/plugins/ERD_WP_SIMPLY_SHARE/public/assets/css/screen.css', array('fontawesome'), null, 'screen, projection');
