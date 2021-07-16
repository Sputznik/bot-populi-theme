<?php 
    get_header(); 
    $category = get_queried_object();
    $image = get_term_meta($category->term_id, 'btp_category_image', true);
?>

<div class="featured" style="background:linear-gradient(
360deg, #000000 0%, rgba(0, 0, 0, 0) 100%), url('<?php _e($image);?>')">
    <div class="featured-overlay"></div>
</div>
<div class="container overlay-div">
	<div class="row">
		<div class="col-md-12">
            <h1 class="page-title"><?php _e( $category->name );?></h1>
            <div class="page-title-separator"></div>
            <p class="page-description"><?php _e( $category->category_description ); ?></p>
            <div class="orbit-posts-wrapper"> <?php 
                $output = do_shortcode('[orbit_query post_type="post,podcast,episode,video" cat="'. $category->term_id .'" pagination="1" style="card" posts_per_page="6" back_btn="1" back_btn_title="Back to Section" back_btn_slug="/category"]');

                echo $output; ?>
            </div>
                
                
		</div>
	</div>
</div>

<?php wp_footer(); ?>
