<?php

defined( 'ABSPATH' ) or exit;

global $pw_gift_cards_email_designer;

?>
<div id="pwgc-section-create" class="pwgc-section" style="<?php pwgc_dashboard_helper( 'create', 'display: block;' ); ?>">
    <form id="pwgc-create-gift-card-form" style="max-width: 600px;">
        <p class="form-field pwgc-create-quantity_field">
            <label for="pwgc-create-quantity"><?php esc_html_e( 'Number of cards to create', 'pw-woocommerce-gift-cards' ); ?></label>
            <input type="number" class="pwgc-create-short" name="pwgc-create-quantity" id="pwgc-create-quantity" value="1" placeholder="" step="1" min="1" required>
        </p>
        <p class="form-field pwgc-create-number">
            <label for="pwgc-create-number"><?php esc_html_e( 'Gift Card Number', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?> - <?php esc_html_e( 'Existing gift card number to insert.', 'pw-woocommerce-gift-cards' ); ?></label>
            <input type="text" name="pwgc-create-number" id="pwgc-create-number" autocomplete="cc-csc">
        </p>
        <?php
            $products = pwgc_get_all_gift_card_products();
            if ( !empty( $products ) ) {
                ?>
                    <p class="form-field pwgc-create-variation-id">
                        <label for="pwgc-create-variation-id">
                            <?php esc_html_e( 'Gift Card Product', 'pw-woocommerce-gift-cards' ); ?><br />
                            <select id="pwgc-create-variation-id" name="variation_id" style="margin-right: 16px;">
                                <?php
                                    foreach ( $products as $product ) {
                                        foreach ( $product->get_children() as $variation_id ) {
                                            $variation = wc_get_product( $variation_id );
                                            if ( is_a( $variation, 'WC_Product_Variation' ) ) {
                                                $variation_name = $variation->get_name();
                                                if ( PWGC_SHOW_SKU_IN_VARIATION_NAME ) {
                                                    if ( $variation->get_sku() ) {
                                                        $identifier = $variation->get_sku();
                                                    } else {
                                                        $identifier = '#' . $variation->get_id();
                                                    }
                                                    $variation_name = sprintf( '%2$s (%1$s)', $identifier, $variation->get_name() );
                                                }

                                                ?>
                                                <option value="<?php echo $variation_id; ?>" data-amount="<?php echo $variation->get_price(); ?>"><?php esc_html_e( $variation_name ); ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </label>
                    </p>
                <?php
            }
        ?>
        <p class="form-field pwgc-create-amount_field">
            <label for="pwgc-create-amount"><?php esc_html_e( 'Initial balance', 'pw-woocommerce-gift-cards' ); ?> (<?php echo get_woocommerce_currency_symbol(); ?>)</label>
            <input type="text" class="pwgc-create-short wc_input_price" name="pwgc-create-amount" id="pwgc-create-amount" value="" placeholder="" required>
        </p>
        <p class="form-field pwgc-create-expiration_date pwgc-expiration-date-element" style="display: <?php if ( 'no' === get_option( 'pwgc_no_expiration_date', 'no' ) ) { echo 'block'; } else { echo 'none'; } ?>;">
            <label for="pwgc-create-expiration-date"><?php esc_html_e( 'Expiration date', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?></label>
            <input type="text" class="pwgc-create-short" name="pwgc-create-expiration-date" id="pwgc-create-expiration-date" value="" placeholder="" autocomplete="cc-csc">
        </p>
        <p class="form-field pwgc-create-recipient-email">
            <label for="pwgc-create-recipient-email"><?php esc_html_e( 'Recipient Email', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?></label>
            <input type="text" name="pwgc-create-recipient-email" id="pwgc-create-recipient-email">
        </p>
        <p class="form-field pwgc-create-recipient-name">
            <label for="pwgc-create-recipient-name"><?php esc_html_e( 'Recipient Name', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?> - <?php esc_html_e( 'Shown to the Recipient in the gift card email.', 'pw-woocommerce-gift-cards' ); ?></label>
            <input type="text" name="pwgc-create-recipient-name" id="pwgc-create-recipient-name">
        </p>
        <p class="form-field pwgc-create-from">
            <label for="pwgc-create-from"><?php esc_html_e( 'From', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?> - <?php esc_html_e( 'Shown to the Recipient in the gift card email.', 'pw-woocommerce-gift-cards' ); ?></label>
            <input type="text" name="pwgc-create-from" id="pwgc-create-from">
        </p>
        <p class="form-field pwgc-create-message">
            <label for="pwgc-create-message"><?php esc_html_e( 'Message', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?> - <?php esc_html_e( 'Shown to the Recipient in the gift card email.', 'pw-woocommerce-gift-cards' ); ?></label>
            <textarea name="pwgc-create-message" rows="3" id="pwgc-create-message"></textarea>
        </p>
        <p class="form-field pwgc-create-design-id">
            <label for="pwgc-create-design-id">
                <?php esc_html_e( 'Email Design - Only used if Recipient Email has been specified.', 'pw-woocommerce-gift-cards' ); ?><br />
                <select id="pwgc-create-design-id" name="design_id" style="margin-right: 16px;">
                    <?php
                        $designs = $pw_gift_cards_email_designer->get_designs();
                        $design = reset( $designs );
                        $design_id = key( $designs );

                        foreach ( $designs as $id => $design_option ) {
                            ?>
                            <option value="<?php echo $id; ?>"><?php echo esc_html( $design_option['name'] ); ?></option>
                            <?php
                        }
                    ?>
                </select>
            </label>
        </p>
        <p class="form-field pwgc-create-note">
            <label for="pwgc-create-note"><?php esc_html_e( 'Note (optional) - Added to the Activity record in the admin area. Not shown to the customer.', 'pw-woocommerce-gift-cards' ); ?></label>
            <input type="text" name="pwgc-create-note" id="pwgc-create-note">
        </p>
        <p class="form-field pwgc-create-send-email">
            <label for="pwgc-create-send-email">
                <input type="checkbox" name="pwgc-create-send-email" id="pwgc-create-send-email" value="yes" autocomplete="off" <?php if ( 'yes' === get_option( 'pwgc_create_send_email', 'no' ) ) { echo 'checked'; } ?>>
                <?php esc_html_e( 'Send gift card email to Recipient Email if provided.', 'pw-woocommerce-gift-cards' ); ?>
            </label>
        </p>
        <p class="form-field pwgc-create-reset-form">
            <label for="pwgc-create-reset-form">
                <input type="checkbox" name="pwgc-create-reset-form" id="pwgc-create-reset-form" value="yes" autocomplete="off" checked>
                <?php esc_html_e( 'Reset this form after creating the gift cards.', 'pw-woocommerce-gift-cards' ); ?>
            </label>
        </p>

        <div style="display: inline-block; margin-top: 12px;">
            <div id="pwgc-create-gift-card-results"></div>
            <input type="submit" id="pwgc-create-gift-card-button" class="button button-primary" value="<?php esc_html_e( 'Create', 'pw-woocommerce-gift-cards' ); ?>">
        </div>
    </form>

    <div style="margin-top: 32px;">
        <div id="pwgc-create-search-results"></div>
    </div>
</div>
<script>
    jQuery(function() {
        jQuery('#pwgc-create-expiration-date').datepicker({
            defaultDate: '',
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
            showButtonPanel: true
        });
    });
</script>