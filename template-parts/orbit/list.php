<?php
    $post_id = get_the_ID();
    $permalink = get_the_permalink();
    $thumbnail = get_the_post_thumbnail_url(get_the_ID());
    
?>

<a class="feat-img" style="background-image:url('<?php _e($thumbnail);?>')" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);;?>"></a>

<div class="content-wrap">
    <div>
        <a class="title" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);?>"><?php the_title();?></a>
        <div class="post-excerpt"><?php the_excerpt();?></div>    
    </div>
	<div class="meta">
        <?php btp_get_categories($post_id);?>
        <?php _e(get_the_date( 'F j' ));?> | <?php echo do_shortcode('[rt_reading_time postfix="min" postfix_singular="min"]'); ?> read | <?php _e(get_the_author());?>
    </div>
</div>

