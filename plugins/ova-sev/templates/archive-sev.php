<?php if ( !defined( 'ABSPATH' ) ) exit();

get_header();

$number_column = get_theme_mod( 'ova_sev_layout', 'three_column' );

?>

<div class="row_site">
	<div class="container_site">

		<div class="archive_sev">
			
			<div class="archive_sev_content <?php echo esc_attr( $number_column ) ; ?>">

				<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <?php ovasev_get_template( 'parts/item-service.php' ); ?>

				<?php endwhile; endif; wp_reset_postdata(); ?>

			</div>

			<?php 
	    		$args = array(
	                'type'      => 'list',
	                'next_text' => '<i class="ovaicon ovaicon-next"></i>',
	                'prev_text' => '<i class="ovaicon ovaicon-back"></i>',
	            );

	            the_posts_pagination($args);
	    	 ?>

		</div>
	</div>
</div>

<?php 
get_footer();