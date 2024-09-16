
    
        <?php the_tags('', '', ''); ?>
    

<div class="clearboth"></div>


<?php if( has_filter( 'mellis_share_social' ) ){ ?>
    <div class="share_social">
    	<div class="ova_label">
    		<?php esc_html_e('Share: ', 'mellis'); ?>
    	</div>
    	<?php echo apply_filters('mellis_share_social', get_the_permalink(), get_the_title() ); ?>
    </div>
<?php } ?>
