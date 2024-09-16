<?php

defined( 'ABSPATH' ) or exit;

/*
 * Hook into the WooCommerce System Status Report to show diagnostic information for Pimwick Plugins.
 *
 * Use the 'pimwick_system_status_report' hook to add information to the report.
 *
 */
if ( !function_exists( 'pimwick_system_status_report' ) ) {
    function pimwick_system_status_report() {
        ?>
        <table class="wc_status_table widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3" data-export-label="Pimwick Plugins"><h2>Pimwick Plugins</h2></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    do_action( 'pimwick_system_status_report' );
                ?>
            </tbody>
        </table>
        <?php
    }

    add_action( 'woocommerce_system_status_report', 'pimwick_system_status_report' );
}

if ( !function_exists( 'pimwick_system_status_report_license_info' ) ) {
    function pimwick_system_status_report_license_info( $plugin_file ) {

        $plugin_data = get_plugin_data( $plugin_file );

        $slug = basename( $plugin_file, '.php' );
        $plugin_name = $plugin_data['Name'];

        $output = array();

        $license_data = get_option( $slug . '-license-data', '' );
        if ( !empty( $license_data ) ) {
            if ( is_a( $license_data, 'stdClass' ) ) {
                $output[] = 'License key: ' . ( property_exists( $license_data, 'license_key' ) ? $license_data->license_key : 'n/a' );
                $output[] = 'Result: ' . ( property_exists( $license_data, 'result' ) ? $license_data->result : 'n/a' );
                $output[] = 'Cached: ' . ( property_exists( $license_data, 'cached_on' ) ? $license_data->cached_on : 'n/a' );
            } else {
                $output[] = print_r( $license_data, true );
            }
        }

        $license = get_option( $slug . '-license', '' );
        if ( !empty( $license ) ) {
            $output[] = print_r( $license, true );
        }

        ?>
        <tr>
            <td data-export-label="<?php esc_attr_e( $plugin_name ); ?>"><?php esc_html_e( $plugin_name ); ?>:</td>
            <td class="help">&nbsp;</td>
            <td>
                <?php
                    esc_html_e( implode( ', ', $output ) );
                ?>
            </td>
        </tr>
        <?php
    }
}
