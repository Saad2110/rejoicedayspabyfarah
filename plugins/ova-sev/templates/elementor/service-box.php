<?php if ( !defined( 'ABSPATH' ) ) exit();

    $sevs     = ova_sev_get_services_box( $args );
    $column   = isset( $args['number_column'] ) ? $args['number_column'] : 'three_column' ;
    $count    = 0;

?>

<div class="ova-service-box-elementor <?php echo esc_attr( $number_column ) ; ?>">

	<?php if( $sevs->have_posts() ) : while ( $sevs->have_posts() ) : $sevs->the_post(); $count += 1; $args['count'] = $count;

		if( $template === 'template1' ) {
        	ovasev_get_template( 'parts/item-service.php', $args );

        } elseif( $template === 'template2' ) {
        	ovasev_get_template( 'parts/item-service2.php', $args );

        } elseif( $template === 'template3' ) {
        	ovasev_get_template( 'parts/item-service3.php', $args );

        } elseif( $template === 'template4' ) {
        	ovasev_get_template( 'parts/item-service4.php', $args );

        } else {
        	ovasev_get_template( 'parts/item-service.php', $args );
        }

	endwhile; endif; wp_reset_postdata(); ?>

</div>