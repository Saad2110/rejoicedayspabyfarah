<?php

defined( 'ABSPATH' ) or exit;

global $pw_gift_cards;
global $pw_gift_cards_email_designer;

?>
<div class="pwgc-designer-panel" style="max-width: 320px;">
    <form id="pwgc-designer-form" autocomplete="off">
        <input type="hidden" id="pwgc-design-id" name="design_id" value="<?php echo $design_id; ?>">

        <!--// General //-->
        <div class="pwgc-designer-field-wrap-title" style="margin-top: 0;"><i class="fas fa-chevron-circle-down"></i> <?php esc_html_e( 'General', 'pw-woocommerce-gift-cards' ); ?></div>
        <div class="pwgc-designer-field-wrap" style="display: block;">
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-design-name"><?php _e( 'Design name (visible to customers)', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" name="name" id="pwgc-design-name" value="<?php esc_attr_e( $design['name'] ); ?>" required />
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-designer-title"><?php _e( 'Gift card title', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" name="title" id="pwgc-designer-title" value="<?php esc_attr_e( $design['title'] ); ?>" required />
            </p>
            <?php
                $pw_gift_cards_email_designer->color_picker_field( $design, 'title_color', __( 'Gift card title color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'gift_card_color', __( 'Gift card color', 'pw-woocommerce-gift-cards' ) );
            ?>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-additional-content"><?php _e( 'Additional content (HTML allowed)', 'pw-woocommerce-gift-cards' ); ?></label>
                <textarea name="additional_content" id="pwgc-additional-content" rows="4"><?php esc_html_e( $design['additional_content'] ); ?></textarea>
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-additional-content-location"><?php _e( 'Additional content location', 'pw-woocommerce-gift-cards' ); ?></label>
                <select id="pwgc-additional-content-location" name="additional_content_location">
                    <?php
                        foreach ( $pw_gift_cards_email_designer->get_content_locations() as $id => $name ) {
                            ?>
                            <option value="<?php echo $id; ?>" <?php selected( $design['additional_content_location'], $id ); ?>><?php esc_html_e( $name ); ?></option>
                            <?php
                        }
                    ?>
                </select>
                <select id="pwgc-additional-content-align" name="additional_content_align">
                    <option value="left" <?php selected( $design['additional_content_align'], 'left' ); ?>><?php _e( 'Left', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="center" <?php selected( $design['additional_content_align'], 'center' ); ?>><?php _e( 'Center', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="right" <?php selected( $design['additional_content_align'], 'right' ); ?>><?php _e( 'Right', 'pw-woocommerce-gift-cards' ); ?></option>
                </select>
            </p>
            <?php
                $pw_gift_cards_email_designer->color_picker_field( $design, 'additional_content_color', __( 'Additional content text color', 'pw-woocommerce-gift-cards' ) );
            ?>
        </div>


        <!--// Image //-->
        <div class="pwgc-designer-field-wrap-title"><i class="fas fa-chevron-circle-down"></i> <?php esc_html_e( 'Image', 'pw-woocommerce-gift-cards' ); ?></div>
        <div class="pwgc-designer-field-wrap">
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-logo-image"><?php _e( 'Image', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" name="logo_image" id="pwgc-logo-image" value="<?php esc_attr_e( $design['logo_image'] ); ?>" style="width: initial;" />
                <button id="pwgc-logo-image-button" class="button"><?php _e( 'Select Image', 'pw-woocommerce-gift-cards' ); ?></button>
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-logo-image-location"><?php _e( 'Image location', 'pw-woocommerce-gift-cards' ); ?></label>
                <select id="pwgc-logo-image-location" name="logo_image_location">
                    <?php
                        foreach ( $pw_gift_cards_email_designer->get_content_locations() as $id => $name ) {
                            ?>
                            <option value="<?php echo $id; ?>" <?php selected( $design['logo_image_location'], $id ); ?>><?php esc_html_e( $name ); ?></option>
                            <?php
                        }
                    ?>
                </select>
                <select id="pwgc-logo-image-align" name="logo_image_align">
                    <option value="left" <?php selected( $design['logo_image_align'], 'left' ); ?>><?php _e( 'Left', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="center" <?php selected( $design['logo_image_align'], 'center' ); ?>><?php _e( 'Center', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="right" <?php selected( $design['logo_image_align'], 'right' ); ?>><?php _e( 'Right', 'pw-woocommerce-gift-cards' ); ?></option>
                </select>
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-logo-image-max-width"><?php _e( 'Image dimensions', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" name="logo_image_max_width" id="pwgc-logo-image-max-width" class="pwgc-logo-image-dimension" value="<?php echo $design['logo_image_max_width']; ?>" title="<?php _e( 'Max width', 'pw-woocommerce-gift-cards' ); ?>" style="width: 75px;" />
                &nbsp;x&nbsp;
                <input type="text" name="logo_image_max_height" id="pwgc-logo-image-max-height" class="pwgc-logo-image-dimension" value="<?php echo $design['logo_image_max_height']; ?>" title="<?php _e( 'Max height', 'pw-woocommerce-gift-cards' ); ?>" style="width: 75px;" />
            </p>
            <?php
                // Background images are no longer recommended due to Outlook issues. Left here for backwards compatibility.
                if ( 'yes' === get_option( 'pwgc_allow_background_images', 'no' ) || ( isset( $design['background_image'] ) && !empty( $design['background_image'] ) ) ) {
                    ?>
                    <p class="form-field">
                        <label class="pwgc-designer-label" for="pwgc-background-image"><?php _e( 'Gift card background image', 'pw-woocommerce-gift-cards' ); ?></label>
                        <input type="text" name="background_image" id="pwgc-background-image" value="<?php esc_attr_e( $design['background_image'] ); ?>" style="width: initial;" />
                        <button id="pwgc-background-image-button" class="button"><?php _e( 'Select Image', 'pw-woocommerce-gift-cards' ); ?></button>
                        <span class="pwgc-designer-subtext">
                            <?php _e( 'Outlook does not display background images.', 'pw-woocommerce-gift-cards' ); ?>
                            <?php _e( 'We recommend a 500x275 pixel image.', 'pw-woocommerce-gift-cards' ); ?>
                            <a href="<?php echo $pw_gift_cards->relative_url( '/assets/images/pw-gift-card-500x275.png' ); ?>" target="_blank"><?php _e( 'Sample', 'pw-woocommerce-gift-cards' ); ?></a>
                        </span>
                    </p>
                    <script>
                        jQuery(function() {
                            pwgcBindMediaPicker('#pwgc-background-image', '#pwgc-background-image-button');

                            jQuery('#pwgc-background-image').on('propertychange change keyup input paste', function() {
                                pwgcDesignerUpdateImage();
                            });
                        });
                    </script>
                    <?php
                }
            ?>
        </div>



        <!--// Redeem Button //-->
        <div class="pwgc-designer-field-wrap-title"><i class="fas fa-chevron-circle-down"></i> <?php esc_html_e( 'Redeem Button', 'pw-woocommerce-gift-cards' ); ?></div>
        <div class="pwgc-designer-field-wrap">
            <?php
                $pw_gift_cards_email_designer->color_picker_field( $design, 'redeem_button_background_color', __( 'Redeem button color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'redeem_button_color', __( 'Redeem button text color', 'pw-woocommerce-gift-cards' ) );
            ?>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-designer-redeem-button-text"><?php _e( 'Redeem Button Text', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" name="redeem_button_text" id="pwgc-designer-redeem-button-text" value="<?php esc_attr_e( $design['redeem_button_text'] ); ?>" required />
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-redeem-button-visibility"><?php _e( 'Redeem Button Visibility', 'pw-woocommerce-gift-cards' ); ?></label>
                <select id="pwgc-redeem-button-visibility" name="redeem_button_visibility">
                    <option value="visible" <?php selected( $design['redeem_button_visibility'], 'visible' ); ?>><?php _e( 'Visible', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="hidden" <?php selected( $design['redeem_button_visibility'], 'hidden' ); ?>><?php _e( 'Hidden', 'pw-woocommerce-gift-cards' ); ?></option>
                </select>
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-redeem-url"><?php _e( 'Redeem URL', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" name="redeem_url" id="pwgc-redeem-url" placeholder="<?php esc_attr_e( pwgc_default_redeem_url() ); ?>" value="<?php esc_attr_e( $design['redeem_url'] ); ?>" />
                <span class="pwgc-designer-subtext">
                    <?php _e( 'The link for the Redeem button on the gift card email. Include the https prefix, the Gift Card Number is automatically appended in the URL.', 'pw-woocommerce-gift-cards' ); ?>
                </span>
            </p>
        </div>



        <!--// Additional Colors //-->
        <div class="pwgc-designer-field-wrap-title"><i class="fas fa-chevron-circle-down"></i> <?php esc_html_e( 'Additional Colors', 'pw-woocommerce-gift-cards' ); ?></div>
        <div class="pwgc-designer-field-wrap">
            <?php
                $pw_gift_cards_email_designer->color_picker_field( $design, 'pdf_link_color', __( 'PDF Link Color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'recipient_color', __( 'Recipient text color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'from_color', __( 'From text color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'message_color', __( 'Message text color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'amount_label_color', __( 'Amount label color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'amount_color', __( 'Amount color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'gift_card_number_label_color', __( 'Gift card number label color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'gift_card_number_color', __( 'Gift card number color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'expiration_date_label_color', __( 'Expiration date label color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'expiration_date_color', __( 'Expiration Date color', 'pw-woocommerce-gift-cards' ) );
                $pw_gift_cards_email_designer->color_picker_field( $design, 'gift_card_border_color', __( 'Gift card border color', 'pw-woocommerce-gift-cards' ) );
            ?>
        </div>



        <!--// PDF //-->
        <div class="pwgc-designer-field-wrap-title"><i class="fas fa-chevron-circle-down"></i> <?php esc_html_e( 'PDF', 'pw-woocommerce-gift-cards' ); ?></div>
        <div class="pwgc-designer-field-wrap">
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-pdf-link-visibility"><?php _e( 'PDF Link Visibility', 'pw-woocommerce-gift-cards' ); ?></label>
                <select id="pwgc-pdf-link-visibility" name="pdf_link_visibility">
                    <option value="visible" <?php selected( $design['pdf_link_visibility'], 'visible' ); ?>><?php _e( 'Visible', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="hidden" <?php selected( $design['pdf_link_visibility'], 'hidden' ); ?>><?php _e( 'Hidden', 'pw-woocommerce-gift-cards' ); ?></option>
                </select>
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-designer-pdf-link-text"><?php _e( 'PDF Link Text', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" name="pdf_link_text" id="pwgc-designer-pdf-link-text" value="<?php esc_attr_e( $design['pdf_link_text'] ); ?>" required />
            </p>
        </div>



        <!--// QR Code //-->
        <div class="pwgc-designer-field-wrap-title"><i class="fas fa-chevron-circle-down"></i> <?php esc_html_e( 'QR Code', 'pw-woocommerce-gift-cards' ); ?></div>
        <div class="pwgc-designer-field-wrap">
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-qr-code-visibility"><?php _e( 'QR Code Visibility', 'pw-woocommerce-gift-cards' ); ?></label>
                <select id="pwgc-qr-code-visibility" name="qr_code_visibility">
                    <option value="hidden" <?php selected( $design['qr_code_visibility'], 'hidden' ); ?>><?php _e( 'Hidden', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="email" <?php selected( $design['qr_code_visibility'], 'email' ); ?>><?php _e( 'Visible on Email only', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="pdf" <?php selected( $design['qr_code_visibility'], 'pdf' ); ?>><?php _e( 'Visible on PDF only', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="both" <?php selected( $design['qr_code_visibility'], 'both' ); ?>><?php _e( 'Visible on Email and PDF', 'pw-woocommerce-gift-cards' ); ?></option>
                </select>
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-qr-code-location"><?php _e( 'Location', 'pw-woocommerce-gift-cards' ); ?></label>
                <select id="pwgc-qr-code-location" name="qr_code_location">
                    <?php
                        foreach ( $pw_gift_cards_email_designer->get_content_locations() as $id => $name ) {
                            ?>
                            <option value="<?php echo $id; ?>" <?php selected( $design['qr_code_location'], $id ); ?>><?php esc_html_e( $name ); ?></option>
                            <?php
                        }
                    ?>
                </select>
                <select id="pwgc-qr-code-align" name="qr_code_align">
                    <option value="left" <?php selected( $design['qr_code_align'], 'left' ); ?>><?php _e( 'Left', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="center" <?php selected( $design['qr_code_align'], 'center' ); ?>><?php _e( 'Center', 'pw-woocommerce-gift-cards' ); ?></option>
                    <option value="right" <?php selected( $design['qr_code_align'], 'right' ); ?>><?php _e( 'Right', 'pw-woocommerce-gift-cards' ); ?></option>
                </select>
            </p>
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-qr-code-size"><?php _e( 'Size (default: 100)', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="text" name="qr_code_size" id="pwgc-qr-code-size" class="pwgc-qr-code-size" value="<?php echo $design['qr_code_size']; ?>" title="<?php _e( 'Size (default: 100)', 'pw-woocommerce-gift-cards' ); ?>" style="width: 75px;" />
            </p>
        </div>



        <!--// Advanced //-->
        <div class="pwgc-designer-field-wrap-title"><i class="fas fa-chevron-circle-down"></i> <?php esc_html_e( 'Advanced', 'pw-woocommerce-gift-cards' ); ?></div>
        <div class="pwgc-designer-field-wrap">
            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-custom-css"><?php _e( 'Custom CSS', 'pw-woocommerce-gift-cards' ); ?></label>
                <textarea name="custom_css" id="pwgc-custom-css" rows="4"><?php esc_html_e( $design['custom_css'] ); ?></textarea>
                <span class="pwgc-designer-subtext">
                    <?php _e( 'Save and refresh the page after adding custom CSS.', 'pw-woocommerce-gift-cards' ); ?>
                </span>
            </p>

            <p class="form-field">
                <label class="pwgc-designer-label" for="pwgc-design-order"><?php _e( 'Dropdown menu order', 'pw-woocommerce-gift-cards' ); ?></label>
                <input type="number" name="order" id="pwgc-design-order" value="<?php esc_attr_e( $design['order'] ); ?>" min="0" step="1" style="max-width: 75px;" required />
            </p>
        </div>

        <p>
            <?php
                $email_settings_url = add_query_arg( 'page', 'wc-settings', admin_url( 'admin.php' ) );
                $email_settings_url = add_query_arg( 'tab', 'email', $email_settings_url );
                $email_settings_url = add_query_arg( 'section', 'wc_email_pw_gift_card', $email_settings_url );

                // translators: %s a link to the store's WooCommerce Email Settings page.
                printf( __( 'Go to the %s to customize the background color, subject, email heading, and more.', 'pw-woocommerce-gift-cards' ), "<a href=\"$email_settings_url\">WooCommerce Email Settings</a>" );
            ?>
        </p>
        <p>
            <a href="#" id="pwgc-designer-advanced-toggle"><?php _e( 'Want even more control?', 'pw-woocommerce-gift-cards' ); ?></a>
            <div id="pwgc-designer-advanced" class="pwgc-hidden">
                <?php _e( 'You can fully customize the gift card email to suit your needs. We use the built in WooCommerce email template system. To override the email you should copy this file', 'pw-woocommerce-gift-cards' ); ?>:
                <pre><?php echo untrailingslashit( PWGC_PLUGIN_ROOT ); ?>/templates/woocommerce/emails/customer-pw-gift-card.php</pre>
                <?php _e( 'To here', 'pw-woocommerce-gift-cards' ); ?>:
                <pre><?php echo untrailingslashit( get_template_directory() ); ?>/woocommerce/emails/customer-pw-gift-card.php</pre>
                <?php _e( 'You may need to create the subfolders if they do not exist in your theme folder. Once the file is in your theme folder, open it up in a text editor and make any changes.', 'pw-woocommerce-gift-cards' ); ?>
            </div>
        </p>
        <p class="form-field" style="margin-top: 32px;">
            <input type="button" id="pwgc-save-design-button" name="save_design" class="button button-primary" value="<?php _e( 'Save design', 'pw-woocommerce-gift-cards' ); ?>"></input>
            <a href="#" id="pwgc-delete-design" style="color: #A00; margin-left: 30px;"><?php _e( 'Delete design', 'pw-woocommerce-gift-cards' ); ?></a>
            <div id="pwgc-save-design-message"></div>
        </p>
    </form>
</div>
<div id="pwgc-designer-preview" class="pwgc-designer-panel">
    <div>
        <?php
            $custom_template_path = get_stylesheet_directory() . '/' . apply_filters( 'woocommerce_template_directory', 'woocommerce', 'emails/customer-pw-gift-card.php' ) . '/emails/customer-pw-gift-card.php';
            if ( !file_exists( $custom_template_path ) ) {
                $custom_template_path = get_stylesheet_directory() . '/' . apply_filters( 'woocommerce_template_directory', 'woocommerce', 'emails/email-pw-gift-card-image.php' ) . '/emails/email-pw-gift-card-image.php';
            }

            if ( file_exists( $custom_template_path ) ) {
                ?>
                <div style="color: red; font-weight: bold;"><?php _e( 'Custom template file detected!', 'pw-woocommerce-gift-cards' ); ?></div>
                <div style="max-width: 500px; margin-bottom: 16px;">
                    <pre><?php echo $custom_template_path; ?></pre>
                    <?php _e( 'It appears as though you already have a custom email template file, your changes in the Designer may not appear when you actually send the email. Click the Send Preview Email button to confirm.', 'pw-woocommerce-gift-cards' ); ?>
                </div>
                <?php
            }
        ?>
        <span class="pwgc-preview-header"><?php _e( 'Preview', 'pw-woocommerce-gift-cards' ); ?></span>
        <div style="float: right;">
            <span id="pwgc-preview-email-message"></span>
            <button id="pwgc-preview-email-button" class="button" data-email="<?php esc_attr_e( get_option( 'admin_email' ) ); ?>"><i class="fas fa-envelope"></i> <?php _e( 'Send a preview email', 'pw-woocommerce-gift-cards' ); ?></button>
        </div>
    </div>
    <div id="pwgc-preview-container" style="color: <?php echo get_option( 'woocommerce_email_text_color', '#3c3c3c' ); ?>; background-color: <?php echo get_option( 'woocommerce_email_body_background_color', '#ffffff' ); ?>">
        <?php
            $item_data = new PW_Gift_Card_Item_Data();
            $item_data->recipient_name = __( 'Recipient Name', 'pw-woocommerce-gift-cards' );
            $item_data->from = __( 'The Purchasing Customer', 'pw-woocommerce-gift-cards' );
            $item_data->message = __( 'Gift card message to the recipient from the sender.', 'pw-woocommerce-gift-cards' );
            $item_data->amount = '123.45';
            $item_data->gift_card_number = pwgc_get_example_gift_card_number();
            $item_data->design_id = $design_id;
            $item_data->design = $design;
            $item_data->expiration_date = date_i18n( wc_date_format() );
            $item_data->preview = true;
            $item_data->parent_product = pwgc_get_gift_card_product();

            wc_get_template( 'emails/customer-pw-gift-card.php', array( 'item_data' => $item_data ), '', PWGC_PLUGIN_ROOT . 'templates/woocommerce/' );
        ?>
    </div>
</div>
