<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly
use Bookly\Backend\Components\Controls\Buttons;
use Bookly\Backend\Components\Controls\Inputs;
?>
<div id="bookly-export-customers-dialog" class="bookly-modal bookly-fade" tabindex=-1 role="dialog">
    <div class="modal-dialog">
        <form action="<?php echo admin_url( 'admin-ajax.php?action=bookly_pro_export_customers' ) ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php esc_html_e( 'Export to CSV', 'bookly' ) ?></h5>
                    <button type="button" class="close" data-dismiss="bookly-modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="export_customers_delimiter"><?php esc_html_e( 'Delimiter', 'bookly' ) ?></label>
                        <select name="export_customers_delimiter" id="export_customers_delimiter" class="form-control">
                            <option value=","><?php esc_html_e( 'Comma (,)', 'bookly' ) ?></option>
                            <option value=";"><?php esc_html_e( 'Semicolon (;)', 'bookly' ) ?></option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input id="bookly-js-export-select-all" class="bookly-js-required custom-control-input" type="checkbox" checked />
                            <label class="custom-control-label" for="bookly-js-export-select-all"><?php esc_html_e( 'Select all', 'bookly' ) ?></label>
                        </div>
                    </div>
                    <div class="form-group ml-3 bookly-js-columns">
                        <?php foreach ( $settings['columns'] as $column => $show ) : ?>
                            <?php if ( $show ) : ?>
                                <?php Inputs::renderCheckBox( $columns[ $column ], null, true, array( 'name' => 'exp[' . $column . ']' ) ) ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php Inputs::renderCsrf() ?>
                    <?php Buttons::renderSubmit( null, null, __( 'Export to CSV', 'bookly' ) ) ?>
                </div>
            </div>
        </form>
    </div>
</div>