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
            <h1 class="page-title"><?php the_title();?></h1>
            <div class="page-title-separator"></div>
            <div class="page-description"><?php the_content(); ?></div>
        <?php endwhile; endif; ?>    
		</div>
	</div>
</div>

<?php get_footer(); ?>
