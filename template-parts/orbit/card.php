<?php
    $post_id = get_the_ID();
    $permalink = get_the_permalink();
    $thumbnail = get_the_post_thumbnail_url($post_id);
?>

<a class="feat-img" style="background-image:url('<?php _e($thumbnail);?>')" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);;?>"></a>

<div class="content-wrap">
	<a class="title" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);?>"><?php the_title();?></a>
	<p class="authors"> <?php
        if ( function_exists( 'coauthors_posts_links' ) ) {
            coauthors();
        } else {
            _e(get_the_author());
        } ?>    
    </p>
	<span class="meta"><?php _e(get_the_date( 'F j' ));?> | <?php echo do_shortcode('[rt_reading_time postfix="min read"]'); ?></span>
</div>
