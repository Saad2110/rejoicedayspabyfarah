<?php

require_once (MELLIS_URL.'/install-resource/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'mellis_register_required_plugins' );


function mellis_register_required_plugins() {
   
    $plugins = array(

        array(
            'name'                     => esc_html__('Elementor','mellis'),
            'slug'                     => 'elementor',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Contact Form 7','mellis'),
            'slug'                     => 'contact-form-7',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Mailchimp for wp','mellis'),
            'slug'                     => 'mailchimp-for-wp',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('CMB2','mellis'),
            'slug'                     => 'cmb2',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Woocommerce','mellis'),
            'slug'                     => 'woocommerce',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Widget importer exporter','mellis'),
            'slug'                     => 'widget-importer-exporter',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('One click demo import','mellis'),
            'slug'                     => 'one-click-demo-import',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Social Feed Gallery','mellis'),
            'slug'                     => 'insta-gallery',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('OvaTheme Framework','mellis'),
            'slug'                     => 'ova-framework',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install-resource/plugins/ova-framework.zip',
            'version'                  => '1.0.2',
        ),
        array(
            'name'                     => esc_html__('Slider Revolution','mellis'),
            'slug'                     => 'revslider',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install-resource/plugins/revslider.zip',
            'version'                  => '6.7.3',
        ),
        array(
            'name'                     => esc_html__('OvaTheme Service','mellis'),
            'slug'                     => 'ova-sev',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install-resource/plugins/ova-sev.zip',
            'version'                  => '1.0.7',
        ),
        array(
            'name'                     => esc_html__('YITH WooCommerce Wishlist','mellis'),
            'slug'                     => 'yith-woocommerce-wishlist',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Ovatheme MegaMenu','mellis'),
            'slug'                     => 'ova-megamenu',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install-resource/plugins/ova-megamenu.zip',
            'version'                  => '1.0.0',
        ),
    );

    $config = array(
        'id'           => 'mellis',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    mellis_tgmpa( $plugins, $config );
}

add_action( 'pt-ocdi/after_import', 'mellis_after_import_setup' );
function mellis_after_import_setup() {

    mellis_replace_url_after_import();

    // Assign menus to their locations.
    $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $primary->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = mellis_get_page_by_title( 'Home 1' );
    $blog_page_id  = mellis_get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    mellis_import_slideshows_demo();
}

add_filter( 'pt-ocdi/import_files', 'mellis_import_files' );
function mellis_import_files() {
    return array(
        array(
            'import_file_name'             => 'Demo Import',
            'categories'                   => array( 'Category 1', 'Category 2' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/demo-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/widgets.wie',
            'local_import_customizer_file'   => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/customize.dat',
        )
    );
}

// Get page by title
if ( ! function_exists( 'mellis_get_page_by_title' ) ) {
    function mellis_get_page_by_title( $page_title, $output = OBJECT, $post_type = 'page' ) {
        global $wpdb;

        if ( is_array( $post_type ) ) {
            $post_type           = esc_sql( $post_type );
            $post_type_in_string = "'" . implode( "','", $post_type ) . "'";
            $sql                 = $wpdb->prepare(
                "
                SELECT ID
                FROM $wpdb->posts
                WHERE post_title = %s
                AND post_type IN ($post_type_in_string)
            ",
                $page_title
            );
        } else {
            $sql = $wpdb->prepare(
                "
                SELECT ID
                FROM $wpdb->posts
                WHERE post_title = %s
                AND post_type = %s
            ",
                $page_title,
                $post_type
            );
        }

        $page = $wpdb->get_var( $sql );

        if ( $page ) {
            return get_post( $page, $output );
        }

        return null;
    }
}

// Replace url after import demo data
if ( ! function_exists('mellis_replace_url_after_import') ) {
    
    function mellis_replace_url_after_import(){
        global $wpdb;
        $site_url       = get_site_url();
        $ovatheme_url   = "https://demo.ovatheme.com/mellis";
        $wpdb->get_results( "UPDATE {$wpdb->prefix}options SET option_value = replace(option_value, '{$ovatheme_url}', '{$site_url}' )" );
        $wpdb->get_results( "UPDATE {$wpdb->prefix}postmeta SET meta_value = replace(meta_value, '{$ovatheme_url}', '{$site_url}' )" );
        $wpdb->get_results( "UPDATE {$wpdb->prefix}posts SET post_content = replace(post_content, '{$ovatheme_url}', '{$site_url}' )" );
        $wpdb->get_results( "UPDATE {$wpdb->prefix}posts SET guid = replace(guid, '{$ovatheme_url}', '{$site_url}' )" );

        // Elementor replace
        $escaped_from       = str_replace( '/', '\\/', $ovatheme_url );
        $escaped_to         = str_replace( '/', '\\/', $site_url );
        $meta_value_like    = '[%'; // meta_value LIKE '[%' are json formatted

        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} " .
                'SET `meta_value` = REPLACE(`meta_value`, %s, %s) ' .
                "WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE %s;",
                $escaped_from,
                $escaped_to,
                $meta_value_like
            )
        );
    }
}


// Import slideshows
if ( ! function_exists( 'mellis_import_slideshows_demo' ) ) {
    function mellis_import_slideshows_demo() {
        if ( is_plugin_active('revslider/revslider.php') && class_exists( 'RevSliderSliderImport' ) ) {
            $slide_files = glob( get_template_directory() . '/install-resource/demo-import/slideshows/*.zip' );

            if ( ! empty( $slide_files ) && is_array( $slide_files ) ) {
                $import = new RevSliderSliderImport();

                foreach ( $slide_files as $path_file ) {
                    if ( file_exists( $path_file ) ) {
                        $return = $import->import_slider( false, $path_file );
                    }
                }
            }
        }
    }
}

