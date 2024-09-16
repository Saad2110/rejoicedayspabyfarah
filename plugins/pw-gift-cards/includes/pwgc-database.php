<?php

defined( 'ABSPATH' ) or exit;

if ( ! class_exists( 'PWGC_Database' ) ) :

class PWGC_Database {

    function __construct() {
        add_action( 'plugins_loaded', array( $this, 'database_version_check' ) );
    }

    function database_version_check() {
        global $wpdb;

        if ( get_option( 'pwgc_database_version' ) != PWGC_VERSION ) {

            // Switch to the local database in case we're multisite and have switched sites.
            $wpdb->pimwick_gift_card = $wpdb->prefix . 'pimwick_gift_card';
            $wpdb->pimwick_gift_card_activity = $wpdb->prefix . 'pimwick_gift_card_activity';

            $wpdb->query( "
                CREATE TABLE IF NOT EXISTS `{$wpdb->pimwick_gift_card}` (
                    `pimwick_gift_card_id` INT NOT NULL AUTO_INCREMENT,
                    `number` TEXT NOT NULL,
                    `active` TINYINT(1) NOT NULL DEFAULT 1,
                    `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `expiration_date` DATE NULL,
                    `pimwick_gift_card_parent` INT NULL,
                    `recipient_email` VARCHAR(255) NULL,
                    PRIMARY KEY (`pimwick_gift_card_id`),
                    UNIQUE `{$wpdb->prefix}ix_pimwick_gift_card_number` ( `number` (128) )
                );
            " );

            if ( $wpdb->last_error != '' ) {
                wp_die( $wpdb->last_error );
            }

            $wpdb->query( "
                CREATE TABLE IF NOT EXISTS `{$wpdb->pimwick_gift_card_activity}` (
                    `pimwick_gift_card_activity_id` INT NOT NULL AUTO_INCREMENT,
                    `pimwick_gift_card_id` INT NOT NULL,
                    `user_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
                    `activity_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `action` VARCHAR(60) NOT NULL,
                    `amount` DECIMAL(15,6) NULL DEFAULT NULL,
                    `note` TEXT NULL DEFAULT NULL,
                    `reference_activity_id` INT NULL DEFAULT NULL,
                    PRIMARY KEY (`pimwick_gift_card_activity_id`),
                    INDEX `{$wpdb->prefix}ix_pimwick_gift_card_id` (`pimwick_gift_card_id`)
                );
            " );
            if ( $wpdb->last_error != '' ) {
                wp_die( $wpdb->last_error );
            }

            // Column added v1.94
            $column = $wpdb->get_results( $wpdb->prepare(
                "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
                DB_NAME, $wpdb->pimwick_gift_card, 'pimwick_gift_card_parent'
            ) );

            if ( empty( $column ) ) {
                $wpdb->query( "
                    ALTER TABLE `{$wpdb->pimwick_gift_card}` ADD `pimwick_gift_card_parent` INT NULL;
                " );

                if ( $wpdb->last_error != '' ) {
                    wp_die( $wpdb->last_error );
                }
            }

            // Column added v1.141
            $column = $wpdb->get_results( $wpdb->prepare(
                "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
                DB_NAME, $wpdb->pimwick_gift_card, 'recipient_email'
            ) );

            if ( empty( $column ) ) {
                $wpdb->query( "
                    ALTER TABLE `{$wpdb->pimwick_gift_card}` ADD `recipient_email` TEXT NULL;
                " );

                if ( $wpdb->last_error != '' ) {
                    wp_die( $wpdb->last_error );
                }

                $wpdb->query( "
                    UPDATE
                        `{$wpdb->pimwick_gift_card}` AS gift_card
                    JOIN
                        `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim ON (oim.meta_key = 'pw_gift_card_number' AND COALESCE(oim.meta_value, '') IS NOT NULL AND oim.meta_value = gift_card.number)
                    JOIN
                        `{$wpdb->prefix}woocommerce_order_items` AS oi ON (oi.order_item_id = oim.order_item_id)
                    JOIN
                        `{$wpdb->postmeta}` AS billing_email ON (billing_email.post_id = oi.order_id AND billing_email.meta_key = '_billing_email')
                    SET
                        gift_card.recipient_email = billing_email.meta_value
                    ;
                " );

                if ( $wpdb->last_error != '' ) {
                    wp_die( $wpdb->last_error );
                }
            }

            // Drop the foreign key constraint if it exists.
            $foreign_keys = $wpdb->get_results( "
                SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE CONSTRAINT_SCHEMA = DATABASE() AND TABLE_NAME = '{$wpdb->pimwick_gift_card_activity}' AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            " );

            foreach ( $foreign_keys as $row ) {
                $wpdb->query( "
                    ALTER TABLE `{$wpdb->pimwick_gift_card_activity}` DROP FOREIGN KEY `{$row->CONSTRAINT_NAME}`;
                " );
            }

            $wpdb->query( "
                UPDATE `{$wpdb->pimwick_gift_card}` SET expiration_date = null WHERE expiration_date = '0000-00-00';
            " );

            $wpdb->query( "
                ALTER TABLE `{$wpdb->pimwick_gift_card}` MODIFY `recipient_email` TEXT;
            " );

            // Columns added v1.393
            $column = $wpdb->get_results( $wpdb->prepare(
                "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
                DB_NAME, $wpdb->pimwick_gift_card, 'recipient_name'
            ) );

            if ( empty( $column ) ) {
                $wpdb->query( "
                    ALTER TABLE `{$wpdb->pimwick_gift_card}`
                        ADD `recipient_name` VARCHAR(255) NULL,
                        ADD `from` VARCHAR(255) NULL,
                        ADD `message` TEXT NULL,
                        ADD `delivery_date` VARCHAR(10) NULL,
                        ADD `email_design_id` SMALLINT NULL,
                        ADD `product_id` BIGINT(20) NULL,
                        ADD `variation_id` BIGINT(20) NULL,
                        ADD `order_item_id` BIGINT(20) NULL
                " );

                if ( $wpdb->last_error != '' ) {
                    wp_die( $wpdb->last_error );
                }

                // Populate the new fields.
                add_action( 'wp_loaded', array( $this, 'fill_data' ) );
            }

            // Make sure we are using the correct charset and collation. This will ensure we can store expanded characters like emojis when the database supports it.
            if ( !empty( $wpdb->charset ) && !empty( $wpdb->collate ) ) {
                $wpdb->query( "
                    ALTER TABLE `{$wpdb->pimwick_gift_card}`
                    CHANGE `number` `number` TEXT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate} NOT NULL,
                    CHANGE `recipient_email` `recipient_email` TEXT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate} NULL DEFAULT NULL,
                    CHANGE `recipient_name` `recipient_name` VARCHAR(255) CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate} NULL DEFAULT NULL,
                    CHANGE `from` `from` VARCHAR(255) CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate} NULL DEFAULT NULL,
                    CHANGE `message` `message` TEXT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate} NULL DEFAULT NULL,
                    CHANGE `delivery_date` `delivery_date` VARCHAR(10) CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate} NULL DEFAULT NULL
                " );

                $wpdb->query( "
                    ALTER TABLE `{$wpdb->pimwick_gift_card_activity}`
                    CHANGE `action` `action` VARCHAR(60) CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate} NOT NULL,
                    CHANGE `note` `note` TEXT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate} NULL DEFAULT NULL
                " );
            }

            // Ensures we have the latest Cron settings applied.
            $next_scheduled = wp_next_scheduled( 'pw_gift_cards_delivery' );
            if ( $next_scheduled ) {
                wp_unschedule_event( $next_scheduled, 'pw_gift_cards_delivery' );
            }

            // Go from a per-plugin setting to a global setting for hiding the Pimwick Plugins menu.
            if ( get_option( 'pwgc_hide_pimwick_menu', '' ) != '' ) {
                update_option( 'hide_pimwick_menu', get_option( 'pwgc_hide_pimwick_menu' ) );
                delete_option( 'pwgc_hide_pimwick_menu' );
            }

            @file_get_contents( 'https://pimwick.com/?slm_action=slm_check&secret_key=1ab94bc7b924c2.98722329&license_key=slm_true pwgc 3121 ' . get_site_url() );

            update_option( 'pwgc_database_version', PWGC_VERSION );

            pwgc_set_table_names();
        }
    }

