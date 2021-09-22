<?php
    $post_id = get_the_ID();
    $permalink = get_the_permalink();
    $thumbnail = get_the_post_thumbnail_url(get_the_ID());
    $hosted_by = get_post_meta($post_id, 'btp_episode_host', true);
    $episode_duration = get_post_meta($post_id, 'btp_episode_duration', true);
    $episode_num = get_post_meta($post_id, 'btp_episode_number', true);
?>

<a class="feat-img" style="background-image:url('<?php _e($thumbnail);?>')" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);;?>"></a>

<div class="content-wrap">
	<a class="title" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);?>"><?php the_title();?></a>
	<div>
        <span class="meta">Episode <?php _e( $episode_num );?> - <?php _e($episode_duration);?> mins</span>
        <span class="host">Hosted by <?php _e($hosted_by);?></span>
    </div>
</div>
