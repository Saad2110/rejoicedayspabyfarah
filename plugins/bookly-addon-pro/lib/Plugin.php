<?php
namespace BooklyPro\Lib;

use Bookly\Lib as BooklyLib;
use BooklyPro\Backend;
use BooklyPro\Frontend;

abstract class Plugin extends BooklyLib\Base\Plugin
{
    protected static $prefix;
    protected static $title;
    protected static $version;
    protected static $slug;
    protected static $directory;
    protected static $main_file;
    protected static $basename;
    protected static $text_domain;
    protected static $root_namespace;
    protected static $embedded;

    /**
     * @inheritDoc
     */
    protected static function init()
    {
        Backend\Components\Gutenberg\AppointmentsList\Block::init();
        Backend\Components\Gutenberg\Calendar\Block::init();
        Backend\Components\Gutenberg\Shortcodes\Block::init();

        // Register proxy methods.
        Backend\Components\Dialogs\Appointment\AttachPayment\ProxyProviders\Local::init();
        Backend\Components\Dialogs\Appointment\CustomerDetails\ProxyProviders\Shared::init();
        Backend\Components\Dialogs\Appointment\Edit\ProxyProviders\Local::init();
        Backend\Components\Dialogs\Appointment\Edit\ProxyProviders\Shared::init();
        Backend\Components\Dialogs\Customer\ProxyProviders\Shared::init();
        Backend\Components\Dialogs\Payment\ProxyProviders\Shared::init();
        Backend\Components\Dialogs\Service\Edit\ProxyProviders\Local::init();
        Backend\Components\Dialogs\Service\Edit\ProxyProviders\Shared::init();
        Backend\Components\Dialogs\Staff\Categories\ProxyProviders\Local::init();
        Backend\Components\Dialogs\Staff\Edit\ProxyProviders\Local::init();
        Backend\Components\Dialogs\Staff\Edit\ProxyProviders\Shared::init();
        Backend\Components\Notices\ProxyProviders\Local::init();
        Backend\Components\Settings\ProxyProviders\Local::init();
        Backend\Components\TinyMce\ProxyProviders\Shared::init();
        Backend\Modules\Appearance\ProxyProviders\Local::init();
        Backend\Modules\Appearance\ProxyProviders\Shared::init();
        Backend\Modules\Appointments\ProxyProviders\Local::init();
        Backend\Modules\Calendar\ProxyProviders\Local::init();
        Backend\Modules\Calendar\ProxyProviders\Shared::init();
        Backend\Modules\Customers\ProxyProviders\Local::init();
        Backend\Modules\Customers\ProxyProviders\Shared::init();
        Backend\Modules\Dashboard\ProxyProviders\Local::init();
        Backend\Modules\Notifications\ProxyProviders\Local::init();
        Backend\Modules\Notifications\ProxyProviders\Shared::init();
        Backend\Modules\Services\ProxyProviders\Shared::init();
        Backend\Modules\Settings\ProxyProviders\Local::init();
        Backend\Modules\Settings\ProxyProviders\Shared::init();
        Backend\Modules\Setup\ProxyProviders\Local::init();
        Backend\Modules\Staff\ProxyProviders\Local::init();
        Backend\Modules\Staff\ProxyProviders\Shared::init();
        Cloud\ProxyProviders\Shared::init();
        Frontend\Modules\Booking\ProxyProviders\Local::init();
        Frontend\Modules\Booking\ProxyProviders\Shared::init();
        Frontend\Modules\Calendar\ShortCode::init();
        Frontend\Modules\Payment\ProxyProviders\Local::init();
        Notifications\Assets\Combined\ProxyProviders\Local::init();
        Notifications\Assets\Item\ProxyProviders\Shared::init();
        Notifications\Assets\Order\ProxyProviders\Shared::init();
        Notifications\Assets\Test\ProxyProviders\Shared::init();
        Notifications\Cart\ProxyProviders\Local::init();
        Notifications\Test\ProxyProviders\Shared::init();
        Payment\ProxyProviders\Shared::init();
        ProxyProviders\Local::init();
        ProxyProviders\Shared::init();

        $wc_loaded = class_exists( 'WooCommerce', false );
        // Register hooks when WooCommerce class loaded.
        // To protect against themes which call WooCommerce hooks when WC not used.
        if ( $wc_loaded && get_option( 'bookly_wc_enabled' ) ) {
            Frontend\Modules\WooCommerce\Controller::init();
        }

        if ( ! is_admin() ) {
            // Init short code.
            Frontend\Modules\CancellationConfirmation\ShortCode::init();
            Frontend\Modules\CustomerProfile\ShortCode::init();
            Frontend\Modules\SearchForm\ShortCode::init();
            Frontend\Modules\ServicesForm\ShortCode::init();
            Frontend\Modules\StaffForm\ShortCode::init();
        }
    }

