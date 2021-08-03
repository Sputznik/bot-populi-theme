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
                $post_parent_id = wp_get_post_parent_id( $current_post_id );
                $episodes = getEpisodesList($post_parent_id);
                $soundcloud_embed = get_post_meta($current_post_id, 'btp_episode_url',true);
            ?>
            <h1 class="post-title"><?php the_title();?></h1>
            <div class="page-title-separator"></div>
            
            <div class="content-row row">
                <div class="col-md-8">
                    <div class="post-content">
                        <!-- Render SoundCloud Embed Code-->
                        <div class="btp-soundcloud-embed">
                            <?php _e($soundcloud_embed);?>
                        </div>

                        <!-- Render Episode List for Mobile View -->
                        <div class="d-block d-md-none episode-list-container mobile">
                            <div class="title" data-toggle="collapse" data-target="#collapsableEpisodeList" aria-expanded="false" aria-controls="collapsableEpisodeList">
                                Episodes
                                <i class="fas fa-angle-down float-right"></i>
                            </div>
                            
                            <?php if( is_array($episodes) && count($episodes) ) : ?>
                            <table class="table collapse" id="collapsableEpisodeList">
                            <?php foreach( $episodes as $episode ) : ?>
                                <tr class="<?php $current_post_id == (int) $episode['ID'] ? _e('active') : '';?>">
                                    <td>Ep. <?php _e($episode['episode_number']);?></td>
                                    <td><a href="<?php _e(get_permalink($episode['ID']));?>"> <?php _e($episode['post_title']);?> </a></td>
                                </tr>
                            <?php endforeach;?>
                            </table>
                            <?php endif;?>
                        </div>

                        <?php the_content(); ?>
                    </div>
                    <?php do_shortcode('[btp_back_btn text="BACK TO PODCAST SERIES" slug="'. get_the_permalink($post_parent_id) .'"]');?>
                </div>
                <div class="col-md-4">
                    <div class="d-none d-md-block episode-list-container">
                        <div class="title">Episodes</div>
                        <?php if( is_array($episodes) && count($episodes) ) : ?>

                        <table class="table">
                        
                        <?php foreach( $episodes as $episode ) : ?>
                            <tr class="<?php $current_post_id == (int) $episode['ID'] ? _e('active') : '';?>">
                                <td>Ep. <?php _e($episode['episode_number']);?></td>
                                <td><a href="<?php _e(get_permalink($episode['ID']));?>"> <?php _e($episode['post_title']);?> </a></td>
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
