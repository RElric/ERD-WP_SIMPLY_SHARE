<?php

/**** Gestion de la BDD ****/
//Version de la BDD
global $erd_ss_db_version;
$erd_ss_db_version = '1.0.0';

//Installation de la BDD
function erd_ss_install() {
    global $wpdb;
    global $erd_ss_db_version;

    $table_name = $wpdb->prefix . 'erd_simply_share';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE ".$table_name." (
      id INT NOT NULL AUTO_INCREMENT,
      name VARCHAR(100) NOT NULL,
      url VARCHAR(100) NOT NULL,
      ordering TINYINT NOT NULL DEFAULT 0,
      PRIMARY KEY (id),
      UNIQUE KEY name (name)
    ) ".$charset_collate.";";

    require_once( ABSPATH .  'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'erd_ss_db_version', $erd_ss_db_version );
}

//Installation des données initiales
function erd_ss_install_data() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'erd_simply_share';
    
    /* Insertion des réseaux sociaux pris en charge */
    //Twitter
    $twitter_name = 'Twitter';
    $twitter_url = 'http://www.twitter.com/home/?status=$$TITLE$$ - $$PERMALINK$$';
    $wpdb->replace( 
        $table_name, 
        array( 
            'name' => $twitter_name, 
            'url' => $twitter_url
        )
    );
    
    //Facebook
    $facebook_name = 'Facebook';
    $facebook_url = 'http://www.facebook.com/sharer.php?u=$$PERMALINK$$&amp;t=$$TITLE$$';
    $wpdb->replace( 
        $table_name, 
        array( 
            'name' => $facebook_name, 
            'url' => $facebook_url
        )
    );
    
    //LinkedIn
    $linkedin_name = 'LinkedIn';
    $linkedin_url = 'http://www.linkedin.com/shareArticle?mini=true&amp;title=$$TITLE$$&amp;url=$$PERMALINK$$';
    $wpdb->replace( 
        $table_name, 
        array( 
            'name' => $linkedin_name, 
            'url' => $linkedin_url
        )
    );
}

//Fonction de MAJ de la BDD
function erd_ss_update() {
    global $wpdb;
    global $erd_ss_db_version;
    $installed_ver = get_option( "erd_ss_db_version" );

    if ( $installed_ver != $erd_ss_db_version ) {
        $table_name = $wpdb->prefix . 'erd_simply_share';

        $sql = "CREATE TABLE ".$table_name." (
          id INT NOT NULL AUTO_INCREMENT,
          name VARCHAR(100) NOT NULL,
          url VARCHAR(100) NOT NULL,
          ordering TINYINT NOT NULL DEFAULT 0,
          PRIMARY KEY  (id),
          UNIQUE KEY name (name)
        );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        update_option( "erd_ss_db_version", $erd_ss_db_version );
    }
}
