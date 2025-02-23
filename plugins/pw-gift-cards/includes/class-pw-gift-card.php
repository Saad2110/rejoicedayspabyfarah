<?php

defined( 'ABSPATH' ) or exit;

if ( ! class_exists( 'PW_Gift_Card' ) ) :

class PW_Gift_Card {

    /*
     *
     * Properties
     *
     */
    public function get_id() { return $this->pimwick_gift_card_id; }
    private $pimwick_gift_card_id;

    public function get_number() { return $this->number; }
    public function set_number( $number, $skip_if_null = false ) {
        // Check for duplicate before changing the number
        $existing = new PW_Gift_Card( $number );
        if ( !$existing->get_id() ) {
            $old_number = $this->get_number();
            $this->update_property( 'number', $number, $skip_if_null );
            // translators: %1$s is the previous gift card number and %2$s is the new gift card number.
            $this->add_note( sprintf( __( 'Number changed from %1$s to %2$s', 'pw-woocommerce-gift-cards' ), $old_number, $number ) );
            return true;
        } else {
            return false;
        }
    }
    private $number;

    public function get_active() { return $this->active; }
    private $active;

    public function get_create_date() { return $this->create_date; }
    private $create_date;

    public function get_expiration_date() { return $this->expiration_date; }
    public function set_expiration_date( $expiration_date, $skip_if_null = false ) {
        if ( 'no' === get_option( 'pwgc_no_expiration_date', 'no' ) ) {
            $this->update_property( 'expiration_date', $expiration_date, $skip_if_null );
        }
    }
    private $expiration_date;

    public function get_pimwick_gift_card_parent() { return $this->pimwick_gift_card_parent; }
    public function set_pimwick_gift_card_parent( $pimwick_gift_card_parent, $skip_if_null = false ) { $this->update_property( 'pimwick_gift_card_parent', $pimwick_gift_card_parent, $skip_if_null ); }
    private $pimwick_gift_card_parent;

    public function get_recipient_email() { return $this->recipient_email; }
    public function set_recipient_email( $recipient_email, $skip_if_null = false  ) { $this->update_property( 'recipient_email', $recipient_email, $skip_if_null ); }
    private $recipient_email;

    public function get_recipient_name() { return $this->recipient_name; }
    public function set_recipient_name( $recipient_name, $skip_if_null = false  ) { $this->update_property( 'recipient_name', $recipient_name, $skip_if_null ); }
    private $recipient_name;

    public function get_from() { return $this->from; }
    public function set_from( $from, $skip_if_null = false  ) { $this->update_property( 'from', $from, $skip_if_null ); }
    private $from;

    public function get_message() { return $this->message; }
    public function set_message( $message, $skip_if_null = false  ) { $this->update_property( 'message', $message, $skip_if_null ); }
    private $message;

    public function get_delivery_date() { return $this->delivery_date; }
    public function set_delivery_date( $delivery_date, $skip_if_null = false  ) { $this->update_property( 'delivery_date', $delivery_date, $skip_if_null ); }
    private $delivery_date;

    public function get_email_design_id() { return $this->email_design_id; }
    public function set_email_design_id( $email_design_id, $skip_if_null = false  ) { $this->update_property( 'email_design_id', $email_design_id, $skip_if_null ); }
    private $email_design_id;

    public function get_product_id() { return $this->product_id; }
    public function set_product_id( $product_id, $skip_if_null = false  ) { $this->update_property( 'product_id', $product_id, $skip_if_null ); }
    private $product_id;

    public function get_variation_id() { return $this->variation_id; }
    public function set_variation_id( $variation_id, $skip_if_null = false  ) { $this->update_property( 'variation_id', $variation_id, $skip_if_null ); }
    private $variation_id;

    public function get_order_item_id() { return $this->order_item_id; }
    public function set_order_item_id( $order_item_id, $skip_if_null = false  ) { $this->update_property( 'order_item_id', $order_item_id, $skip_if_null ); }
    private $order_item_id;

    public function get_error_message() { return $this->error_message; }
    private $error_message;


    /*
     * Private properties.
     */
    private $product;
    private $variation;
    private $ineligible_product_ids;
    private $ineligible_product_categories;
    private $eligible_product_ids;
    private $eligible_product_categories;
    private $exclude_shipping;
    private $exclude_tax;
    private $balance_cache = false;

