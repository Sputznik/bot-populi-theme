<?php 
//Update excerpt length to 25 words
add_filter( 'excerpt_length', function($length) { return 26; }, 999 );
?>

<div id="<?php _e( $atts['id'] );?>" class="orbit-post-grid" data-target="article.post-list" data-url="<?php _e( $atts['url'] );?>">
	<?php while( $this->query->have_posts() ) : $this->query->the_post();?>
        <?php $post_type = get_post_type();?>
        <article class='post-list <?php _e($post_type);?>'>
            <?php get_template_part( 'template-parts/orbit/list' );?>
        </article>
        <div class="page-title-separator"></div>
	<?php endwhile;?>
</div>

<?php
//Restore excerpt length back to 55 words
add_filter( 'excerpt_length', function($length) { return 55; }, 999 );
?>