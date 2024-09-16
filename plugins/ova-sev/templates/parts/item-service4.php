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
	$class_icon  = get_post_meta( $id, 'ova_sev_met_icon', true );
	$title       = get_the_title();
	$description = get_the_excerpt();
	$show_des    = isset($args['show_description']) ? $args['show_description'] : 'yes';

	$count = $args['count'];

?>
	

    <div class="ova-service-box ova-service-box-template4">

    	<span class="count">
			<?php printf('%02s', $count); ?>
		</span>

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
        
        <?php if( $show_des == 'yes' ) { ?>
			<?php if (!empty( $description )): ?>
				<p class="description">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif;?>
		<?php } ?>

	</div>	    