    /**
     * @inerhitDoc
     */
    protected static function registerAjax()
    {
        Backend\Components\Dialogs\GiftCard\Card\Ajax::init();
        Backend\Components\Dialogs\GiftCard\Settings\Ajax::init();
        Backend\Components\Dialogs\GiftCard\Type\Ajax::init();
        Backend\Components\Dialogs\Payment\Ajax::init();
        Backend\Components\Dialogs\Service\Edit\Ajax::init();
        Backend\Components\Dialogs\Staff\Categories\Ajax::init();
        Backend\Components\Dialogs\Staff\Edit\Ajax::init();
        Backend\Components\License\Ajax::init();
        Backend\Components\Settings\Ajax::init();
        Backend\Modules\Appearance\Ajax::init();
        Backend\Modules\Appointments\Ajax::init();
        Backend\Modules\CloudGiftCards\Ajax::init();
        Backend\Modules\Customers\Ajax::init();
        Backend\Modules\Dashboard\Ajax::init();
        Backend\Modules\Notifications\Ajax::init();
        Backend\Modules\Settings\Ajax::init();
        Backend\Modules\Staff\Ajax::init();
        Frontend\Modules\Booking\Ajax::init();
        Frontend\Modules\CustomerProfile\Ajax::init();
        Frontend\Modules\Icalendar\Ajax::init();
        Frontend\Modules\ModernBookingForm\Ajax::init();
        Frontend\Modules\Square\Ajax::init();
        Frontend\Modules\WooCommerce\Ajax::init();

        if ( get_option( 'bookly_cal_frontend_enabled' ) ) {
            Frontend\Modules\Calendar\Ajax::init();
        }
    }

    /**
     * @inheritDoc
     */
    public static function run()
    {
        parent::run();

        // Run embedded add-ons.
        foreach ( self::embeddedAddons() as $plugin_class ) {
            $plugin_class::run();
        }
    }

    /**
     * @inheritDoc
     */
    public static function uninstall( $network_wide )
    {
        // Uninstall embedded add-ons.
        foreach ( self::embeddedAddons() as $plugin_class ) {
            $plugin_class::uninstall( $network_wide );
        }

        parent::uninstall( $network_wide );
    }

    /**
     * @inheritDoc
     */
    public static function activate( $network_wide )
    {
        parent::activate( $network_wide );

        if ( ! $network_wide ) {
            // Activate embedded add-ons.
            foreach ( self::embeddedAddons() as $plugin_class ) {
                $plugin_class::activate( false );
            }
        }
    }

    /**
     * Get embedded add-ons.
     *
     * @return BooklyLib\Base\Plugin[]
     */
    protected static function embeddedAddons()
    {
        $result = array();

        $dir = self::getDirectory() . '/lib/addons/';
        if ( is_dir( $dir ) ) {
            foreach ( glob( $dir . 'bookly-addon-*', GLOB_ONLYDIR ) as $path ) {
                include_once $path . '/autoload.php';
                $namespace = implode( '', array_map( 'ucfirst', explode( '-', str_replace( '-addon-', '-', basename( $path ) ) ) ) );
                $result[] = '\\' . $namespace . '\Lib\Plugin';
            }
        }

        return $result;
    }
}