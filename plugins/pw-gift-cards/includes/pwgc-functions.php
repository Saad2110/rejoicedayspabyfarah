<?php

defined( 'ABSPATH' ) or exit;

if ( ! function_exists( 'pwgc_log' ) ) {
    function pwgc_log( $message ) {
        $log = new WC_Logger();
        $log->info( $message, array( 'source' => 'pw-woocommerce-gift-cards' ) );
    }
}

if ( ! function_exists( 'pwgc_add_gift_card_to_order' ) ) {
    function pwgc_add_gift_card_to_order( $order_item_id, $credit_amount, $product, $create_note, $credit_note ) {

        do_action( 'pwgc_before_add_gift_card_to_order', $order_item_id, $credit_amount, $product, $create_note, $credit_note );

        $gift_card = PW_Gift_Card::create_card( $create_note );

        if ( ! is_a( $gift_card, 'PW_Gift_Card' ) ) {
            if ( is_string( $gift_card ) ) {
                throw new Exception( __( 'Error while creating gift card: ' . $gift_card ) );
            } else {
                throw new Exception( __( 'Unknown error while creating gift card.' ) );
            }
        }

        $gift_card->credit( $credit_amount, $credit_note );

        $expiration_date = '';
        $expires_in_days = absint( $product->get_pwgc_expire_days() );
        if ( $expires_in_days > 0 ) {
            $expiration_date = current_time( 'Y-m-d' ) . " +$expires_in_days days";
        }

        $expiration_date = apply_filters( 'pwgc_generated_expiration_date', $expiration_date, $gift_card, $order_item_id, $credit_amount, $product );
        if ( !empty( $expiration_date ) && strtotime( $expiration_date ) !== false ) {
            $gift_card->set_expiration_date( date( 'Y-m-d', strtotime( $expiration_date ) ) );
        }


        wc_add_order_item_meta( $order_item_id, PWGC_GIFT_CARD_NUMBER_META_KEY, $gift_card->get_number() );

        // The recipient_email property is intentionally deferred until the email is actually delivered.
        //   $gift_card->set_recipient_email( wc_get_order_item_meta( $order_item_id, PWGC_TO_META_KEY ) );
        $gift_card->set_recipient_name( wc_get_order_item_meta( $order_item_id, PWGC_RECIPIENT_NAME_META_KEY ) );
        $gift_card->set_from( wc_get_order_item_meta( $order_item_id, PWGC_FROM_META_KEY ) );
        $gift_card->set_message( wc_get_order_item_meta( $order_item_id, PWGC_MESSAGE_META_KEY ) );
        $gift_card->set_delivery_date( wc_get_order_item_meta( $order_item_id, PWGC_DELIVERY_DATE_META_KEY ) );
        $gift_card->set_email_design_id( wc_get_order_item_meta( $order_item_id, PWGC_EMAIL_DESIGN_ID_META_KEY ) );
        $gift_card->set_product_id( wc_get_order_item_meta( $order_item_id, '_product_id' ) );
        $gift_card->set_variation_id( wc_get_order_item_meta( $order_item_id, '_variation_id' ) );
        $gift_card->set_order_item_id( $order_item_id );

        do_action( 'pwgc_after_add_gift_card_to_order', $order_item_id, $credit_amount, $product, $create_note, $credit_note, $gift_card->get_number() );

        return $gift_card;
    }
}

