<?php
    $post_id = get_the_ID();
    $permalink = get_the_permalink();
    $thumbnail = get_the_post_thumbnail_url($post_id);
?>

<div class="feat-img" style="background-image:url('<?php _e($thumbnail);?>')">
    <div class="img-overlay">
        <a class="video-link" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);;?>">
            <span class="play-btn"><i class="far fa-play-circle"></i></span>
        </a>
    </div>
</div>

<div class="content-wrap">
	<a class="title" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);?>"><?php the_title();?></a>
	<div>
        <p class="authors"><?php _e(get_the_author());?></p>
        <span class="meta"><?php _e(get_the_date( 'F j' ));?></span>
    </div>
</div>
