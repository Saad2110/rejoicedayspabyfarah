<?php
namespace BooklyPro\Backend\Components\Dialogs\Customer\ProxyProviders;

use Bookly\Backend\Components\Dialogs\Customer\Edit\Proxy;
use Bookly\Lib as BooklyLib;
use BooklyPro\Lib;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function prepareL10n( $localize )
    {
        $address = array();
        foreach ( Lib\Utils\Common::getDisplayedAddressFields() as $field_name => $field ) {
            $address[ $field_name ] = __( get_option( 'bookly_l10n_label_' . $field_name ), 'bookly' );
        }

        $localize['address'] = $address;
        $localize['l10n']['birthday'] = __( 'Date of birth', 'bookly' );
        $localize['l10n']['createWpUser'] = __( 'Create WordPress user', 'bookly' );

        return $localize;
    }

    /**
     * @inheritDoc
     */
    public static function prepareSaveCustomer( $response, $request, $customer )
    {
        if ( $request->get( 'wp_user_id' ) === 'create' ) {
            $exists_active_notification = BooklyLib\Entities\Notification::query()
                ->where( 'type', BooklyLib\Entities\Notification::TYPE_CUSTOMER_NEW_WP_USER )
                ->where( 'active', 1 )
                ->limit( 1 )
                ->count();
            if ( $exists_active_notification ) {
                // Try to create WordPress user
                try {
                    $wp_user = Lib\Utils\Common::createWPUser( array(
                        'email' => $request->get( 'email' ),
                        'first_name' => $request->get( 'first_name' ),
                        'last_name' => $request->get( 'last_name' ),
                        'full_name' => $request->get( 'full_name' ),
                    ), $password, 'client' );
                    $wp_user->set_role( get_option( 'bookly_cst_new_account_role' ) );

                    // Send email/sms notification.
                    $customer->setEmail( $wp_user->user_email );
                    Lib\Notifications\NewWpUser\Sender::sendAuthToClient( $customer, $wp_user->display_name, $password );
                    $response['wp_user'] = array(
                        'ID' => $wp_user->ID,
                        'user_email' => $request->get( 'email' ),
                        'display_name' => $wp_user->display_name,
                        'user_id' => $wp_user->ID,
                        'first_name' => '',
                        'last_name' => '',
                        'phone' => null,
                    );
                    $customer->setWpUserId( $wp_user->ID );
                } catch ( BooklyLib\Base\ValidationException $e ) {
                    $response['errors'][ $e->getField() ] = $e->getMessage();
                }
            } else {
                $response['errors']['wp_user'] = __( 'Please setup and enable New customer\'s WordPress user login details notification', 'bookly' );
            }
        }

        return $response;
    }
}