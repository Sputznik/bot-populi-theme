<?php 
    get_header(); 
    $image = get_the_post_thumbnail_url();
?>

<div class="featured" style="background-image: url('<?php _e($image);?>')">
    <div class="featured-overlay"></div>
</div>
<div class="container overlay-div">
	<div class="row">
		<div class="col-sm-12">
        <?php if(have_posts()): while ( have_posts() ) : the_post(); ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
            <div class="page-title-separator"></div>
            <div class="page-description"><?php the_content(); ?></div>
            <div class="orbit-posts-wrapper"> <?php 
                $output = do_shortcode('[orbit_query post_type="episode" post_parent__in="'. $post->ID .'" pagination="1" style="episode" posts_per_page="6" order="ASC" back_btn="1" back_btn_title="Back to Podacasts" back_btn_slug="/podcast"]');

                echo $output; ?>
            </div>
        <?php endwhile; endif;?>                
		</div>
	</div>
</div>

<?php get_footer(); ?>