if ( ! function_exists( 'pwgc_is_first_gift_card' ) ) {
    function pwgc_is_first_gift_card( $items, $parameter_item ) {
        foreach ( $items as $item ) {
            if ( isset( $item['product_id'] ) ) {
                $product = wc_get_product( absint( $item['product_id'] ) );
                if ( is_a( $product, 'WC_Product_PW_Gift_Card' ) ) {
                    if ( $item == $parameter_item ) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }

        return false;
    }
}

if ( ! function_exists( 'pwgc_set_table_names' ) ) {
    function pwgc_set_table_names() {
        global $wpdb;

        if ( true === PWGC_MULTISITE_SHARED_DATABASE ) {
            $wpdb->pimwick_gift_card = $wpdb->base_prefix . 'pimwick_gift_card';
            $wpdb->pimwick_gift_card_activity = $wpdb->base_prefix . 'pimwick_gift_card_activity';
        } else {
            $wpdb->pimwick_gift_card = $wpdb->prefix . 'pimwick_gift_card';
            $wpdb->pimwick_gift_card_activity = $wpdb->prefix . 'pimwick_gift_card_activity';
        }
    }
}

if ( ! function_exists( 'pwgc_get_other_amount_prompt' ) ) {
    function pwgc_get_other_amount_prompt( $product ) {
        // If $product isn't a WooCommerce product, try and retrieve it.
        if ( !is_a( $product, 'WC_Product' ) ) {
            if ( is_numeric( $product ) ) {
                $product = wc_get_product( $product );
            } else if ( is_object( $product ) && property_exists( $product, 'ID' ) ) {
                $product = wc_get_product( $product->ID );
            } else {
                return PWGC_OTHER_AMOUNT_PROMPT;
            }
        }

        // We need to be working with a WooCommerce product.
        if ( !is_a( $product, 'WC_Product' ) ) {
            return PWGC_OTHER_AMOUNT_PROMPT;
        }

        // Make sure we have the parent product.
        if ( !empty( $product->get_parent_id() ) ) {
            $product = wc_get_product( $product->get_parent_id() );
        }

        // Only examine the Gift Card products.
        if ( is_a( $product, 'WC_Product_PW_Gift_Card' ) ) {
            $variations = array_map( 'wc_get_product', $product->get_children() );
            foreach ( $variations as $variation ) {
                if ( $variation && is_a( $variation, 'WC_Product' ) && $variation->get_price() == 0 ) {
                    $other_amount_prompt = $variation->get_attribute( PWGC_DENOMINATION_ATTRIBUTE_SLUG );
                    if ( !empty( $other_amount_prompt ) ) {
                        break;
                    }
                }
            }
        }

        if ( !empty( $other_amount_prompt ) ) {
            return $other_amount_prompt;
        } else {
            return PWGC_OTHER_AMOUNT_PROMPT;
        }
    }
}

if ( ! function_exists( 'pwgc_admin_page' ) ) {
    function pwgc_admin_page() {
        // If the Pimwick Plugins menu is hidden, we need to redirect to the WooCommerce menu instead.
        if ( get_option( 'hide_pimwick_menu', 'no' ) == 'no' ) {
            $page = 'pw-gift-cards';
        } else {
            $page = 'wc-pw-gift-cards';
        }

        return apply_filters( 'pwgc_admin_page', $page );
    }
}

if ( ! function_exists( 'pwgc_admin_url' ) ) {
    function pwgc_admin_url( $section = '', $args = false ) {

        $admin_url = admin_url( 'admin.php' );
        $admin_url = add_query_arg( 'page', pwgc_admin_page(), $admin_url );

        if ( !empty( $section ) ) {
            $admin_url = add_query_arg( 'section', $section, $admin_url );
        }

        if ( !empty( $args ) && is_array( $args ) ) {
            foreach ( $args as $key => $value ) {
                $admin_url = add_query_arg( $key, $value, $admin_url );
            }
        }

        return apply_filters( 'pwgc_admin_url', $admin_url, $section, $args );
    }
}

if ( ! function_exists( 'pwgc_redeem_url' ) ) {
    function pwgc_redeem_url( $item_data ) {

        if ( isset( $item_data->design ) && isset( $item_data->design['redeem_url'] ) && !empty( $item_data->design['redeem_url'] ) ) {
            $redeem_url = $item_data->design['redeem_url'];
        } else {
            $redeem_url = pwgc_default_redeem_url();
        }

        $redeem_url = add_query_arg( 'pw_gift_card_number', urlencode( $item_data->gift_card_number ), $redeem_url );

        return apply_filters( 'pwgc_redeem_url', $redeem_url, $item_data );
    }
}

if ( ! function_exists( 'pwgc_default_redeem_url' ) ) {
    function pwgc_default_redeem_url() {
        $redeem_url = get_option( 'pwgc_default_redeem_url', '' );
        if ( empty( $redeem_url ) ) {
            $redeem_url = pwgc_shop_url();
        }

        return $redeem_url;
    }
}

if ( ! function_exists( 'pwgc_shop_url' ) ) {
    function pwgc_shop_url() {
        $shop_url = get_permalink( wc_get_page_id( 'shop' ) );
        if ( empty( $shop_url ) ) {
           $shop_url = site_url();
        }

        return $shop_url;
    }
}

if ( ! function_exists( 'pwgc_get_qr_code_generate_url' ) ) {
    function pwgc_get_qr_code_generate_url( $gift_card_number, $design_id ) {
        $url = pwgc_shop_url();
        $url = add_query_arg( 'qr_code', '1', $url );
        $url = add_query_arg( 'pwgc_number', urlencode( $gift_card_number ), $url );
        $url = add_query_arg( 'design_id', absint( $design_id ), $url );

        return $url;
    }
}

if ( ! function_exists( 'pwgc_dashboard_helper' ) ) {
    // Optionally set the selected CSS for the appropriate section.
    function pwgc_dashboard_helper( $item, $output = 'pwgc-dashboard-item-selected' ) {
        $selected = false;
        if ( isset( $_REQUEST['section'] ) ) {
            $selected = ( $_REQUEST['section'] == $item );
        } else if ( $item == 'balances' ) {
            $selected = true;
        }

        echo ( $selected ) ? $output : '';
    }
}

if ( ! function_exists( 'pwgc_paypal_ipn_pdt_bug_exists' ) ) {
    function pwgc_paypal_ipn_pdt_bug_exists() {
        $bug_exists = false;
        $ipn_enabled = false;
        $pdt_enabled = false;
        $woocommerce_paypal_settings = get_option( 'woocommerce_paypal_settings' );

        if ( empty( $woocommerce_paypal_settings['ipn_notification'] ) || 'no' !== $woocommerce_paypal_settings['ipn_notification'] ) {
            $ipn_enabled = true;
        }

        if ( ! empty( $woocommerce_paypal_settings['identity_token'] ) ) {
            $pdt_enabled = true;
        }

        if ( $ipn_enabled && $pdt_enabled ) {
            $bug_exists = true;
        }

        return apply_filters( 'pwgc_paypal_ipn_pdt_bug_exists', $bug_exists );
    }
}

if ( !function_exists( 'pwgc_strtotime' ) ) {
    // Source: https://mediarealm.com.au/articles/wordpress-timezones-strtotime-date-functions/
    function pwgc_strtotime($str, $gmt = false) {
      // This function behaves a bit like PHP's StrToTime() function, but taking into account the Wordpress site's timezone
      // CAUTION: It will throw an exception when it receives invalid input - please catch it accordingly
      // From https://mediarealm.com.au/

      $tz_string = get_option('timezone_string');
      $tz_offset = get_option('gmt_offset', 0);

      if (function_exists('wp_timezone_string')) {
        $timezone = wp_timezone_string();
        if( !empty($timeZoneString)){
            $timezone = $timeZoneString;
        }else{
            $timezone = 'UTC';
        }
      } else {
          if (!empty($tz_string)) {
              // If site timezone option string exists, use it
              $timezone = $tz_string;

          } elseif ($tz_offset == 0) {
              // get UTC offset, if it isn’t set then return UTC
              $timezone = 'UTC';

          } else {
              $timezone = $tz_offset;

              if(substr($tz_offset, 0, 1) != "-" && substr($tz_offset, 0, 1) != "+" && substr($tz_offset, 0, 1) != "U") {
                  $timezone = "+" . $tz_offset;
              }
          }
      }

      $datetime = new DateTime($str);
      try {
          $datetime->setTimezone(new DateTimeZone($timezone));
      } catch ( Exception $ex ) {
          // set timezone to UTC in case current timezone throws an exception
          $timezone = 'UTC';
          $datetime->setTimezone(new DateTimeZone($timezone));
      }

      if ( $gmt ) {
          return ( $datetime->getTimestamp() + $datetime->getOffset() );
      } else {
          return $datetime->format('U');
      }
    }
}

if ( !function_exists( 'pwgc_delivery_date_to_time' ) ) {
    function pwgc_delivery_date_to_time( $delivery_date ) {

        $time = false;

        if ( !empty( $delivery_date ) ) {

            $format = get_option( 'pwgc_pikaday_format', 'YYYY-MM-DD' );

            if ( $format == 'YYYY-MM-DD') { @list( $year, $month, $day ) = explode( '-', $delivery_date ); }
            if ( $format == 'YYYY/MM/DD') { @list( $year, $month, $day ) = explode( '/', $delivery_date ); }
            if ( $format == 'YYYY.MM.DD') { @list( $year, $month, $day ) = explode( '.', $delivery_date ); }

            if ( $format == 'DD-MM-YYYY') { @list( $day, $month, $year ) = explode( '-', $delivery_date ); }
            if ( $format == 'DD/MM/YYYY') { @list( $day, $month, $year ) = explode( '/', $delivery_date ); }
            if ( $format == 'DD.MM.YYYY') { @list( $day, $month, $year ) = explode( '.', $delivery_date ); }

            if ( $format == 'MM-DD-YYYY') { @list( $month, $day, $year ) = explode( '-', $delivery_date ); }
            if ( $format == 'MM/DD/YYYY') { @list( $month, $day, $year ) = explode( '/', $delivery_date ); }
            if ( $format == 'MM.DD.YYYY') { @list( $month, $day, $year ) = explode( '.', $delivery_date ); }

            if ( isset( $month ) && isset( $day ) && isset( $year ) ) {
                $time = mktime( 0, 0, 0, $month, $day, $year );
            } else {
                if ( (bool) strtotime( $delivery_date ) ) {
                    $time = strtotime( $delivery_date );
                }
            }
        }

        return $time;
    }
}

if ( !function_exists( 'pwgc_view_email_url' ) ) {
    function pwgc_view_email_url( $args = array() ) {

        // Ensure we always have at least 1 argument to
        // make it easier to append arguments in the JS.
        $args = array( 'pwgc' => time() ) + $args;

        // Build the URL using the arguments.
        $url = add_query_arg( $args, get_home_url() );

        return apply_filters( 'pwgc_view_email_url', $url, $args );
    }
}

if ( !function_exists( 'pwgc_get_example_gift_card_number' ) ) {
    function pwgc_get_example_gift_card_number() {
        return apply_filters( 'pwgc_example_gift_card_number', '1234-WXYZ-5678-ABCD' );
    }
}

if ( ! function_exists( 'pwgc_get_all_gift_card_products' ) ) {
    function pwgc_get_all_gift_card_products() {
        return wc_get_products( array(
            'type' => PWGC_PRODUCT_TYPE_SLUG,
            'limit' => -1,
            'orderby' => 'name',
            'order' => 'ASC',
            'status' => 'publish',
        ) );
    }
}

if ( ! function_exists( 'pwgc_get_gift_card_product' ) ) {
    function pwgc_get_gift_card_product() {
        $query = new WC_Product_Query( array(
            'type' => PWGC_PRODUCT_TYPE_SLUG,
            'limit' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'status' => 'publish',
        ) );
        $products = $query->get_products();

        if ( !empty( $products ) ) {
            return $products[0];
        } else {
            return null;
        }
    }
}

if ( ! function_exists( 'pwgc_get_balance_page' ) ) {
    function pwgc_get_balance_page() {
        global $wpdb;

        $balance_page = null;

        $balance_page_slug = get_option( 'pwgc_balance_page_slug' );
        if ( !empty( $balance_page_slug ) ) {
            $balance_page = get_page_by_path( $balance_page_slug );
        } else {
            $results = $wpdb->get_row( "
                SELECT
                    post.ID AS post_id
                FROM
                    {$wpdb->posts} AS post
                WHERE
                    post.post_status = 'publish'
                    AND post.post_type = 'page'
                    AND post.post_content LIKE '%[" . PWGC_BALANCE_SHORTCODE . "]%'
                ORDER BY
                    post.post_date DESC
                LIMIT 1
            " );
            if ( $results ) {
                $balance_page = get_page( $results->post_id );
            }
        }

        return apply_filters( 'pwgc_balance_page', $balance_page );
    }
}

if ( ! function_exists( 'pwgc_get_users_ip' ) ) {
    function pwgc_get_users_ip() {
        if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
