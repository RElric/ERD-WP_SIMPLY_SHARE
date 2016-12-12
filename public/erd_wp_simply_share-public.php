<?php

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
    $display .= '<li><a href="http://www.twitter.com/home/?status='.get_the_title().' - '.get_the_permalink().'"><span class="fa fa-twitter"></span></a></li>';
  endif;

  if(get_option('erd_wp_simply_share_facebook') == 1) :
    $display .= '<li><a href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'"><span class="fa fa-twitter"></span></a></li>';
  endif;

  if(get_option('erd_wp_simply_share_linkedin') == 1) :
    $display .= '<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;title='.get_the_title().'&amp;url='.get_the_permalink().'"><span class="fa fa-twitter"></span></a></li>';
  endif;

  $display .= '</ul></div>';

  return $display;
}
add_shortcode('simply_share', 'erd_simply_share_display');