    function __construct( $data ) {
        if ( is_object( $data ) && $this->load_gift_card_data( $data ) ) {
            return;
        }

        $number = wc_clean( $data );
        if ( !empty( $number ) ) {

            $loaded = $this->get_gift_card( $number );

            // Fix for gift card numbers that contain a backslash.
            if ( !$loaded ) {
                $loaded = $this->get_gift_card( stripslashes( $number ) );
            }

            if ( !$loaded ) {
                $this->error_message = __( 'Card number does not exist.', 'pw-woocommerce-gift-cards' );
            }
        } else {
            $this->error_message = __( 'Enter a card number.', 'pw-woocommerce-gift-cards' );
        }
    }

    function get_gift_card( $number ) {
        global $wpdb;

        $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `{$wpdb->pimwick_gift_card}` WHERE `number` = %s", $number ) );
        if ( $result !== null ) {
            $this->load_gift_card_data( $result );
            return true;
        }

        if ( 'yes' !== get_option( 'pwgc_strict_input', 'yes' ) ) {
            $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `{$wpdb->pimwick_gift_card}` WHERE REPLACE(`number`, '-', '') = %s", str_replace( '-', '', $number ) ) );
            if ( $result !== null ) {
                $this->load_gift_card_data( $result );
                return true;
            }
        }

        return false;
    }

    function load_gift_card_data( $row ) {
        if ( property_exists( $row, 'pimwick_gift_card_id' ) ) {
            $this->pimwick_gift_card_id     = $row->pimwick_gift_card_id;
            $this->number                   = $row->number;
            $this->active                   = $row->active;
            $this->create_date              = $row->create_date;
            $this->expiration_date          = $row->expiration_date;
            $this->pimwick_gift_card_parent = $row->pimwick_gift_card_parent;
            $this->recipient_email          = $row->recipient_email;
            $this->recipient_name           = $row->recipient_name;
            $this->from                     = $row->from;
            $this->message                  = $row->message;
            $this->delivery_date            = $row->delivery_date;
            $this->email_design_id          = $row->email_design_id;
            $this->product_id               = $row->product_id;
            $this->variation_id             = $row->variation_id;
            $this->order_item_id            = $row->order_item_id;

            if ( property_exists( $row, 'balance' ) ) {
                $this->balance_cache = $row->balance;
            }

            return true;
        }

        return false;
    }



    /*
     *
     * Public methods.
     *
     */
    public function get_expiration_date_html() {
        $expiration_date = $this->get_expiration_date();
        if ( !empty( $expiration_date ) ) {
            $html = date_i18n( wc_date_format(), strtotime( $expiration_date ) );
            if ( $this->has_expired() ) {
                $html .= '<div style="color: red; font-weight: 600;">' . __( 'Expired', 'pw-woocommerce-gift-cards' ) . '</div>';
            }
        } else {
            $html = __( 'None', 'pw-woocommerce-gift-cards' );
        }

        return $html;
    }

    public function has_expired() {
        if ( !empty( $this->get_expiration_date() ) ) {
            $expiration_date = strtotime( $this->get_expiration_date() );
            $todays_date = strtotime( current_time( 'Y-m-d' ) );
            return ( $expiration_date < $todays_date );
        } else {
            return false;
        }
    }

    public function get_balance( $force_refresh = false ) {
        global $wpdb;

        if ( $force_refresh || $this->balance_cache === false ) {
            $this->balance_cache = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(amount) FROM {$wpdb->pimwick_gift_card_activity} WHERE pimwick_gift_card_id = %d", $this->get_id() ) );

            if ( $this->balance_cache === null ) {
                $this->error_message = $wpdb->last_error;
            }
        }

        return $this->balance_cache;
    }

