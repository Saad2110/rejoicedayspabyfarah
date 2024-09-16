<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVASEV_custom_post_type' ) ) {

	class OVASEV_custom_post_type{

		public function __construct(){
			add_action( 'init', array( $this, 'OVASEV_register_post_type_ova_sev' ) );
			add_action( 'init', array( $this, 'OVASEV_register_taxonomy_ova_sev' ) );
		}

		
		function OVASEV_register_post_type_ova_sev() {

			$taxonomies = array( 'cat_sev');

			$labels = array(
				'name'                  => _x( 'Service', 'Post Type General Name', 'ova-sev' ),
				'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'ova-sev' ),
				'menu_name'             => __( 'Service', 'ova-sev' ),
				'name_admin_bar'        => __( 'Service', 'ova-sev' ),
				'archives'              => __( 'Item Archives', 'ova-sev' ),
				'attributes'            => __( 'Item Attributes', 'ova-sev' ),
				'parent_item_colon'     => __( 'Parent Item:', 'ova-sev' ),
				'all_items'             => __( 'All Service', 'ova-sev' ),
				'add_new_item'          => __( 'Add New', 'ova-sev' ),
				'add_new'               => __( 'Add New', 'ova-sev' ),
				'new_item'              => __( 'New Item', 'ova-sev' ),
				'edit_item'             => __( 'Edit Service', 'ova-sev' ),
				'view_item'             => __( 'View Item', 'ova-sev' ),
				'view_items'            => __( 'View Items', 'ova-sev' ),
				'search_items'          => __( 'Search Item', 'ova-sev' ),
				'not_found'             => __( 'Not found', 'ova-sev' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ova-sev' ),
			);
			$args = array(
				'description'         => __( 'Post Type Description', 'ova-sev' ),
				'labels'              => $labels,
				'supports'            => array( 'title','excerpt', 'editor', 'comments', 'thumbnail' ),
				'taxonomies'         => $taxonomies,
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'menu_position'       => 5,
				'query_var'           => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => array( 'slug' => _x( 'service', 'URL slug', 'ova-sev' ), 
												'with_front' => false ),
				'capability_type'     => 'post',
				'show_in_rest'        => true,
				'menu_icon'           => 'dashicons-admin-tools',
			);
			register_post_type( 'ova_sev', $args );
		}

		function OVASEV_register_taxonomy_ova_sev(){
			

			$labels = array(
				'name'                       => _x( 'Category Service', 'Post Type General Name', 'ova-sev' ),
				'singular_name'              => _x( 'Category', 'Post Type Singular Name', 'ova-sev' ),
				'menu_name'                  => __( 'Categories', 'ova-sev' ),
				'all_items'                  => __( 'All Category Service', 'ova-sev' ),
				'parent_item'                => __( 'Parent Item', 'ova-sev' ),
				'parent_item_colon'          => __( 'Parent Item:', 'ova-sev' ),
				'new_item_name'              => __( 'New Item Name', 'ova-sev' ),
				'add_new_item'               => __( 'Add New Category', 'ova-sev' ),
				'add_new'                    => __( 'Add New Category', 'ova-sev' ),
				'edit_item'                  => __( 'Edit Category', 'ova-sev' ),
				'view_item'                  => __( 'View Item', 'ova-sev' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'ova-sev' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'ova-sev' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'ova-sev' ),
				'popular_items'              => __( 'Popular Items', 'ova-sev' ),
				'search_items'               => __( 'Search Items', 'ova-sev' ),
				'not_found'                  => __( 'Not Found', 'ova-sev' ),
				'no_terms'                   => __( 'No items', 'ova-sev' ),
				'items_list'                 => __( 'Items list', 'ova-sev' ),
				'items_list_navigation'      => __( 'Items list navigation', 'ova-sev' ),

			);
			$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'publicly_queryable' => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => false,
				'show_in_rest'        => true,
				'rewrite'            => array(
					'slug'       => _x( 'cat_sev', 'Service Slug', 'ova-sev' ),
					'with_front' => false,
					'feeds'      => true,
				),
			);
			register_taxonomy( 'cat_sev', array( 'ova_sev' ), $args );
		}
	}

	new OVASEV_custom_post_type();
}