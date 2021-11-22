<?php
/**
 * The template for displaying 404 pages (not found)
 */
get_header();
global $btp_customize;
$option = $btp_customize->get_option();
?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php
      	// CHECK IF THE 404 TEMPLATE IS SET FROM THE THEME CUSTOMIZER
      	if( !isset( $option['404_template'] ) || !$option['404_template'] || ( $option['404_template'] === 'default' ) ):
          get_template_part( 'template-parts/default-404' );
        else:
          $query = new WP_Query( 'pagename='.get_page_by_path( $option['404_template'] )->post_name );
          while ( $query->have_posts() ) : $query->the_post(); the_content(); endwhile;
          wp_reset_postdata();
        endif;
      ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