    public function get_activity() {
        global $wpdb;

        $results = $wpdb->get_results( $wpdb->prepare( "
            SELECT
                card.number AS card_number,
                card.pimwick_gift_card_parent AS pimwick_gift_card_parent,
                users.user_nicename AS user,
                users.user_email AS user_email,
                activity.pimwick_gift_card_activity_id,
                activity.activity_date,
                CONVERT_TZ( activity.activity_date, @@session.time_zone, '+00:00' ) AS activity_date_gmt,
                activity.action,
                activity.amount,
                activity.note
            FROM
                {$wpdb->pimwick_gift_card_activity} AS activity
            JOIN
                {$wpdb->pimwick_gift_card} AS card ON (card.pimwick_gift_card_id = activity.pimwick_gift_card_id)
            LEFT JOIN
                {$wpdb->users} AS users ON (users.ID = activity.user_id)
            WHERE
                activity.pimwick_gift_card_id = %d
            ORDER BY
                activity.pimwick_gift_card_activity_id DESC
        ", $this->get_id() ) );

        return $results;
    }

    private $original_order_item_id = 0;

    public function get_original_order_item_id() {
        global $wpdb;

        // Stored in the database table.
        if ( !empty( $this->order_item_id ) ) {
            return $this->order_item_id;
        }

        // Previously we had to look this up.
        if ( empty( $this->original_order_item_id ) ) {
            $sql = $wpdb->prepare( "
                SELECT
                    m.order_item_id
                FROM
                    {$wpdb->prefix}woocommerce_order_itemmeta AS m
                WHERE
                    m.meta_key = %s
                    AND m.meta_value = %s
                LIMIT 1
            ",
            PWGC_GIFT_CARD_NUMBER_META_KEY,
            $this->get_number() );

            $result = $wpdb->get_row( $sql );
            if ( $result ) {
                $this->original_order_item_id = $result->order_item_id;
            } else {
                $this->original_order_item_id = -9999;
            }
        }

        return apply_filters( 'pwgc_get_original_order_item_id', $this->original_order_item_id, $this );
    }

    public function get_original_order_item_meta_data( $meta_key ) {
        $order_item_id = $this->get_original_order_item_id();
        if ( $order_item_id > 0 ) {
            return wc_get_order_item_meta( $order_item_id, $meta_key );
        } else {
            return '';
        }
    }

    public function get_original_recipient() {
        return apply_filters( 'pwgc_get_original_recipient', $this->get_original_order_item_meta_data( PWGC_TO_META_KEY ), $this );
    }

    public function credit( $amount, $note = '' ) {
        $amount = floatval( $amount );
        if ( $amount < 0 ) {
            wp_die( __( 'Amount added should be greater than zero.', 'pw-woocommerce-gift-cards' ) );
        }

        if ( empty( $amount ) ) {
            return;
        }

        $this->adjust_balance( $amount, $note );
    }

    public function debit( $amount, $note = '' ) {
        $amount = floatval( $amount );
        if ( $amount >= 0 ) {
            wp_die( __( 'Amount deducted should be less than zero.', 'pw-woocommerce-gift-cards' ) );
        }
        $this->adjust_balance( $amount, $note );
    }

    public function adjust_balance( $amount, $note = '' ) {
        $amount = floatval( $amount );

        if ( !$this->active ) {
            wp_die( __( 'Unable to adjust balance, card is not active.', 'pw-woocommerce-gift-cards' ) );
        }

        if ( ( $this->get_balance() + $amount ) < 0 ) {
            $amount = $this->get_balance() * -1;
        }

        $this->balance_cache = false;

        $this->log_activity( 'transaction', $amount, $note );
    }

    public function add_note( $note ) {
        $this->log_activity( 'note', 0, $note );
    }

    public function deactivate( $note = '' ) {
        if ( $this->update_property( 'active', false ) === true ) {
            $this->log_activity( 'deactivate', null, $note );
        }
    }

    public function delete( $note = '' ) {
        global $wpdb;

        $wpdb->delete( $wpdb->pimwick_gift_card_activity, array( 'pimwick_gift_card_id' => $this->get_id() ) );
        $wpdb->delete( $wpdb->pimwick_gift_card, array( 'pimwick_gift_card_id' => $this->get_id() ) );

        do_action( 'pwgc_gift_card_deleted', $this, $note );
    }

    public function reactivate( $note = '' ) {
        if ( $this->update_property( 'active', true ) === true ) {
            $this->log_activity( 'reactivate', null, $note );
        }
    }

    public function check_balance_url() {
        global $pw_gift_cards;

        $check_balance_url = '';

        if ( is_admin() ) {
            $check_balance_url = pwgc_admin_url( 'balances', array( 'card_number' => $this->get_number() ) );
        } else {
            $balance_page = pwgc_get_balance_page();
            if ( !empty( $balance_page ) ) {
                $check_balance_url = add_query_arg( 'card_number', $this->get_number(), get_permalink( $balance_page ) );
            }
        }

        return $check_balance_url;
    }

    public function get_product() {
        if ( !isset( $this->product ) ) {
            if ( !empty( $this->get_variation_id() ) ) {
                $variation = wc_get_product( $this->get_variation_id() );
                if ( is_a( $variation, 'WC_Product_Variation' ) ) {
                    $this->product = wc_get_product( $variation->get_parent_id() );
                }
            }

            if ( !isset( $this->product ) && !empty( $this->get_product_id() ) ) {
                $this->product = wc_get_product( $this->get_product_id() );
            } else {
                $this->product = pwgc_get_gift_card_product();
            }
        }

        return $this->product;
    }

    public function get_variation() {
        if ( !isset( $this->variation ) ) {
            if ( !empty( $this->get_variation_id() ) ) {
                $variation = wc_get_product( $this->get_variation_id() );
                if ( is_a( $variation, 'WC_Product_Variation' ) ) {
                    $this->variation = $variation;
                    $this->product = wc_get_product( $this->variation->get_parent_id() );
                } else {
                    $this->variation = false;
                }
            } else {
                $this->variation = false;
            }
        }

        return $this->variation;
    }

    public function get_eligible_product_ids() {
        if ( !isset( $this->eligible_product_ids ) ) {
            $this->eligible_product_ids = $this->get_combined_product_variation_ids( 'get_pwgc_product_ids', '_pwgc_product_ids' );
        }

        return $this->eligible_product_ids;
    }

    public function get_ineligible_product_ids() {
        if ( !isset( $this->ineligible_product_ids ) ) {
            $this->ineligible_product_ids = $this->get_combined_product_variation_ids( 'get_pwgc_exclude_product_ids', '_pwgc_exclude_product_ids' );
        }

        return $this->ineligible_product_ids;
    }

    public function get_eligible_product_categories() {
        if ( !isset( $this->eligible_product_categories ) ) {
            $this->eligible_product_categories = $this->get_combined_product_variation_ids( 'get_pwgc_product_categories', '_pwgc_product_categories' );
        }

        return $this->eligible_product_categories;
    }

    public function get_ineligible_product_categories() {
        if ( !isset( $this->ineligible_product_categories ) ) {
            $this->ineligible_product_categories = $this->get_combined_product_variation_ids( 'get_pwgc_exclude_product_categories', '_pwgc_exclude_product_categories' );
        }

        return $this->ineligible_product_categories;
    }

    public function get_exclude_tax() {
        if ( !isset( $this->exclude_tax ) ) {
            $this->exclude_tax = false;

            if ( is_a( $this->get_product(), 'WC_Product_PW_Gift_Card' ) ) {
                if ( $this->get_product()->get_pwgc_exclude_tax() ) {
                    $this->exclude_tax = true;
                }
            }

            if ( is_a( $this->get_variation(), 'WC_Product_Variation' ) ) {
                if ( $this->get_variation()->get_meta( '_pwgc_exclude_tax' ) ) {
                    $this->exclude_tax = true;
                }
            }
        }

        return $this->exclude_tax;
    }

    public function get_exclude_shipping() {
        if ( !isset( $this->exclude_shipping ) ) {
            $this->exclude_shipping = false;

            if ( is_a( $this->get_product(), 'WC_Product_PW_Gift_Card' ) ) {
                if ( $this->get_product()->get_pwgc_exclude_shipping() ) {
                    $this->exclude_shipping = true;
                }
            }

            if ( is_a( $this->get_variation(), 'WC_Product_Variation' ) ) {
                if ( $this->get_variation()->get_meta( '_pwgc_exclude_shipping' ) ) {
                    $this->exclude_shipping = true;
                }
            }
        }

        return $this->exclude_shipping;
    }



    /*
     *
     * Static Methods
     *
     */
    public static function get_by_id( $id ) {
        global $wpdb;

        if ( !empty( absint( $id ) ) ) {
            $result = $wpdb->get_row( $wpdb->prepare( "SELECT `number` FROM `{$wpdb->pimwick_gift_card}` WHERE pimwick_gift_card_id = %d", absint( $id ) ) );
            if ( null !== $result ) {
                return new PW_Gift_Card( $result->number );
            }
        }

        return false;
    }

    public static function add_card( $number, $note = '' ) {
        global $wpdb;

        $number = wc_clean( $number );

        if ( empty( $number ) ) {
            return __( 'Card Number cannot be empty.', 'pw-woocommerce-gift-cards' );
        }

        $result = $wpdb->insert( $wpdb->pimwick_gift_card, array ( 'number' => $number ) );

        if ( $result !== false ) {
            if ( !empty( absint( $wpdb->insert_id ) ) ) {
                $gift_card = PW_Gift_Card::get_by_id( $wpdb->insert_id );
                if ( !empty( $gift_card ) ) {
                    $gift_card->log_activity( 'create', null, $note );
                    return $gift_card;
                } else {
                    // translators: %1$s is the number, %2$s is the database table name, %3$s is the inserted gift card id, and %4$s is the database error message.
                    return sprintf( __( 'Gift Card %1$s was inserted into table %2$s and received database id %3$s but it could not be retrieved. Last error: %4$s', 'pw-woocommerce-gift-cards' ), $number, $wpdb->pimwick_gift_card, $wpdb->insert_id, $wpdb->last_error );
                }
            } else {
                // translators: %1$s is the number, %2$s is the database table name, %3$s is the database error message.
                return sprintf( __( 'Gift Card %1$s could not be inserted into table %2$s. Last error: %3$s', 'pw-woocommerce-gift-cards' ), $number, $wpdb->pimwick_gift_card, $wpdb->last_error );
            }
        } else {
            return $wpdb->last_error;
        }

        return __( 'Unknown error in add_card method.', 'pw-woocommerce-gift-cards' );
    }

    public static function create_card( $note = '', $number = '' ) {
        // Failsafe. If we haven't generated a number after this many tries, throw an error.
        $attempts = 0;
        $max_attempts = 100;

        // Get a random Card Number and insert it. If the insertion fails, it is already in use.
        do {
            $attempts++;

            if ( empty( $number ) ) {
                $number = self::random_card_number();
            }

            $gift_card = PW_Gift_Card::add_card( $number, $note );

        } while ( !( $gift_card instanceof self ) && $attempts < $max_attempts );

        return $gift_card;
    }

    public static function random_card_number() {

        $card_number = '';

        for ( $section = 0; $section < PWGC_RANDOM_CARD_NUMBER_SECTIONS; $section++ ) {
            for ( $code = 0; $code < PWGC_RANDOM_CARD_NUMBER_SECTION_LENGTH; $code++ ) {
                $random = str_shuffle( PWGC_RANDOM_CARD_NUMBER_CHARSET );
                $card_number .= $random[0];
            }

            if ( $section + 1 < PWGC_RANDOM_CARD_NUMBER_SECTIONS ) {
                $card_number .= '-';
            }
        }

        return apply_filters( 'pw_gift_cards_random_card_number', $card_number );
    }


    /*
     *
     * Private methods
     *
     */
    private function update_property( $property, $value, $skip_if_null = false ) {
        global $wpdb;

        if ( $skip_if_null && is_null( $value ) ) {
            return;
        }

        if ( property_exists( $this, $property ) ) {
            if ( $this->{$property} != $value ) {
                $result = $wpdb->update( $wpdb->pimwick_gift_card, array ( $property => $value ), array( 'pimwick_gift_card_id' => $this->get_id() ) );

                if ( $result !== false ) {
                    $this->{$property} = $value;

                    do_action( 'pwgc_property_updated_' . $property, $this, $value );

                    return true;
                } else {
                    wp_die( $wpdb->last_error );
                }
            }

        } else {
            // translators: %1$s is the property name, %2$s is the class name.
            wp_die( sprintf( __( 'Property %1$s does not exist on %2$s', 'pw-woocommerce-gift-cards' ), $property, get_class() ) );
        }
    }

    private function log_activity( $action, $amount = null, $note = null, $reference_activity_id = null ) {
        PW_Gift_Card_Activity::record( $this->get_id(), $action, $amount, $note, $reference_activity_id );

        do_action( 'pwgc_activity_' . $action, $this, $amount, $note, $reference_activity_id );
    }

    private function get_combined_product_variation_ids( $product_property_name, $variation_meta_key ) {
        $combined_ids = array();

        if ( is_a( $this->get_product(), 'WC_Product_PW_Gift_Card' ) ) {
            $ids = $this->get_product()->{$product_property_name}();
            if ( is_array( $ids ) ) {
                $combined_ids = array_unique( array_merge( $combined_ids, $ids ), SORT_REGULAR );
            }
        }

        if ( is_a( $this->get_variation(), 'WC_Product_Variation' ) ) {
            $ids = $this->get_variation()->get_meta( $variation_meta_key );
            if ( is_array( $ids ) ) {
                $combined_ids = array_unique( array_merge( $combined_ids, $ids ), SORT_REGULAR );
            }
        }

        return $combined_ids;
    }
}

endif;
