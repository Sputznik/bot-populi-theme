<?php 
    get_header(); 
    global $author;
    $curauth = get_userdata(intval($author));    
    $image = BTP_DIR_URI . '/assets/images/author-banner.jpg'; 
?>

<div class="featured" style="background-image: url('<?php _e($image);?>')">
    <div class="featured-overlay"></div>
</div>
<div class="container overlay-div">
	<div class="row">
		<div class="col-md-12">
            <div class="title-wrapper">
                <h1 class="page-title"><?php _e($curauth->display_name);?></h1>
                <button class="btp-btn d-none d-md-block">
                    <a href="<?php _e(home_url('contributors'));?>"> See all Contributors</a>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </button>
            </div>
            <div class="page-title-separator"></div>
            <div class="row">
                <div class="col-md-3 user-avatar">
                    <?php _e(get_avatar($author,230));?>
                </div>
                <div class="col-md-9 description-pane">
                    <div class="bio">
                        <p><?php _e($curauth->description); ?></p>
                    </div>
                    
                    <h2 class="sub-title">Contributions</h2>
                    <div class="d-none d-md-block">
                        <?php
                            echo do_shortcode('[orbit_query post_type="post" author="'. $author .'" pagination="1" style="card" posts_per_page="6"]');
                        ?>    
                    </div>

                    <div class="d-block d-md-none">
                        <?php
                            echo do_shortcode('[orbit_query post_type="post" author="'. $author .'" pagination="1" style="card" posts_per_page="3"]');
                        ?>    
                    </div>
                    
                    <button class="btp-btn d-block d-md-none mt-4">
                        <a href="<?php _e(home_url('contributors'));?>"> See all Contributors</a>
                        <i class="fas fa-long-arrow-alt-left"></i>
                    </button>
                </div>
            </div>
            
        </div>
	</div>
</div>

<?php get_footer(); ?>
