<?php
    $post_id = get_the_ID();
    $permalink = get_the_permalink();
    $thumbnail = get_the_post_thumbnail_url($post_id);
    $byline = get_post_meta($post_id, 'btp_video_byline', true);
?>

<?php include __DIR__ . '/../commons/video-thumbnail-overlay.php'; ?>

<div class="content-wrap">
	<a class="title" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);?>"><?php the_title();?></a>
	<div>
        <p class="authors"><?php _e($byline);?></p>
        <span class="meta"><?php _e(get_the_date( 'F j' ));?></span>
    </div>
</div>