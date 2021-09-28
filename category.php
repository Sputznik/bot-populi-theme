<?php
get_header();
$category = get_queried_object();
$image = get_term_meta($category->term_id, 'btp_category_image', true);
?>

<div class="featured" style="background-image: url('<?php _e($image); ?>')">
    <div class="featured-overlay"></div>
</div>
<div class="container overlay-div">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-title"><?php _e($category->name); ?></h1>
            <div class="page-title-separator"></div>
            <div class="page-description"><?php _e($category->category_description); ?></div>
            <div class="orbit-posts-wrapper"> <?php
                $output = do_shortcode('[orbit_query post_type="post,podcast,episode,video" cat="' . $category->term_id . '" pagination="1" style="card" posts_per_page="6" button="1" button_title="Back to Sections" button_slug="/sections"]');

                echo $output; ?>
            </div>
        </div>
    </div>
</div>
<div class="container similar-categories">
    <div class="row">
        <div class="col-md-12">
            <?php
                $categories = get_categories(['exclude' => $category->term_id]);
                shuffle($categories);
                $categories = array_slice( $categories, 0, 4);
            ?>
            <h2 class="title">See other sections</h2>
            <div class="wrapper">
                <?php foreach( $categories as $category ) : $permalink = get_category_link($category->term_id);
                      $category_image = get_term_meta( $category->term_id, 'btp_category_image', true  );  ?>
                    <div class="category-item">
                        <a href="<?php _e( $permalink ); ?>">
                          <div class="aside" <?php if( !empty( $category_image ) ){ echo 'style="background-image: url('.$category_image.');"'; } ?>>
                          </div>
                        </a>
                        <div>
                            <div class="category-title">
                                <a href="<?php _e($permalink); ?>">
                                    <?php _e($category->name); ?>
                                </a>
                            </div>
                            <div class="description">
                                <a href="<?php _e($permalink);?>">
                                    <?php _e(wp_trim_words($category->description, 25));?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="d-block d-md-none" style="margin-top:35px">
                <button class="btp-btn">
                    <a href="<?php _e(home_url('/sections'));?>"> Back to Sections</a>
                    <i class="fas fa-long-arrow-alt-left"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
