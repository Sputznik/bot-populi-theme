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
        <?php if(have_posts()): while ( have_posts() ) : the_post(); ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
            <div class="page-title-separator"></div>
            <div class="page-description"><?php the_content(); ?></div>
            <div class="orbit-posts-wrapper"> <?php
                $output = do_shortcode('[orbit_query post_type="episode" post_parent__in="'. $post->ID .'" pagination="1" style="episode" posts_per_page="10" order="ASC" button="1" button_title="Back to Podacasts" button_slug="/podcasts"]');

                echo $output; ?>
            </div>
        <?php endwhile; endif;?>
		</div>

        <div class="col-md-12 similar-content">
            <h2 class="title">See Other Podcasts</h2>
            <?php
                $output = do_shortcode('[orbit_query post_type="podcast" post__not_in="'. $post->ID .'" style="podcast" posts_per_page="3" ]');

                echo $output;
            ?>
        </div>
	</div>
</div>

<?php get_footer(); ?>
