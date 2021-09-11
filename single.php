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
            <div class="post-date">
                <?php _e(get_the_date( 'F j, y' ));?> | <?php echo do_shortcode('[rt_reading_time postfix="min" postfix_singular="min read"]'); ?>
            </div>

            <h1 class="post-title"><?php the_title();?></h1>

            <div class="post-excerpt"><?php the_excerpt(); ?></div>

            <div class="post-author-link">
                <div>    
                    <span style="font-size:1.125em">By</span>
                    <span class="post-author"> <?php
                        if ( function_exists( 'coauthors_posts_links' ) ) {
                            coauthors_posts_links();
                        } else {
                            the_author_posts_link();
                        } ?>
                    </span>
                </div>
                <?php 
                    $summary = get_post_meta( get_the_ID(), 'btp_post_summary', true );
                ?>
                <div class="summary-wrapper">
                    <?php if($summary && strlen($summary) > 1 ) : ?>
                        <a data-toggle="collapse" class="" href="#collapseSummary">
                        Summary &nbsp;&nbsp;<i class="fas fa-angle-down"></i>
                        </a>
                    <?php endif; ?>

                    <ul class="d-block d-md-none btp-social-icons list-unstyled list-inline">
                        <li class="list-inline-item social-icon"><a href="#"><i class="fas fa-link"></i></a></li>
                        <li class="list-inline-item social-icon"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item social-icon"><a href="#"><i class="far fa-envelope"></i></a></li>
                        <li class="list-inline-item social-icon"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
                
            </div>
            <div class="collapse" id="collapseSummary">
                    <?php _e($summary); ?>
            </div>

            <div class="social-share-aside clearfix">
                <ul class="btp-social-icons list-unstyled">
                    <li class="social-icon"><a href="#"><i class="fas fa-link"></i></a></li>
                    <li class="social-icon"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="social-icon"><a href="#"><i class="far fa-envelope"></i></a></li>
                    <li class="social-icon"><a href="#"><i class="fab fa-twitter"></i></a></li>
                </ul>
            </div>

            <div class="page-title-separator"></div>
            
            <div class="progress-container">
                <div class="progress-indicator"></div>
            </div>

            <div class="post-content"><?php the_content(); ?></div>

            <div class="post-tags"> <?php
                $tags = get_the_tags();
                if($tags) : ?>
                    <ul class="post-tag-pills"> <?php
                    foreach($tags as $tag) {
                        $tag_link = get_term_link( $tag );

                        if ( is_wp_error( $tag_link ) ) {
                            continue;
                        }

                        echo '<li><a href="' . esc_url( $tag_link ) . '">#' . $tag->name . '</a></li>';
                    } ?>
                    </ul> <?php
                endif; ?>
            </div>

            <div class="page-title-separator"></div>

            <?php get_template_part('template-parts/post/author-box')?>

        <?php endwhile; endif; ?>
        </div>
    </div>
</div>

<div class="container similar-content">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title text-center">Articles you might be interested in</h2>
            <?php 
                $categories = wp_get_post_categories($post->ID, ['ids']);
                $cats_str = implode(',', $categories);
                
                $output = do_shortcode('[orbit_query post_type="post" cat="'. $cats_str .'"  style="card" posts_per_page="3" post__not_in="'. $post->ID .'"]');

                echo $output;
            ?>
        </div>
    </div>
    

</div>

<?php get_footer(); ?>
