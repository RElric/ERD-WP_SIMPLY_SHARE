<?php

/*
  Plugin Name: ERD Simply Share
  Plugin URI: https://github.com/RElric/ERD-WP_SIMPLY_SHARE
  Description: A WP plugin to simply share on social networks made by ERDigital - Free to use and modify with mention of the author include commercial use
  Version: 1.0.0
  Author: ERDigital
 */

/**** Partie administration (Back Office) ****/

//Ajout du menu dans les réglages
function erd-wp_simply_share_menu_item() {
  add_submenu_page("options-general.php", "ERD Simply Share", "ERD Simply Share", "manage_options", "erd-wp_simply_share", "erd-wp_simply_share-admin_page");
}

//Ajout de l'affichage des réglages
function erd-wp_simply_share-admin_page() {
?>
  <div class="wrap">
    <h1>ERD Simply Share | Configuration</h1>
    <form method="post" action="options.php">
    <?php
    settings_fields("erd-wp_simply_share_config_section");
    do_settings_sections("erd-wp_simply_share");
    submit_button(); 
    ?>
    </form>
  </div>
<?php
}

//Définition des options
function erd-wp_simply_share_settings()
{
  add_settings_section("erd-wp_simply_share_config_section", "", null, "erd-wp-simply_share");
 
  add_settings_field("erd-wp-simply_share-facebook", "Afficher un bouton de partage Facebook?", "erd-wp_simply_share_facebook_checkbox", "erd-wp-simply_share", "erd-wp_simply_share_config_section");
  add_settings_field("erd-wp-simply_share-twitter", "Afficher un bouton de partage Twitter?", "erd-wp_simply_share_twitter_checkbox", "erd-wp-simply_share", "erd-wp_simply_share_config_section");
  add_settings_field("erd-wp-simply_share-linkedin", "Afficher un bouton de partage LinkedIn?", "erd-wp_simply_share_linkedin_checkbox", "erd-wp-simply_share", "erd-wp_simply_share_config_section");
 
  register_setting("erd-wp_simply_share_config_section", "erd-wp-simply_share-facebook");
  register_setting("erd-wp_simply_share_config_section", "erd-wp-simply_share-twitter");
  register_setting("erd-wp_simply_share_config_section", "erd-wp-simply_share-linkedin");
}

/* Affichage des options */
//Facebook
function erd-wp_simply_share_facebook_checkbox()
{  
?>
  <input type="checkbox" name="erd-wp-simply_share-facebook" value="1" <?php checked(1, get_option('erd-wp-simply_share-facebook'), true); ?> /> Oui
<?php
}

//Twitter
function erd-wp_simply_share_twitter_checkbox()
{  
?>
  <input type="checkbox" name="erd-wp-simply_share-twitter" value="1" <?php checked(1, get_option('erd-wp-simply_share-twitter'), true); ?> /> Oui
<?php
}

//LinkedIn
function erd-wp_simply_share_linkedin_checkbox()
{  
?>
  <input type="checkbox" name="erd-wp-simply_share-linkedin" value="1" <?php checked(1, get_option('erd-wp-simply_share-linkedin'), true); ?> /> Oui
<?php
}
 
add_action("admin_init", "erd-wp_simply_share_settings");

/**** Partie utilisateur (Front-Office) ****/
function add_social_share_icons($content)
{
  $html = "<div class='erd-wp-simply_share-wrapper'><p class='share-on'>Partagez sur: </p>";

  global $post;

  $url = get_permalink($post->ID);
  $url = esc_url($url);

  if(get_option("erd-wp-simply_share-facebook") == 1) :
    $html = $html . "<div class='facebook'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'>Facebook</a></div>";
  endif;

  if(get_option("erd-wp-simply_share-twitter") == 1) :
    $html = $html . "<div class='twitter'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'>Twitter</a></div>";
  endif;

  if(get_option("erd-wp-simply_share-linkedin") == 1) :
    $html = $html . "<div class='linkedin'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'>LinkedIn</a></div>";
  endif;

  $html = $html . "<div class='clear'></div></div>";

  return $content = $content . $html;
}

add_filter("the_content", "add_social_share_icons");


/**** Ajout des styles ****/
//Style utilisateur
function social_share_style() {
  wp_register_style("erd-wp-simply_share-style-file", plugin_dir_url(__FILE__) . "assets/css/screen.css");
  wp_enqueue_style("erd-wp-simply_share-style-file");
}

add_action("wp_enqueue_scripts", "social_share_style");
