<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if( !function_exists( 'ovasev_locate_template' ) ){
	function ovasev_locate_template( $template_name, $template_path = '', $default_path = '' ) {
		
		// Set variable to search in ovacoll-templates folder of theme.
		if ( ! $template_path ) :
			$template_path = 'ovasev-templates/';
		endif;

		// Set default plugin templates path.
		if ( ! $default_path ) :
			$default_path = OVASEV_PLUGIN_PATH . 'templates/'; // Path to the template folder
		endif;

		// Search template file in theme folder.
		$template = locate_template( array(
			$template_path . $template_name
			// $template_name
		) );

		// Get plugins template file.
		if ( ! $template ) :
			$template = $default_path . $template_name;
		endif;

		return apply_filters( 'ovasev_locate_template', $template, $template_name, $template_path, $default_path );
	}

}


function ovasev_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {
	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args );
	endif;
	$template_file = ovasev_locate_template( $template_name, $tempate_path, $default_path );
	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;

	
	include $template_file;
}


add_filter( 'mellis_header_customize', 'mellis_header_customize_sev', 10, 1 );
function mellis_header_customize_sev( $header ){


	if( is_tax( 'cat_sev' ) ||  get_query_var( 'cat_sev' ) != '' || is_post_type_archive( 'ova_sev' ) ){

	  	$header = get_theme_mod( 'header_archive_sev', 'default' );

	}else if( is_singular( 'ova_sev' ) ){

		$header = get_theme_mod( 'header_single_sev', 'default' );
	}

	return $header;

}


add_filter( 'mellis_header_bg_customize', 'mellis_header_bg_customize_sev', 10, 1 );
function mellis_header_bg_customize_sev( $bg ){

	if( is_tax( 'cat_sev' ) ||  get_query_var( 'cat_sev' ) != '' || is_post_type_archive( 'ova_sev' ) ){

	  	$bg = get_theme_mod( 'archive_background_sev', '' );

	}else if( is_singular( 'ova_sev' ) ){

		$bg = get_theme_mod( 'single_background_sev', '' );

		$current_id = mellis_get_current_id();
        $header_bg_source =  get_the_post_thumbnail_url( $current_id, 'full' );

        if( $header_bg_source ){
            $bg = $header_bg_source;
        }
	}


	return $bg;
}


add_filter( 'mellis_footer_customize', 'mellis_footer_customize_sev', 10, 1 );
function mellis_footer_customize_sev( $footer ){
    
   if( is_tax( 'cat_sev' ) ||  get_query_var( 'cat_sev' ) != '' || is_post_type_archive( 'ova_sev' ) ){

        $footer = get_theme_mod( 'archive_footer_sev', 'default' );

    }else if( is_singular( 'ova_sev' ) ){

        $footer = get_theme_mod( 'single_footer_sev', 'default' );
    }

    return $footer;


}