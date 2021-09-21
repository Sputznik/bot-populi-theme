<?php
    $post_count = $this->query->post_count;
    $total_frames = ((int)$this->query->post_count ) / ((int)$atts['posts_per_frame']);
?>

<div id="btp-content-slider-<?php _e($atts['id']);?>" class="btp-content-slider carousel slide" data-ride="" data-target=".carousel-item" data-url="<?php _e( $atts['url'] );?>">
    <?php if( $this->query->have_posts()) : $temp = true ?>
        <ol class="carousel-indicators">      
        <?php for( $i=0; $i <  $total_frames; $i++ ) : ?>
            <li data-target="#btp-content-slider-<?php _e($atts['id']);?>" data-slide-to="<?php _e($i);?>" class="<?php $temp ? _e('active'): '';?>"><?php _e($i + 1);?></li>
        <?php $temp = false; endfor;?>
        </ol>
    <?php $temp=true; endif;?>

    <div class="carousel-inner">
        
    <?php for( $k=0; $k< $post_count; ) : if( $this->query->have_posts() ) : ?>
        <div class="carousel-item <?php $temp ? _e('active'): '';?>" >
            <div class="orbit-post-grid"> <?php
                for($i=0;  $i < $atts['posts_per_frame']; $i++) : 
                    if( $this->query->have_posts() ) { $this->query->the_post(); ?>
                         <?php $post_type = get_post_type();?>
                        <article class='post-card <?php _e($post_type);?>'>
                            <?php get_template_part( 'template-parts/orbit/podcast' ); ?>
                        </article> <?php
                        $k++ ;
                    } else {
                        break;
                    }
                endfor;
                if( $k == $post_count ) : ?>
                    <article class="post-card read-more">
                        <a href="<?php _e(get_permalink( get_page_by_path( $atts['button_slug'] ) ));?>">
                            <?php _e($atts['button_title']);?> <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
    
                    </article>            
                <?php endif;?>
            </div>   
        </div>
    <?php $temp=false; endif; endfor;?>
    </div>
</div>
