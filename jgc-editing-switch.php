<?php
/*
Plugin Name: JGC Editing Switch
Description: This plugin allows you to quickly change page or post in the edit screen while editing.
Version: 1.2.1
Author: GalussoThemes
Author URI: http://galussothemes.com
License: GPL3
Text Domain: jgc-editing-switch
Domain Path: /languages/
*/

// Salir si se accede directamente
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('init', 'jgcedsw_load_textdomain');
function jgcedsw_load_textdomain() {
	
	load_plugin_textdomain( 'jgc-editing-switch', false, basename( dirname( __FILE__ ) ) . '/languages' );
	
}

function jgcedsw_by(){
	echo '<div style="padding-top:5px;text-align:right; font-size:95%; color:#cccccc;font-style:italic;"><a style="color:#cccccc;" href="http://galussothemes.com" target="_blank">GalussoThemes</a></div>';
}

require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-editing-switch-posts.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-editing-switch-pages.php' );

?>
