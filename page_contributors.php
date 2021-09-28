<?php
/**
 * Template Name: Contributors Page
 *
 */

  get_header();
  $image = get_the_post_thumbnail_url();
?>
<div class="featured" style="background-image: url('<?php _e($image);?>')">
  <div class="featured-overlay"></div>
</div>
<div class="container overlay-div">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="page-title"><?php echo get_the_title();?></h1>
      <div class="page-title-separator"></div>
      <?php if( function_exists('coauthors_posts_links') ):?>
        <ul class="btp-orbit users-grid list-unstyled">
          <?php
            global $coauthors_plus;
            $terms = get_terms( array( 'taxonomy' => 'author', 'hide_empty' => true ) );
            foreach( $terms as $term ): $contributor = $coauthors_plus->get_coauthor_by( 'user_nicename', $term->name ); ?>
            <li>
              <a href="<?php _e( get_author_posts_url( $contributor->ID, $contributor->user_nicename ) ); ?>">
                <?php //_e( get_avatar( $contributor->ID, '320', '', $contributor->display_name ) ); ?>
                <div class="author-avatar" style="background-image: url(<?php echo get_avatar_url( $contributor->ID );?>);"></div>
                <div class='orbit-user-name'>
                  <?php _e( $contributor->display_name ); ?>
                </div>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif;?>
    </div>
  </div>
</div>
<?php get_footer();?>
