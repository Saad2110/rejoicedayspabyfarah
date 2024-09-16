<?php

defined( 'ABSPATH' ) or exit;

$card_number = wc_clean( $_POST['card_number'] );

$gift_card = new PW_Gift_Card( $card_number );
if ( !$gift_card->get_id() ) {
    ?><strong><?php esc_html_e( 'Gift card not found.', 'pw-woocommerce-gift-cards' ); ?></strong><?php
    return;
}

?>
<form class="pwgc-search-results-email-form">
    <div>
        <label>
            <?php esc_html_e( 'Recipient Email Address', 'pw-woocommerce-gift-cards' ); ?><br />
            <input type="text" name="to" value="<?php esc_attr_e( $gift_card->get_recipient_email() ); ?>" required>
        </label>
    </div>
    <div>
        <label>
            <?php esc_html_e( 'Recipient Name', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?><br />
            <input type="text" name="recipient_name" value="<?php esc_attr_e( $gift_card->get_recipient_name() ); ?>">
        </label>
    </div>
    <div>
        <label>
            <?php esc_html_e( 'From', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?><br />
            <input type="text" name="from" value="<?php esc_attr_e( $gift_card->get_from() ); ?>">
        </label>
    </div>
    <div>
        <label>
            <?php esc_html_e( 'Message', 'pw-woocommerce-gift-cards' ); ?> <?php esc_html_e( '(optional)', 'pw-woocommerce-gift-cards' ); ?><br />
            <textarea name="note"><?php esc_html_e( $gift_card->get_message() ); ?></textarea>
        </label>
    </div>
    <div>
        <label>
            <?php esc_html_e( 'Email Design', 'pw-woocommerce-gift-cards' ); ?><br />
            <select name="email_design">
                <?php
                    $designs = $GLOBALS['pw_gift_cards_email_designer']->get_designs();
                    foreach ( $designs as $id => $design_option ) {
                        ?>
                        <option value="<?php echo $id; ?>" <?php selected( $id, $gift_card->get_email_design_id() ); ?>><?php echo esc_html( $design_option['name'] ); ?></option>
                        <?php
                    }
                ?>
            </select>
        </label>
    </div>
    <div>
        <label>
            <input type="checkbox" name="save_meta" checked><?php esc_html_e( 'Save these values to this gift card.', 'pw-woocommerce-gift-cards' ); ?>
        </label>
    </div>
    <div>
        <input type="submit" class="button button-primary pwgc-search-results-send-email-button" value="<?php esc_attr_e( 'Send', 'pw-woocommerce-gift-cards' ); ?>">
        <a href="#" class="button button-secondary pwgc-search-results-send-email-cancel-button"><?php esc_html_e( 'Cancel', 'pw-woocommerce-gift-cards' ); ?></a>
    </div>
</form>