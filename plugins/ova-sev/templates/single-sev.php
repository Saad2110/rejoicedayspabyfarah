<?php if ( !defined( 'ABSPATH' ) ) exit();

get_header( );

$id = get_the_ID();

?>

<div class="row_site">
	<div class="container_site">

		<div class="service_single">
			
			<div class="content">  
				
				<?php if( have_posts() ) : while( have_posts() ) : the_post();
					the_content();
		 		?>	
		 		<?php endwhile; endif; wp_reset_postdata(); ?>

			</div>
			
		</div>

	</div>
</div>

<?php get_footer( );