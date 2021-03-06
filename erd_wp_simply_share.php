<?php

/*
  Plugin Name: ERD Simply Share
  Plugin URI: https://github.com/RElric/ERD-WP_SIMPLY_SHARE
  Description: A WP plugin to simply share on social networks made by ERDigital - Free to use and modify with mention of the author include commercial use
  Version: 1.0.0
  Author: ERDigital
  Author URI: https://www.er-digital.com/
  Licence: GPL2
  Licence URI: https://www.gnu.org/licenses/gpl-2.0.html
  Text Domain: erd_simply_share

  {Plugin Name} is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.
   
  {Plugin Name} is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.
   
  You should have received a copy of the GNU General Public License
  along with {Plugin Name}. If not, see {License URI}.
 */

/**** Définition de la version du plugin (en interne) ****/
if (!defined('ERD_SS_VERSION_KEY'))
    define('ERD_SS_VERSION_KEY', 'erd_ss_version');

if (!defined('ERD_SS_VERSION_NUM'))
    define('ERD_SS_VERSION_NUM', '1.0.0');

add_option(ERD_SS_VERSION_KEY, ERD_SS_VERSION_NUM);

/**** Gestion de la BDD ****/
require_once(dirname( __FILE__ ).'/erd_wp_simply_share-bdd.php');

/**** HOOK de MAJ, d'activation, de désactivation et de suppression ****/
//MAJ du plugin
function erd_ss_update_db_check() {
    global $erd_ss_db_version;
    if ( get_site_option( 'erd_ss_db_version' ) != $erd_ss_db_version ) {
        erd_ss_update();
        erd_ss_install_data();
    }
}
add_action( 'plugins_loaded', 'erd_ss_update_db_check' );

//Nouvelle version du plugin
$new_version = '1.0.0';

if (get_option(ERD_SS_VERSION_KEY) != $new_version) {
    // Execute your upgrade logic here

    // Then update the version value
    update_option(ERD_SS_VERSION_KEY, $new_version);
}

//Ajout des paramètres
function erd_ss_plugin_action_links($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        // The "page" query string value must be equal to the slug
        // of the Settings admin page we defined earlier, which in
        // this case equals "erd_ss-settings".
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=erd_wp_simply_share">Réglages</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}
add_filter('plugin_action_links', 'erd_ss_plugin_action_links', 10, 2);

//Ajoute les tables si elles n'existent pas et nettoie les permaliens
function erd_simply_share_activation() {
    erd_ss_install();
    erd_ss_install_data();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'erd_simply_share_activation' );

//Nettoie les permaliens
function erd_simply_share_deactivation() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'erd_simply_share_deactivation' );

function erd_simply_share_uninstallation() {
    $erd_ss_db_version = "erd_ss_db_version";
    delete_option($erd_ss_db_version);

    global $wpdb;
    $wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.'erd_simply_share');
}


/**** Partie administration (Back Office) ****/
if(is_admin()) :
  require_once(dirname( __FILE__ ).'/admin/erd_wp_simply_share-admin.php');
endif;

/**** Partie utilisateur (Front-Office) ****/
require_once(dirname( __FILE__ ).'/public/erd_wp_simply_share-public.php');
