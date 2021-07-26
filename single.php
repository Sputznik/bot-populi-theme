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
                <?php _e(get_the_date( 'F j, y' ));?> | <?php echo do_shortcode('[rt_reading_time postfix="min" postfix_singular="min"]'); ?> read
            </div>
            
            <h1 class="post-title"><?php the_title();?></h1>
            
            <div class="post-excerpt"><?php the_excerpt(); ?></div>
            
            <div class="post-author-link">
                <span style="font-size:1.125em">By</span> <a class="post-author" href="<?php _e(get_author_posts_url($post->post_author)); ?>"> <?php the_author();?></a>
                <?php $summary = get_post_meta( get_the_ID(), 'btp_post_summary', true );
                    if($summary && strlen($summary) > 1 ) : 
                ?>
                <a data-toggle="collapse" class="float-right" href="#collapseSummary">
                    Summary &nbsp;&nbsp;<i class="fas fa-angle-down"></i>
                </a>
                <div class="collapse" id="collapseSummary">
                    <?php _e($summary); ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="page-title-separator"></div>
            
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

<?php get_footer(); ?>
