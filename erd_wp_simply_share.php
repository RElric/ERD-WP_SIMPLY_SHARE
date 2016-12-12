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

/**** Gestion de l'installation et de la désinstallation ****/
//MAJ des permaliens à l'activation
function erd_simply_share_activation()
{
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'erd_simply_share_activation' );

function erd_simply_share_deactivation()
{
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'erd_simply_share_deactivation' );


/**** Partie administration (Back Office) ****/
if(is_admin()) :
  require_once(dirname( __FILE__ ).'/admin/erd_wp_simply_share-admin.php');
endif;

/**** Partie utilisateur (Front-Office) ****/
require_once(dirname( __FILE__ ).'/public/erd_wp_simply_share-public.php');

