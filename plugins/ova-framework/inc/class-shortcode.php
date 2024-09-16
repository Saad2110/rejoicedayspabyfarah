<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Mellis_Shortcode') ){
    
    class Mellis_Shortcode {

        public function __construct() {

            add_shortcode( 'mellis-elementor-template', array( $this, 'mellis_elementor_template' ) );
            
        }

        public function mellis_elementor_template( $atts ){

            $atts = extract( shortcode_atts(
            array(
                'id'  => '',
            ), $atts) );

            $args = array(
                'id' => $id
                
            );

            if( did_action( 'elementor/loaded' ) ){
                return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id );    
            }
            return;

            
        }

        

    }
}



return new Mellis_Shortcode();

