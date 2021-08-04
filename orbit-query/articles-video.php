<div id="<?php _e( $atts['id'] );?>" class="orbit-post-grid btp-videos" data-target="article.post-card" data-url="<?php _e( $atts['url'] );?>">
	<?php while( $this->query->have_posts() ) : $this->query->the_post();?>
        <?php $post_type = get_post_type();?>
        <article class='post-card <?php _e($post_type);?>'>
            <?php get_template_part( 'template-parts/orbit/video' );?>
        </article>
	<?php endwhile;?>
</div>