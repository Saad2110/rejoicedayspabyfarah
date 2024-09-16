<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'pre_get_posts', 'ova_sev_post_per_page_archive' );
function ova_sev_post_per_page_archive( $query ) {
	if ( ( is_post_type_archive( 'ova_sev' )  && !is_admin() )  || ( is_tax('cat_sev') && !is_admin() ) ) {
		if( $query->is_post_type_archive( 'ova_sev' ) || $query->is_tax('cat_sev') ) {
			$query->set('post_type', array( 'ova_sev' ) );
			$query->set('posts_per_page', get_theme_mod( 'ova_sev_total_record', 6 ) );
			$query->set('orderby', 'meta_value_num' );
            $query->set('order', 'ASC' );
            $query->set('meta_type', 'NUMERIC' );
            $query->set('meta_key', 'ova_sev_met_order_sev' );
		}
	}
}

// Get All Services Item
function ova_sev_get_all_services(){

	$args = array(
		'post_type' => 'ova_sev',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	);

	return get_posts( $args );

}

function ova_sev_get_services_box( $args ){
	
	$post_per_page = $args['post_per_page'];
	$category 	   = $args['category'];

	if ($category == 'all') {
	    $args_new = array(
			'post_type' => 'ova_sev',
			'post_status' => 'publish',
			'posts_per_page' => $post_per_page,
		);

	} else {
		$args_new = array(
			'post_type' => 'ova_sev',
			'post_status' => 'publish',
			'posts_per_page' => $post_per_page,
			'tax_query'      => array(
                array(
                    'taxonomy' => 'cat_sev',
                    'field'    => 'slug',
                    'terms'    => $category,
                )
            ),
		);
	}

	$args_sev_order = [];
	if( $args['order_by'] === 'ova_sev_met_order_sev' ) {
		$args_sev_order = [
			'meta_key'   => $args['order_by'],
			'orderby'    => 'meta_value_num',
			'meta_type'  => 'NUMERIC',
			'order'      => $args['order'],
		];
	} else { 
		$args_sev_order = [
			'orderby' => $args['order_by'],
			'order'   => $args['order'],
		];
	}

	$args_sev = array_merge( $args_new, $args_sev_order );

	$sevs  = new \WP_Query($args_sev);

	return $sevs;

}