<?php
    if ( has_post_thumbnail()  && ! post_password_required() || has_post_format( 'image') )  :
      the_post_thumbnail( apply_filters( 'mellis_blog_thumbnail_size','full' ), array('class'=> 'img-responsive' ));
    endif;
?>
