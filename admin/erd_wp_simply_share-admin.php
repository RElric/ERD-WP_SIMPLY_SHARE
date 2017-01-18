<?php

/**** Configuration pour le menu d'administration ****/

/* Options */
//Définition des options
function register_erd_wp_simply_share_setting() {
  register_setting('erd_wp_simply_share_options', 'erd_wp_simply_share_twitter');
  register_setting('erd_wp_simply_share_options', 'erd_wp_simply_share_facebook');
  register_setting('erd_wp_simply_share_options', 'erd_wp_simply_share_linkedin');

  add_settings_section('erd_wp_simply_share_options', 'ERD Simply Share | Configuration', null, "erd_wp_simply_share");

  add_settings_field('erd_wp_simply_share_twitter', 'Voulez-vous un bouton de partage Twitter?', 'erd_wp_simply_share_twitter_btn', 'erd_wp_simply_share', 'erd_wp_simply_share_options');
  add_settings_field('erd_wp_simply_share_facebook', 'Voulez-vous un bouton de partage Facebook?', 'erd_wp_simply_share_facebook_btn', 'erd_wp_simply_share', 'erd_wp_simply_share_options');
  add_settings_field('erd_wp_simply_share_linkedin', 'Voulez-vous un bouton de partage LinkedIn?', 'erd_wp_simply_share_linkedin_btn', 'erd_wp_simply_share', 'erd_wp_simply_share_options');
}
function erd_wp_simply_share_twitter_btn() {
?>
  <label for="erd_wp_simply_share_twitter">Oui&nbsp;</label><input type="checkbox" value="1" <?php checked(1, get_option('erd_wp_simply_share_twitter'), true); ?> name="erd_wp_simply_share_twitter" id="erd_wp_simply_share_twitter">
<?php
}
//Affichage des options
function erd_wp_simply_share_facebook_btn() {
?>
  <label for="erd_wp_simply_share_facebook">Oui&nbsp;</label><input type="checkbox" value="1" <?php checked(1, get_option('erd_wp_simply_share_facebook'), true); ?> name="erd_wp_simply_share_facebook" id="erd_wp_simply_share_facebook">
<?php
}
function erd_wp_simply_share_linkedin_btn() {
?>
  <label for="erd_wp_simply_share_linkedin">Oui&nbsp;</label><input type="checkbox" value="1" <?php checked(1, get_option('erd_wp_simply_share_linkedin'), true); ?> name="erd_wp_simply_share_linkedin" id="erd_wp_simply_share_linkedin">
<?php
}
//Enregistrement des options
add_action('admin_init', "register_erd_wp_simply_share_setting");

//HTML de la page de menu (sans les options)
function erd_wp_simply_share_page_html() {
  if(!current_user_can('manage_options')) :
    return;
  endif;
?>
  <div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('erd_wp_simply_share_options');
        do_settings_sections('erd_wp_simply_share');
        submit_button('Sauvegarder les paramètres');
        ?>
    </form>
  </div>
<?php
}

//Enregistrement de la page d'admin
function erd_wp_simply_share_options_page() {
    add_submenu_page(
        'options-general.php',
        'ERD Simply Share',
        'ERD Simply Share',
        'manage_options',
        'erd_wp_simply_share',
        'erd_wp_simply_share_page_html'
    );
}
add_action('admin_menu', 'erd_wp_simply_share_options_page');
