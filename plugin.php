<?php
/**
 * Plugin Name: Bootstrap Pagebuilder Custom Modules
 * Plugin URI:
 * Description:
 * Version: 1.0
 * Author: Michael W. Delaney
 */
define( 'FL_MODULE_BS_DIR', plugin_dir_path( __FILE__ ) );
define( 'FL_MODULE_BS_URL', plugins_url( '/', __FILE__ ) );

/**
 * Custom modules
 */
function fl_load_module_bs() {
	if ( class_exists( 'FLBuilder' ) ) {
		
		// Replacement modules
		require_once 'bsbutton/bsbutton.php';
	      	require_once 'bscallout/bscallout.php';
		require_once 'bscta/bscta.php';
		
		// New modules
		require_once 'bsbutton/bscard.php';

	}
}
add_action( 'init', 'fl_load_module_bs' );
