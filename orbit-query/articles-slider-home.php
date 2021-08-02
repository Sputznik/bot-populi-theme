
<div id="btp-homepage-slider-<?php _e($atts['id']);?>" class="carousel slide" data-ride="carousel" data-target=".carousel-item" data-url="<?php _e( $atts['url'] );?>">
    <?php if( $this->query->have_posts()) : $temp = true ?>
        <ol class="carousel-indicators">      
        <?php for( $i=0; $i <  $atts['posts_per_page']; $i++ ) : ?>
            <li data-target="#btp-homepage-slider" data-slide-to="<?php _e($i);?>" class="<?php $temp ? _e('active'): '';?>"></li>
        <?php $temp = false; endfor;?>
        </ol>
    <?php $temp=true; endif;?>
  
    <div class="carousel-inner">
    <?php while( $this->query->have_posts() ) : $this->query->the_post();
        $featured_image = get_the_post_thumbnail_url(get_the_ID()); 
    ?>
    <div class="carousel-item <?php $temp ? _e('active'): '';?>" style="background-image:linear-gradient(
360deg, #000000 0%, rgba(0, 0, 0, 0) 100%), url('<?php _e($featured_image);?>'); height:500px; background-size: cover;
background-repeat: no-repeat;" >
      <div class="carousel-caption">
        <h5><?php the_title();?></h5>
        <a href="<?php the_permalink();?>" type="button" class="btn btn-outline-primary">Read More</a>
        
      </div>
    </div>
    <?php $temp=false; endwhile;?>
</div>