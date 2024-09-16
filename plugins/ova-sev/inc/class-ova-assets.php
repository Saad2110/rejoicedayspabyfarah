<?php 
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVASEV_assets' ) ){
	class OVASEV_assets{

		public function __construct(){

			add_action( 'wp_enqueue_scripts', array( $this, 'ovasev_enqueue_scripts' ), 10, 0 );

			/* Add JS for Elementor */
			add_action( 'elementor/frontend/after_register_scripts', array( $this, 'ova_enqueue_scripts_elementor_sev' ) );

		}



		public function ovasev_enqueue_scripts(){

			// Init Css
			wp_enqueue_style( 'service_style', OVASEV_PLUGIN_URI.'assets/css/style.css' );	

		}

		// Add JS for elementor
		public function ova_enqueue_scripts_elementor_sev(){
			wp_enqueue_script( 'script-elementor-sev', OVASEV_PLUGIN_URI. 'assets/js/script.js', [ 'jquery' ], false, true );
		}


	}
	new OVASEV_assets();
}
