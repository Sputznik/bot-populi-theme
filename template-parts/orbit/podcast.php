<?php
    $post_id = get_the_ID();
    $permalink = get_the_permalink();
    $thumbnail = get_the_post_thumbnail_url(get_the_ID());
    $total_episodes = get_post_meta($post_id, 'btp_podcast_total_episodes', true);
    $hosted_by = get_post_meta($post_id, 'btp_podcast_host', true);


?>

<a class="feat-img" style="background-image:url('<?php _e( $thumbnail );?>')" data-id="<?php _e( $post_id );?>" href="<?php _e( $permalink );;?>"></a>

<div class="content-wrap">
	<a class="title" data-id="<?php _e( $post_id );?>" href="<?php _e( $permalink );?>"><?php the_title();?></a>
	<div>
        <span class="host">Hosted by <?php _e( $hosted_by );?></span>
        <span class="meta"> <?php _e(get_the_date('F j, Y'));?> | <?php _e( $total_episodes );?> episodes</span>
    </div>
</div>
