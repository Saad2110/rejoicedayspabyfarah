<?php

defined( 'ABSPATH' ) or exit;

global $pw_gift_cards_email_designer;

$designs = $pw_gift_cards_email_designer->get_designs();
$design = reset( $designs );
$design_id = key( $designs );

?>
<div id="pwgc-designer-main">
    <div style="margin-bottom: 24px;">
        <div style="display: flex; flex-wrap: wrap;">
            <div>
                <div style="margin-bottom: 4px;">
                    <?php _e( 'Select a design to edit or add a new design.', 'pw-woocommerce-gift-cards' ); ?>
                </div>
                <div id="pwgc-select-design-message"></div>
                <select id="pwgc-design-selector" name="design" style="margin-right: 16px;" autocomplete="off">
                    <?php
                        foreach ( $designs as $id => $design_option ) {
                            ?>
                            <option value="<?php echo $id; ?>"><?php echo esc_html( $design_option['name'] ); ?></option>
                            <?php
                        }
                    ?>
                </select>
                <button class="button" id="pwgc-add-design-button"><i class="fas fa-plus"></i> <?php _e( 'Create a new design', 'pw-woocommerce-gift-cards' ); ?></button>
            </div>
            <div style="margin-left: 32px; color: #999999;">
                <i class="fas fa-info-circle fa-2x"></i>
            </div>
            <div style="margin-left: 4px; max-width: 450px;">
                <?php _e ('Edit the PW Gift Card product to specify which Email Designs can be selected by the purchasing customer.', 'pw-woocommerce-gift-cards' ); ?>
            </div>
        </div>
        <hr>
    </div>
    <div id="pwgc-designer-panel-message"></div>
    <div id="pwgc-designer-panel-container">
        <?php
            require_once( 'designer-panel.php' );
        ?>
    </div>
</div>