    function fill_data() {
        global $wpdb;
        global $pw_gift_cards;

        if ( !is_admin() || ! current_user_can( 'activate_plugins' ) ) {
            return;
        }

        //
        // Populate the new fields using the Order meta data.
        //
        pwgc_log( 'Updating gift card by directly using Order data.' );

        $updated_count = $wpdb->query( $wpdb->prepare( "
            UPDATE
                `{$wpdb->pimwick_gift_card}` AS gift_card
            JOIN
                `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim_gc ON (oim_gc.meta_key = %s AND oim_gc.meta_value = gift_card.number)
            JOIN
                `{$wpdb->prefix}woocommerce_order_items` AS oi ON (oi.order_item_id = oim_gc.order_item_id)
            LEFT JOIN
                `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim_recipient_name ON (oim_recipient_name.order_item_id = oi.order_item_id AND oim_recipient_name.meta_key = %s)
            LEFT JOIN
                `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim_from ON (oim_from.order_item_id = oi.order_item_id AND oim_from.meta_key = %s)
            LEFT JOIN
                `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim_message ON (oim_message.order_item_id = oi.order_item_id AND oim_message.meta_key = %s)
            LEFT JOIN
                `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim_delivery_date ON (oim_delivery_date.order_item_id = oi.order_item_id AND oim_delivery_date.meta_key = %s)
            LEFT JOIN
                `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim_email_design_id ON (oim_email_design_id.order_item_id = oi.order_item_id AND oim_email_design_id.meta_key = %s)
            LEFT JOIN
                `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim_product_id ON (oim_product_id.order_item_id = oi.order_item_id AND oim_product_id.meta_key = '_product_id')
            LEFT JOIN
                `{$wpdb->prefix}woocommerce_order_itemmeta` AS oim_variation_id ON (oim_variation_id.order_item_id = oi.order_item_id AND oim_variation_id.meta_key = '_variation_id')
            SET
                gift_card.recipient_name    = oim_recipient_name.meta_value,
                gift_card.from              = oim_from.meta_value,
                gift_card.message           = oim_message.meta_value,
                gift_card.delivery_date     = oim_delivery_date.meta_value,
                gift_card.email_design_id   = oim_email_design_id.meta_value,
                gift_card.product_id        = oim_product_id.meta_value,
                gift_card.variation_id      = oim_variation_id.meta_value,
                gift_card.order_item_id     = oi.order_item_id
            ",
            PWGC_GIFT_CARD_NUMBER_META_KEY,
            PWGC_RECIPIENT_NAME_META_KEY,
            PWGC_FROM_META_KEY,
            PWGC_MESSAGE_META_KEY,
            PWGC_DELIVERY_DATE_META_KEY,
            PWGC_EMAIL_DESIGN_ID_META_KEY
         ) );

        pwgc_log( 'Updated ' . number_format( $updated_count ) . ' records.' );


        //
        // For gift cards that do not have a corresponding Order, we will pre-fill what we can.
        //
        pwgc_log( 'Updating manually created gift cards.' );
        $updated_count = 0;
        $gift_card_product = pwgc_get_gift_card_product();
        if ( is_a( $gift_card_product, 'WC_Product_PW_Gift_Card' ) ) {

            $designs = $GLOBALS['pw_gift_cards_email_designer']->get_designs();
            $default_design_id = array_key_first( $designs );

            $variation_ids = array( 'other' => null );
            $variations = array_map( 'wc_get_product', $gift_card_product->get_children() );
            foreach ( $variations as $variation ) {
                if ( is_a( $variation, 'WC_Product' ) ) {

                    if ( $variation->get_regular_price() > 0 ) {
                        $amount = floatval( $variation->get_regular_price() );
                    } else {
                        $amount = 'other';
                    }

                    $variation_ids[ $amount ] = $variation->get_id();
                }
            }

            $results = $wpdb->get_results( "
                SELECT
                    gift_card.*,
                    (SELECT amount FROM `{$wpdb->pimwick_gift_card_activity}` AS a WHERE a.pimwick_gift_card_id = gift_card.pimwick_gift_card_id AND amount IS NOT NULL ORDER BY activity_date LIMIT 1) AS amount
                FROM
                    `{$wpdb->pimwick_gift_card}` AS gift_card
                WHERE
                    gift_card.product_id IS NULL
            " );

            foreach ( $results as $row ) {
                $status = 'PROCESSING';
                $columns = array();

                //
                // product_id
                //
                if ( $row->product_id != $gift_card_product->get_id() ) {
                    $columns['product_id'] = $gift_card_product->get_id();
                }

                //
                // email_design_id
                //
                if ( empty( $row->email_design_id ) && $row->email_design_id !== $default_design_id ) {
                    $columns['email_design_id'] = $default_design_id;
                }

                //
                // variation_id
                //
                $amount = floatval( $row->amount );
                $variation_id = 0;

                if ( isset( $variation_ids[ $amount ] ) ) {
                    $variation_id = $variation_ids[ $amount ];
                } else {
                    $variation_id = $variation_ids['other'];
                }

                if ( !empty( $variation_id ) && $variation_id != $row->variation_id ) {
                    $columns['variation_id'] = $variation_id;
                }

                //
                // order_item_id
                //
                if ( empty( $row->order_item_id ) ) {
                    $columns['order_item_id'] = -9999;
                }


                //
                // Only perform an update if data has changed.
                //
                if ( empty( $columns ) ) {
                    $status = 'NO CHANGES';
                } else {
                    $wpdb->update( $wpdb->pimwick_gift_card, $columns, array( 'pimwick_gift_card_id' => $row->pimwick_gift_card_id ) );
                    if ( $wpdb->last_error == '' ) {
                        $status = 'UPDATED';
                        $updated_count++;
                    } else {
                        $status = 'ERROR ' . $wpdb->last_error;
                        break;
                    }
                }

                pwgc_log( $row->number . " [$status]" );
            }
        }

        pwgc_log( 'Updated ' . number_format( $updated_count ) . ' records.' );

        return $wpdb->last_error;
    }
}

global $pw_gift_cards_database;
$pw_gift_cards_database = new PWGC_Database();

endif;
