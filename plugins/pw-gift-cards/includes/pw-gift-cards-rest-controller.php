<?php

defined( 'ABSPATH' ) or exit;

class PW_Gift_Cards_REST_Controller extends WP_REST_Controller {

    protected $namespace = 'wc-pimwick/v1';

    protected $rest_base = 'pw-gift-cards';

    public function register_routes() {

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/schema',
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => array( $this, 'get_public_item_schema' ),
                'permission_callback' => array( $this, 'get_item_permissions_check' ),
            )
        );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            array(
                array(
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'get_items' ),
                    'permission_callback' => array( $this, 'get_items_permissions_check' ),
                    'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::READABLE ),
                ),
                array(
                    'methods'             => WP_REST_Server::CREATABLE,
                    'callback'            => array( $this, 'create_item' ),
                    'permission_callback' => array( $this, 'create_item_permissions_check' ),
                    'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::CREATABLE ),
                ),
                'schema' => array( $this, 'get_public_item_schema' ),
            )
        );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)',
            array(
                'args'   => array(
                    'id' => array(
                        'description' => __( 'Unique identifier for the gift card.', 'pw-woocommerce-gift-cards' ),
                        'type'        => 'integer',
                    ),
                ),
                array(
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'get_item' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::READABLE ),
                ),
                array(
                    'methods'             => WP_REST_Server::EDITABLE,
                    'callback'            => array( $this, 'update_item' ),
                    'permission_callback' => array( $this, 'update_item_permissions_check' ),
                    'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::EDITABLE ),
                ),
                array(
                    'methods'             => WP_REST_Server::DELETABLE,
                    'callback'            => array( $this, 'delete_item' ),
                    'permission_callback' => array( $this, 'delete_item_permissions_check' ),
                    'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::DELETABLE ),
                ),
                'schema' => array( $this, 'get_public_item_schema' ),
            )
        );
    }

    public function get_items( $request ) {
        global $wpdb;

        $params = $request->get_params();

        $number_where = '';
        $number = trim( $this->get_param_value( $params, 'number' ) );
        if ( !empty( $number ) ) {
            $number_where = 'AND gift_card.number = %s';
        }

        $limit = absint( $this->get_param_value( $params, 'limit' ) );
        if ( empty( absint( $limit ) ) ) {
            $limit = PWGC_ADMIN_MAX_ROWS;
        }

        $order_sql = "gift_card.create_date";
        if ( strtoupper( $this->get_param_value( $params, 'orderby' ) ) == 'ACTIVITY' ) {
            $order_sql = 'last_activity';
        }

        $order = ( strtoupper( $this->get_param_value( $params, 'order' ) ) == 'ASC' ) ? 'ASC' : 'DESC';
        $order_sql .= " $order";

        $sql = "
            SELECT
                gift_card.*,
                (SELECT SUM(amount) FROM {$wpdb->pimwick_gift_card_activity} AS a WHERE a.pimwick_gift_card_id = gift_card.pimwick_gift_card_id) AS balance,
                (SELECT MAX(activity_date) FROM {$wpdb->pimwick_gift_card_activity} AS a WHERE a.pimwick_gift_card_id = gift_card.pimwick_gift_card_id) AS last_activity
            FROM
                `{$wpdb->pimwick_gift_card}` AS gift_card
            WHERE
                gift_card.active = true
                $number_where
            ORDER BY
                $order_sql,
                gift_card.pimwick_gift_card_id DESC
            LIMIT
                $limit
        ";
        if ( !empty( $number_where ) ) {
            $sql = $wpdb->prepare( $sql, $number );
        }

        $results = $wpdb->get_results( $sql );

        $data = array();

        if ( $results !== null ) {
            foreach ( $results as $row ) {
                $itemdata = $this->prepare_item_for_response( $row, $request );
                $data[] = $this->prepare_response_for_collection( $itemdata );
            }
        }

        $data = apply_filters( 'pwgc_rest_api_response_get_items', $data );

        return new WP_REST_Response( $data, 200 );
    }

    private function get_param_value( $params, $key ) {
        if ( !empty( $params ) && isset( $params[ $key ] ) ) {
            return $params[ $key ];
        }

        return false;
    }

    public function get_item( $request ) {
        $params = $request->get_params();

        $id = $this->get_param_value( $params, 'id' );
        $id = absint( $id );

        $gift_card = PW_Gift_Card::get_by_id( $id );

        if ( !empty( $gift_card ) ) {
            $data = $this->prepare_item_for_response( $gift_card, $request );
            $activity = $this->prepare_activity_for_response( $gift_card, $request );

            $data = array(
                'gift_card' => $data,
                'activity' => $activity,
            );

            $data = apply_filters( 'pwgc_rest_api_response_get_item', $data );

            return new WP_REST_Response( $data, 200 );
        } else {
            return new WP_Error( '001', __( 'Gift Card Not Found', 'pw-woocommerce-gift-cards' ) );
        }
    }

    public function create_item( $request ) {
        global $pw_gift_cards;
        global $pw_gift_card_design_id;

        $params = $request->get_params();

        $number                     = isset( $params['number'] ) ? trim( wc_clean( $this->get_param_value( $params, 'number' ) ) ) : null;
        $quantity                   = isset( $params['quantity'] ) ? absint( $this->get_param_value( $params, 'quantity' ) ) : 1;
        $amount                     = isset( $params['amount'] ) ? floatval( $pw_gift_cards->sanitize_amount( $this->get_param_value( $params, 'amount' ) ) ) : null;
        $expiration_date            = isset( $params['expiration_date'] ) ? trim( wc_clean( $this->get_param_value( $params, 'expiration_date' ) ) ) : null;
        $send_email                 = isset( $params['send_email'] ) ? boolval( $this->get_param_value( $params, 'send_email' ) ) : null;
        $recipient_email            = isset( $params['recipient_email'] ) ? wc_clean( $this->get_param_value( $params, 'recipient_email' ) ) : null;
        $recipient_name             = isset( $params['recipient_name'] ) ? wc_clean( $this->get_param_value( $params, 'recipient_name' ) ) : null;
        $from                       = isset( $params['from'] ) ? wc_clean( $this->get_param_value( $params, 'from' ) ) : null;
        $message                    = isset( $params['message'] ) ? wc_clean( $this->get_param_value( $params, 'message' ) ) : null;
        $note                       = isset( $params['note'] ) ? wc_clean( $this->get_param_value( $params, 'note' ) ) : null;
        $pw_gift_card_design_id     = isset( $params['design_id'] ) ? absint( $this->get_param_value( $params, 'design_id' ) ) : null;
        $product_id                 = isset( $params['product_id'] ) ? absint( $this->get_param_value( $params, 'product_id' ) ) : null;
        $variation_id               = isset( $params['variation_id'] ) ? absint( $this->get_param_value( $params, 'variation_id' ) ) : null;
        $order_item_id              = isset( $params['order_item_id'] ) ? absint( $this->get_param_value( $params, 'order_item_id' ) ) : null;

        if ( !empty( $expiration_date ) ) {
            $date_array = date_parse( $expiration_date );
            if ( $date_array !== false ) {
                $expiration_date = date('Y-m-d H:i:s', mktime( $date_array['hour'], $date_array['minute'], $date_array['second'], $date_array['month'], $date_array['day'], $date_array['year'] ));
            }
        }

        $gift_cards = array();

        if ( !empty( $number ) ) {
            $existing = new PW_Gift_Card( $number );
            if ( !$existing->get_id() ) {
                $gift_cards[] = PW_Gift_Card::add_card( $number, $note );
            } else {
                // translators: %s is the gift card number.
                return new WP_Error( '003', sprintf( __( 'Gift Card Number %s already exists.', 'pw-woocommerce-gift-cards' ), $number ) );
            }
        } else {
            for ( $x = 0; $x < max( $quantity, 1 ); $x++ ) {
                $gift_cards[] = PW_Gift_Card::create_card( $note );
            }
        }

        foreach ( $gift_cards as $gift_card ) {
            if ( !empty( $amount ) && $amount > 0 ) {
                $gift_card->credit( $amount );
            }

            $gift_card->set_expiration_date( $expiration_date, true );
            $gift_card->set_recipient_email( $recipient_email, true );
            $gift_card->set_recipient_name( $recipient_name, true );
            $gift_card->set_from( $from, true );
            $gift_card->set_message( $message, true );
            $gift_card->set_email_design_id( $pw_gift_card_design_id, true );
            $gift_card->set_product_id( $product_id, true );
            $gift_card->set_variation_id( $variation_id, true );
            $gift_card->set_order_item_id( $order_item_id, true );

            $gift_cards[] = $gift_card;

            if ( $send_email ) {
                // Before the $message parameter was added, $note was used as the message of the email. For backwards compatibility,
                // if there is a $note set but no $message. Enable the PRIVATE_NOTES constant to prevent this behavior.
                $email_message = ( empty( $message ) && PWGC_REST_API_NOTES_ARE_MESSAGES ) ? $note : $message;

                $pw_gift_cards->set_current_currency_to_default();

                do_action( 'pw_gift_cards_send_email_manually', $gift_card->get_number(), $recipient_email, $from, $recipient_name, $email_message, $amount, '' );
            }

            $data = $this->prepare_item_for_response( $gift_card, $request );
            $activity = $this->prepare_activity_for_response( $gift_card, $request );

            $data = array(
                'gift_card' => $data,
                'activity' => $activity,
            );

            $results[] = apply_filters( 'pwgc_rest_api_response_create_item', $data );
        }

        return new WP_REST_Response( $results, 200 );
    }

    public function update_item( $request ) {
        global $pw_gift_cards;
        global $pw_gift_card_design_id;

        $params = $request->get_params();

        $number                     = isset( $params['number'] ) ? trim( wc_clean( $this->get_param_value( $params, 'number' ) ) ) : null;
        $amount                     = isset( $params['amount'] ) ? floatval( $pw_gift_cards->sanitize_amount( $this->get_param_value( $params, 'amount' ) ) ) : null;
        $balance                    = isset( $params['balance'] ) ? floatval( $pw_gift_cards->sanitize_amount( $this->get_param_value( $params, 'balance' ) ) ) : null;
        $expiration_date            = isset( $params['expiration_date'] ) ? trim( wc_clean( $this->get_param_value( $params, 'expiration_date' ) ) ) : null;
        $send_email                 = isset( $params['send_email'] ) ? boolval( $this->get_param_value( $params, 'send_email' ) ) : null;
        $recipient_email            = isset( $params['recipient_email'] ) ? wc_clean( $this->get_param_value( $params, 'recipient_email' ) ) : null;
        $recipient_name             = isset( $params['recipient_name'] ) ? wc_clean( $this->get_param_value( $params, 'recipient_name' ) ) : null;
        $from                       = isset( $params['from'] ) ? wc_clean( $this->get_param_value( $params, 'from' ) ) : null;
        $message                    = isset( $params['message'] ) ? wc_clean( $this->get_param_value( $params, 'message' ) ) : null;
        $note                       = isset( $params['note'] ) ? wc_clean( $this->get_param_value( $params, 'note' ) ) : null;
        $pw_gift_card_design_id     = isset( $params['design_id'] ) ? absint( $this->get_param_value( $params, 'design_id' ) ) : null;
        $product_id                 = isset( $params['product_id'] ) ? absint( $this->get_param_value( $params, 'product_id' ) ) : null;
        $variation_id               = isset( $params['variation_id'] ) ? absint( $this->get_param_value( $params, 'variation_id' ) ) : null;
        $order_item_id              = isset( $params['order_item_id'] ) ? absint( $this->get_param_value( $params, 'order_item_id' ) ) : null;
        $active                     = isset( $params['active'] ) ? boolval( $this->get_param_value( $params, 'active' ) ) : null;


        $id = $this->get_param_value( $params, 'id' );
        $id = absint( $id );

        $gift_card = PW_Gift_Card::get_by_id( $id );
        if ( empty( $gift_card ) ) {
            return new WP_Error( '001', __( 'Gift Card Not Found', 'pw-woocommerce-gift-cards' ) );
        }

        if ( !is_null( $number ) && !$gift_card->set_number( $number, true ) ) {
            return new WP_Error( '003', sprintf( __( 'Gift Card Number %s already exists.', 'pw-woocommerce-gift-cards' ), $number ) );
        }

        if ( !is_null( $balance ) ) {
            if ( $balance >= 0 ) {
                $adjustment_amount = $balance - $gift_card->get_balance();
                if ( $adjustment_amount != 0 ) {
                    $gift_card->adjust_balance( $adjustment_amount, $note );
                }
            } else {
                return new WP_Error( '004', __( 'Balance must be zero or greater.', 'pw-woocommerce-gift-cards' ) );
            }

        } else {
            if ( !empty( $amount ) || ( is_null( $active ) && !empty( $note ) ) ) {
                $gift_card->adjust_balance( $amount, $note );
            }
        }

        if ( !is_null( $expiration_date ) ) {
            if ( empty( $expiration_date ) ) {
                $gift_card->set_expiration_date( null );
            } else {
                $date_array = date_parse( $expiration_date );
                if ( $date_array !== false ) {
                    $expiration_date = date('Y-m-d H:i:s', mktime( $date_array['hour'], $date_array['minute'], $date_array['second'], $date_array['month'], $date_array['day'], $date_array['year'] ));
                    $gift_card->set_expiration_date( $expiration_date );
                } else {
                    return new WP_Error( '002', __( 'Unable to parse expiration date.', 'pw-woocommerce-gift-cards' ) );
                }
            }
        }

        $gift_card->set_recipient_email( $recipient_email, true );
        $gift_card->set_recipient_name( $recipient_name, true );
        $gift_card->set_from( $from, true );
        $gift_card->set_message( $message, true );
        $gift_card->set_email_design_id( $pw_gift_card_design_id, true );
        $gift_card->set_product_id( $product_id, true );
        $gift_card->set_variation_id( $variation_id, true );
        $gift_card->set_order_item_id( $order_item_id, true );

        // To reactivate a card, set the 'active' flag to a true value.
        if ( !is_null( $active ) ) {
            if ( $active ) {
                $gift_card->reactivate( $note );
            } else {
                $gift_card->deactivate( $note );
            }
        }

        if ( $send_email ) {
            $pw_gift_card_design_id = $gift_card->get_email_design_id();

            $pw_gift_cards->set_current_currency_to_default();

            do_action( 'pw_gift_cards_send_email_manually', $gift_card->get_number(), $gift_card->get_recipient_email(), $gift_card->get_from(), $gift_card->get_recipient_name(), $gift_card->get_message(), $gift_card->get_balance(), '' );
        }

        return $this->get_item( $request );
    }

    public function delete_item( $request ) {
        global $pw_gift_cards;

        $params = $request->get_params();

        $id = $this->get_param_value( $params, 'id' );
        $id = absint( $id );

        $gift_card = PW_Gift_Card::get_by_id( $id );

        if ( !empty( $gift_card ) ) {
            if ( isset( $params['force'] ) && boolval( $params['force'] ) ) {
                $gift_card->delete();
                $data = array(
                    'number' => $gift_card->get_number(),
                    'deleted' => true,
                );

                $data = apply_filters( 'pwgc_rest_api_response_update_item', $data );

                return new WP_REST_Response( $data, 200 );
            } else {
                $gift_card->deactivate();
                return $this->get_item( $request );
            }
        } else {
            return new WP_Error( '001', __( 'Gift Card Not Found', 'pw-woocommerce-gift-cards' ) );
        }
    }

    public function get_endpoint_args_for_item_schema( $method = WP_REST_Server::CREATABLE ) {
        $args = array();

        switch ( $method ) {
            case WP_REST_Server::READABLE:
                $args = array(
                    'number' => array(
                        'type'          => 'string',
                        'description'   => __( 'The specific gift card number to retrieve.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'limit' => array(
                        'type'          => 'numeric',
                        // translators: %s is the default maximum number of rows.
                        'description'   => sprintf( __( 'The number of gift cards to retrieve. Default is %s', 'pw-woocommerce-gift-cards' ), PWGC_ADMIN_MAX_ROWS ),
                    ),
                    'order' => array(
                        'type'          => 'string',
                        // translators: %s is the default maximum number of rows.
                        'description'   => __( 'Sort the results ASC or DESC. Default is DESC', 'pw-woocommerce-gift-cards' ),
                    ),
                    'orderby' => array(
                        'type'          => 'string',
                        // translators: %s is the default maximum number of rows.
                        'description'   => __( 'Options are CREATED (to sort by the gift card create date) or ACTIVITY (to sort by the last gift card activity). Default is CREATED', 'pw-woocommerce-gift-cards' ),
                    ),
                );
            break;

            case WP_REST_Server::CREATABLE:
                $args = array(
                    'number' => array(
                        'type'          => 'string',
                        'description'   => __( 'The gift card number. Must not exist in the database already.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'quantity' => array(
                        'default'       => 1,
                        'type'          => 'numeric',
                        'description'   => __( 'The number of gift cards to generate. Ignored if the "number" parameter has a value.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'amount' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'Initial gift card balance.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'expiration_date' => array(
                        'type'          => 'date',
                        'description'   => __( 'The expiration date for the gift card.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'send_email' => array(
                        'type'          => 'boolean',
                        'description'   => __( 'Set to a true value to email the gift card to the recipient_email specified.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'recipient_email' => array(
                        'type'          => 'string',
                        'description'   => __( 'The email address that will receive the gift card.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'recipient_name' => array(
                        'type'          => 'string',
                        'description'   => __( 'The friendly name of the recipient of the gift card. Shown on the gift card email.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'from' => array(
                        'type'          => 'string',
                        'description'   => __( 'The friendly name of the person who sent the gift card to the recipient.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'message' => array(
                        'type'          => 'string',
                        'description'   => __( 'The body of the message added to the email.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'note' => array(
                        'type'          => 'string',
                        'description'   => __( 'Adds a note to the gift card activity record when the gift card is created.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'design_id' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'The database ID of the Email Design to use when sending the gift card.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'product_id' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'The originating product_id to use for this gift card. Used for redemption validation.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'variation_id' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'The originating variation_id to use for this gift card. Used for redemption validation.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'order_item_id' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'The originating order_item_id to use for this gift card. Used for record keeping purposes.', 'pw-woocommerce-gift-cards' ),
                    ),
                );
            break;

            case WP_REST_Server::EDITABLE:
                $args = array(
                    'number' => array(
                        'type'          => 'string',
                        'description'   => __( 'Changes the gift card number to this value. Must not exist in the database already.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'amount' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'Balance adjustment amount. Can be positive or negative.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'balance' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'Set the balance to a specific value. This will add a transaction for the appropriate amount to set the balance to this value.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'expiration_date' => array(
                        'type'          => 'date',
                        'description'   => __( 'The expiration date for the gift card. Send an empty value to clear the expiration date.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'send_email' => array(
                        'type'          => 'boolean',
                        'description'   => __( 'Set to a true value to email the gift card to the recipient_email specified.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'recipient_email' => array(
                        'type'          => 'string',
                        'description'   => __( 'The email address that will receive the gift card.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'recipient_name' => array(
                        'type'          => 'string',
                        'description'   => __( 'The friendly name of the recipient of the gift card. Shown on the gift card email.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'from' => array(
                        'type'          => 'string',
                        'description'   => __( 'The friendly name of the person who sent the gift card to the recipient.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'message' => array(
                        'type'          => 'string',
                        'description'   => __( 'The body of the message added to the email.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'note' => array(
                        'type'          => 'string',
                        'description'   => __( 'Adds a note to the gift card activity record.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'design_id' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'The database ID of the Email Design to use when sending the gift card.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'product_id' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'The originating product_id to use for this gift card. Used for redemption validation.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'variation_id' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'The originating variation_id to use for this gift card. Used for redemption validation.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'order_item_id' => array(
                        'type'          => 'numeric',
                        'description'   => __( 'The originating order_item_id to use for this gift card. Used for record keeping purposes.', 'pw-woocommerce-gift-cards' ),
                    ),
                    'active' => array(
                        'type'          => 'boolean',
                        'description'   => __( 'Send a true value to deactivate the gift card. Send a false value to reactivate a previously deactivated gift card.', 'pw-woocommerce-gift-cards' ),
                    ),
                );
            break;

            case WP_REST_Server::DELETABLE:
                $args = array(
                    'force' => array(
                        'default'     => false,
                        'type'        => 'boolean',
                        'description' => __( 'Whether to bypass trash and force deletion.', 'pw-woocommerce-gift-cards' ),
                    ),
                );
            break;
        }

        return $args;
    }

    public function get_items_permissions_check( $request ) {
        return wc_rest_check_post_permissions( 'product', 'read' );
    }

    public function get_item_permissions_check( $request ) {
        return $this->get_items_permissions_check( $request );
    }

    public function create_item_permissions_check( $request ) {
        return $this->get_items_permissions_check( $request );
    }

    public function update_item_permissions_check( $request ) {
        return $this->get_items_permissions_check( $request );
    }

    public function delete_item_permissions_check( $request ) {
        return $this->get_items_permissions_check( $request );
    }

    protected function prepare_item_for_database( $request ) {
        return array();
    }

    public function prepare_item_for_response( $item, $request ) {
        if ( is_a( $item, 'PW_Gift_Card' ) ) {
            return array(
                'pimwick_gift_card_id'      => $item->get_id(),
                'number'                    => $item->get_number(),
                'active'                    => $item->get_active(),
                'create_date'               => $item->get_create_date() ,
                'expiration_date'           => $item->get_expiration_date(),
                'pimwick_gift_card_parent'  => $item->get_pimwick_gift_card_parent(),
                'recipient_email'           => $item->get_recipient_email(),
                'recipient_name'            => $item->get_recipient_name(),
                'from'                      => $item->get_from(),
                'message'                   => $item->get_message(),
                'delivery_date'             => $item->get_delivery_date(),
                'email_design_id'           => $item->get_email_design_id(),
                'product_id'                => $item->get_product_id(),
                'variation_id'              => $item->get_variation_id(),
                'order_item_id'             => $item->get_order_item_id(),
                'balance'                   => $item->get_balance(),
            );
        } else {
            return $item;
        }
    }

    public function prepare_activity_for_response( $gift_card, $request ) {
        if ( is_a( $gift_card, 'PW_Gift_Card' ) ) {

            $activity = array();

            foreach ( $gift_card->get_activity() as $record ) {
                $activity[] = array(
                    'pimwick_gift_card_activity_id' => $record->pimwick_gift_card_activity_id,
                    'activity_date'                 => $record->activity_date,
                    'action'                        => $record->action,
                    'user'                          => $record->user,
                    'user_email'                    => $record->user_email,
                    'amount'                        => $record->amount,
                    'note'                          => $record->note,
                );
            }

            return $activity;
        }

        return array();
    }
}
