<?php
    $post_id = get_the_ID();
    $permalink = get_the_permalink();
    $thumbnail = get_the_post_thumbnail_url(get_the_ID());
    $reading_time = do_shortcode('[rt_reading_time postfix="Min Read" postfix_singular="Min Read"]');

    //gets the post type of the post ID
    if ( get_post_type($post_id) == 'post' ) $post_type = 'article';
    else $post_type = get_post_type($post_id);

    switch( get_post_type( $post_id ) ){
      case 'podcast':
        $additional_meta = $reading_time.' | '.ucwords( get_post_meta( $post_id, 'btp_podcast_host', true ) );
        break;
      case 'video':
        $additional_meta = ucwords( get_post_meta( $post_id, 'btp_video_byline', true ) );
        break;
      default:
        $author = function_exists( 'coauthors_posts_links' ) ? coauthors( null, null, null, null, false ) : get_the_author();
        $additional_meta = $reading_time.' | '.ucwords( $author );
        break;
    }

?>

<a class="feat-img" style="background-image:url('<?php _e($thumbnail);?>')" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);?>"></a>

<div class="content-wrap">
  <div>
    <a class="title" data-id="<?php _e( $post_id );?>" href="<?php _e($permalink);?>"><?php the_title();?></a>
    <div class="post-excerpt"><?php the_excerpt();?></div>
  </div>
	<div class="meta">
    <?php btp_get_categories_with_type( $post_id, ucfirst( $post_type ) );?>
    <?php _e( get_the_date( 'M j, Y' ) );?> | <?php _e( $additional_meta );?>
  </div>
</div>
