<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */

class Ova_Sev_Register_Elementor {

	function __construct() {
            
		// Register Header Footer Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'ovasev_add_category' ) );

	    add_action( 'elementor/frontend/after_register_scripts', array( $this, 'ovasev_enqueue_scripts' ) );
		
		add_action( 'elementor/widgets/register', array( $this, 'ovasev_include_widgets' ) );
	}

	function ovasev_add_category( ) {
	   	\Elementor\Plugin::instance()->elements_manager->add_category(
	        'ovasev',
	        [
	            'title' => esc_html__( 'Service', 'ova-sev' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );
	}

	function ovasev_enqueue_scripts() {
        $files = glob( OVASEV_PLUGIN_PATH . 'assets/js/elementor/*.js' );
      
        foreach ($files as $file) {
            $file_name = wp_basename($file);
            $handle    = str_replace(".js", '', $file_name);
            $src       = OVASEV_PLUGIN_URI . 'assets/js/elementor/' . $file_name;
            if (file_exists($file)) {
                wp_register_script( 'ovasev-elementor-' . $handle, $src, ['jquery'], null, true );
            }
        }
	}

	function ovasev_include_widgets( $widgets_manager ) {
        $files = glob( OVASEV_PLUGIN_PATH . 'elementor/widgets/*.php' );

        foreach ($files as $file) {
            $file = OVASEV_PLUGIN_PATH . 'elementor/widgets/' .wp_basename($file);
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }
}

new Ova_Sev_Register_Elementor();