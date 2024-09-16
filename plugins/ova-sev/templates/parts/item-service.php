<?php if ( !defined( 'ABSPATH' ) ) exit();

	if ( isset( $args['id'] ) && $args['id'] ) {
		$id = $args['id'];
	} else {
		$id = get_the_id();
	}

    // link
    $link        =  get_the_permalink();
    $target      = '';
    if ( isset( $args['custom_link'] ) && ( 'new_page' == $args['link'] ) ) {
		$link 	= $args['custom_link']['url'];
		$target = $args['custom_link']['is_external'] ? "target='_blank'" : '' ;
	}
    
    // content
    $thumbnail   = wp_get_attachment_image_url( get_post_thumbnail_id( $id ), 'mellis_thumbnail' );

    if ( $thumbnail == '') {
    	$thumbnail   =  \Elementor\Utils::get_placeholder_image_src();
    }

	$class_icon  = get_post_meta( $id, 'ova_sev_met_icon', true );
	$title       = get_the_title();
	$description = get_the_excerpt();
	$text_button = isset($args['text_button']) ? $args['text_button'] : esc_html__('Book Now','ova-sev');
	$show_des    = isset($args['show_description']) ? $args['show_description'] : 'yes';

	// background image
	$background_image = '';
	if ( isset( $args['background_image'] ) && !empty( $args['background_image']['url']) ) {
		$background_image = $args['background_image']['url'];
	}
    

?>

	<div class="ova-service-box ova-service-box-template1">

		<?php if ( $background_image != '' ) : ?> 
		    <div class="mask" style="background-image: url(<?php echo esc_attr( $background_image ) ; ?>)"></div>
	    <?php endif;?>

	    <div class="img-service">	
	    	<img src="<?php echo esc_attr( $thumbnail ) ; ?>" alt="<?php echo esc_attr( $title ); ?>">
	    	<?php if (!empty( $class_icon )): ?>
				<div class="icon">
					<i class="<?php echo esc_attr( $class_icon ); ?>"></i>
				</div>
			<?php endif;?>
	    </div>
	    
	    <div class="info">
	    	<?php if (!empty( $link )): ?>
				<a href="<?php echo esc_url($link); ?>" <?php echo esc_attr($target); ?> title="<?php echo esc_attr( $title ); ?>">
			<?php endif;?>

		        <?php if (!empty( $title )): ?>
					<h4 class="title">
						<?php echo esc_html( $title ); ?>
					</h4>
				<?php endif;?>

			<?php if (!empty( $link )): ?>
				</a>
			<?php endif;?>
           
            <?php if( $show_des == 'yes' ) { ?>
				<?php if (!empty( $description )): ?>
					<p class="description">
						<?php echo esc_html( $description ); ?>
					</p>
				<?php endif;?>
			<?php } ?>

			<a class="book-button" href="<?php echo esc_url($link); ?>" <?php echo esc_attr($target); ?> title="<?php echo esc_attr( $title ); ?>">
				<?php echo esc_html($text_button);?>
				<i class="flaticon flaticon-right-arrow"></i>
			</a>
	    </div>

	</div>