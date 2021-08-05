<?php 
    get_header(); 
?>
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
                </div>
                <div class="col-md-4">
                    <div class="video-list-container">
                        <div class="title">Other Videos</div>
                        <?php if( is_array($videos) && count($videos) ) : ?>

                        <ul>
                        <?php foreach( $videos as $video ) :?>
                            <li class="video-item"> <?php 
                                $post_id = $video->ID;
                                $permalink = get_the_permalink( $post_id );
                                $thumbnail = get_the_post_thumbnail_url($post_id); 
                                include __DIR__.'/template-parts/commons/video-thumbnail-overlay.php'; ?>
                                <div class="d-flex flex-column justify-content-between">
                                    <a class="title d-block" href="<?php _e($permalink);?>"> <?php _e($video->post_title);?> </a>
                                    <span class="d-block author"><?php echo get_the_author_meta('display_name', $video->post_author);?></span>
                                </div>
                            </li>
                        <?php endforeach;?>
                        
                        </ul>
                        <?php endif;?>
                    </div>
                </div>
            </div>                
            <?php endwhile; endif; ?> 
            <div class="row">
                <div class="col-md-12 mt-4">
                <?php do_shortcode('[btp_back_btn text="BACK TO VIDEOS" slug="'. get_the_permalink(get_page_by_path('videos')) .'"]');?>
                </div>
            </div>   
        </div>
    </div>
</div>

<?php get_footer(); ?>
