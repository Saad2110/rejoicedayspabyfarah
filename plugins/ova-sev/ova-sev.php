<?php
/*
Plugin Name: Ovatheme Service
Plugin URI: https://themeforest.net/user/ovatheme
Description: Service
Author: Ovatheme
Version: 1.0.7
Author URI: https://themeforest.net/user/ovatheme/portfolio
Text Domain: ova-sev
Domain Path: /languages/
*/

if ( !defined( 'ABSPATH' ) ) exit();


if (!class_exists('OvaSev')) {
	
	class OvaSev {

		function __construct(){

			if (!defined('OVASEV_PLUGIN_FILE')) {
                define( 'OVASEV_PLUGIN_FILE', __FILE__ );   
            }

            if (!defined('OVASEV_PLUGIN_URI')) {
                define( 'OVASEV_PLUGIN_URI', plugin_dir_url( __FILE__ ) );   
            }

            if (!defined('OVASEV_PLUGIN_PATH')) {
                define( 'OVASEV_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );   
            }
			

			load_plugin_textdomain( 'ova-sev', false, basename( dirname( __FILE__ ) ) .'/languages' );

			$this -> includes();
			$this -> supports();
		}	

		
		function includes() {

			// inc
			require_once( OVASEV_PLUGIN_PATH.'inc/class-ova-custom-post-type.php' );

			require_once( OVASEV_PLUGIN_PATH.'inc/class-ova-get-data.php' );

			require_once( OVASEV_PLUGIN_PATH.'inc/ova-core-functions.php' );
			
			require_once( OVASEV_PLUGIN_PATH.'inc/class-ova-templates-loaders.php' );

			require_once( OVASEV_PLUGIN_PATH.'inc/class-ova-assets.php' );


			// admin
			require_once( OVASEV_PLUGIN_PATH.'admin/class-ova-metabox.php' );


			/* Customize */
			require_once OVASEV_PLUGIN_PATH.'/inc/class-customize.php';
			

		}


		function supports() {

			/* Make Elementors */
			if ( did_action( 'elementor/loaded' ) ) {
				include OVASEV_PLUGIN_PATH.'elementor/class-ova-register-elementor.php';
			}

		}

	}
}


return new OvaSev();