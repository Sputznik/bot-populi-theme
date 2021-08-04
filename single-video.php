<?php 
    get_header(); 
    $image = get_the_post_thumbnail_url();
?>

<div class="featured" style="background-image: url('<?php _e($image);?>')">
    <div class="featured-overlay"></div>
</div>

<div class="container overlay-div">
    <div class="row">
        <div class="col-md-12">
            <?php if(have_posts()): while ( have_posts() ) : the_post(); 
                $current_post_id = get_the_ID();
                $videos = btp_get_videos($current_post_id);
                $video_embed = get_post_meta($current_post_id, 'btp_video_url',true);
            ?>
            <h1 class="post-title"><?php the_title();?></h1>
            <div class="page-title-separator"></div>
            
            <div class="content-row row">
                <div class="col-md-8">
                    <div class="post-content">
                        <!-- Render Embeded Video-->
                        <div class="btp-soundcloud-embed">
                            <?php _e($video_embed);?>
                        </div>

                        <?php the_content(); ?>
                    </div>
                    <?php do_shortcode('[btp_back_btn text="BACK TO VIDEOS" slug="'. get_the_permalink(get_page_by_path('videos')) .'"]');?>
                </div>
                <div class="col-md-4">
                    <div class="episode-list-container">
                        <div class="title">Other Videos</div>
                        <?php if( is_array($videos) && count($videos) ) : ?>

                        <table class="table">
                        
                        <?php foreach( $videos as $video ) : ?>
                            <tr class="<?php $current_post_id == (int) $video->ID ? _e('active') : '';?>">
                                <td><?php //_e($video['episode_number']);?></td>
                                <td><a href="<?php _e(get_permalink($video->ID));?>"> <?php _e($video->post_title);?> </a></td>
                            </tr>
                        <?php endforeach;?>
                        
                        </table>
                        <?php endif;?>
                    </div>
                </div>
            </div>                
            <?php endwhile; endif; ?>    
        </div>
    </div>
</div>

<?php get_footer(); ?>
