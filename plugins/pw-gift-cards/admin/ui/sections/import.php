<?php

defined( 'ABSPATH' ) or exit;

?>
<div id="pwgc-section-import" class="pwgc-section" style="<?php pwgc_dashboard_helper( 'import', 'display: block;' ); ?>">
    <form id="pwgc-import-gift-cards-form" method="POST" enctype="multipart/form-data">
        <div class="pwgc-import-gift-cards-container">
            <div>
                <div class="pwgc-import-header">
                    <?php esc_html_e( 'Import CSV File', 'pw-woocommerce-gift-cards' ); ?>
                </div>
                <input type="file" name="pwgc_import_file" id="pwgc-import-file" accept="text/csv" required>
                <br /><br />
                <input type="submit" id="pwgc-import-file-submit-button" class="button button-primary" value="<?php esc_attr_e( 'Upload CSV File', 'pw-woocommerce-gift-cards' ); ?>">
            </div>
            <div class="pwgc-import-gift-cards-instructions">
                <div class="pwgc-import-header">
                    <?php esc_html_e( 'Import Instructions', 'pw-woocommerce-gift-cards' ); ?>
                </div>
                <div style="margin-bottom: 12px;">
                    <?php esc_html_e( 'Import a comma-separated value file (CSV) of existing gift card numbers. This is useful for importing physical gift cards sold to customers. You will see a preview of the results before anything is saved to the database.', 'pw-woocommerce-gift-cards' ); ?>
                    <br />
                    <br />
                    <?php esc_html_e( 'The CSV should NOT have a header and the columns must be in this order:', 'pw-woocommerce-gift-cards' ); ?>
                    <div style="margin: 12px 24px;">
                        <pre><?php esc_html_e( 'Gift Card Number, Balance, Expiration Date (optional), Recipient Email (optional)', 'pw-woocommerce-gift-cards' ); ?></pre>
                    </div>
                    <?php esc_html_e( 'The Gift Card Number column is required, however it can be left blank. If it is blank, a new random gift card number will be generated.', 'pw-woocommerce-gift-cards' ); ?>
                </div>
                <div>
                    <a href="<?php echo plugins_url( '/assets/gift-cards-sample.csv', PWGC_PLUGIN_FILE ); ?>" class="button"><i class="far fa-file-excel"></i> Download a sample CSV file</a>
                </div>
            </div>
        </div>
        <div id="pwgc-import-results"></div>
    </form>
    <div class="pwgc-export-gift-cards-container">
        <?php
            $export_url = add_query_arg( 'page', pwgc_admin_page(), get_site_url() );
            $export_url = add_query_arg( 'pwgc_export', '1', get_site_url() );
            $export_url = add_query_arg( 'security', wp_create_nonce( 'pw-gift-cards-export' ), $export_url );
        ?>
        <div>
            <div class="pwgc-import-header">
                <?php esc_html_e( 'Export your gift card data', 'pw-woocommerce-gift-cards' ); ?>
            </div>
            <div>
                <select id="pwgc-export-dates">
                    <option value=""><?php esc_html_e( 'All gift cards', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="create_date"><?php esc_html_e( 'Gift Cards by Create Date', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="expiration_date"><?php esc_html_e( 'Gift Cards by Expiration Date', 'pw-woocommerce-gift-cards' ); ?></option>
                </select>
            </div>
            <div id="pwgc-export-date-range">
                <label for="pwgc-export-begin-date"><?php esc_html_e( 'Begin Date', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" class="short" name="begin_date" id="pwgc-export-begin-date" placeholder="YYYY-MM-DD" maxlength="10" pattern="<?php echo esc_attr( apply_filters( 'woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])' ) ); ?>" />

                <label for="pwgc-export-end-date"><?php esc_html_e( 'End Date', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" class="short" name="end_date" id="pwgc-export-end-date" placeholder="YYYY-MM-DD" maxlength="10" pattern="<?php echo esc_attr( apply_filters( 'woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])' ) ); ?>" />
            </div>
            <div style="margin-top: 1em;">
                <a href="<?php esc_attr_e( $export_url ); ?>" id="pwgc-export-button" class="button"><i class="far fa-file-excel"></i> <?php esc_html_e( 'Download CSV File', 'pw-woocommerce-gift-cards' ); ?></a>
            </div>
        </div>
    </div>
</div>
