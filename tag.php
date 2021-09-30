<?php
    get_header();
    $tag = get_queried_object();
?>

<div class="container overlay-div">
	<div class="row">
		<div class="col-md-12">
            <h1 class="page-title">Articles Tagged Under</h1>
            <div class="tag-name"># <?php _e( $tag->name ); ?></div>
            <div class="page-title-separator"></div>
            <!--p class="page-description"><?php //_e( $tag->description ); ?></p-->
            <div class="orbit-posts-wrapper"> <?php
                $output = do_shortcode('[orbit_query post_type="post" tag="'. $tag->slug .'" pagination="1" style="list" posts_per_page="9" ]');
                echo $output; ?>
            </div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
