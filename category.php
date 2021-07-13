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
            <h1 class="title"><?php _e( $category->name );?></h1>
            <div class="title-seperator"></div>
            <p><?php _e( $category->category_description ); ?></p>
            <div class="category-posts"> <?php 
                $output = do_shortcode('[orbit_query category_name="'. $category->slug .'" pagination="1" style="card" posts_per_page="6" back_btn="1" back_btn_title="Back to Section" back_btn_slug="/category"]');

                echo $output; ?>
            </div>
                
                
		</div>
	</div>
</div>

<?php wp_footer(); ?>
