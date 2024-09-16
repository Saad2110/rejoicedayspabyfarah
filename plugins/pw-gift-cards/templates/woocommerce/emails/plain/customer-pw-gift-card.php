<?php

global $pw_gift_cards;

echo $email_heading . "\n\n";

// translators: %s is the store name (blog name)
echo sprintf( __( '%s Gift Card', 'pw-woocommerce-gift-cards' ), get_option( 'blogname' ) ) . "\n";

// translators: %s is the gift card amount.
echo sprintf( __( 'Amount: %s', 'pw-woocommerce-gift-cards' ), $pw_gift_cards->pretty_price( $item_data->amount ) ) . "\n";

// translators: %s is the gift card number.
echo sprintf( __( 'Gift card number: %s', 'pw-woocommerce-gift-cards' ), $item_data->gift_card_number ) . "\n";

// translators: %s is the link to redeem the gift card.
echo sprintf( __( 'Link: %s', 'pw-woocommerce-gift-cards' ), pwgc_redeem_url( $item_data ) ) . "\n";

if ( !empty( $item_data->message ) ) {
    echo "\n";
    echo __( 'Message:', 'pw-woocommerce-gift-cards' ) . "\n";
    echo $item_data->message . "\n";
    echo "\n";
}

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
