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
	$show_des    = isset($args['show_description']) ? $args['show_description'] : 'yes';

?>

	<div class="ova-service-box ova-service-box-template3">

	    <div class="img-service">	
	    	<img src="<?php echo esc_attr( $thumbnail ) ; ?>" alt="<?php echo esc_attr( $title ); ?>">
	    </div>
	    
	    <div class="info">

	    	<div class="info-heading">
	    		<div class="icon-title">
		    		<?php if (!empty( $class_icon )): ?>
						<div class="icon">
							<i class="<?php echo esc_attr( $class_icon ); ?>"></i>
						</div>
					<?php endif;?>

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
		    	</div>

				<a class="book-button" href="<?php echo esc_url($link); ?>" <?php echo esc_attr($target); ?> title="<?php echo esc_attr( $title ); ?>">
					<i aria-hidden="true" class="fas fa-arrow-right"></i>
				</a>
	    	</div>

			<?php if( $show_des == 'yes' ) { ?>
				<?php if (!empty( $description )): ?>
					<p class="description">
						<?php echo esc_html( $description ); ?>
					</p>
				<?php endif;?>
			<?php } ?>

	    </div>

	</div>