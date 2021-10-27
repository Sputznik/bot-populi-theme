<?php
/**
 * Template Name: Archive Page
 *
 */

  get_header();
  $image = get_the_post_thumbnail_url();
  $search_query = ! empty( $_GET[ 'phrase' ] ) ? $_GET[ 'phrase' ] : '';
  $paged = (  get_query_var('paged')  ) ? get_query_var('paged') : 1;
  $tax_query = array( 'relation' => 'OR' );
  $args = array(
    'paged'     => $paged,
    'post_type' => isset( $_GET['type'] ) && $_GET['type'] != '' ? ( $_GET['type'] == 'article' ? 'post' : $_GET['type'] ) : array('post','podcast','video'),
    's' => $search_query,
    'post_status' =>'publish'
  );

  // SORT PARAMETER
  if( isset( $_GET['sort'] ) && $_GET['sort'] ){
    $args['orderby'] = "date";
    $args['order'] = $_GET['sort'];
  }

  // TAX QUERY
  if( isset( $_GET['section'] ) && $_GET['section'] ){
    array_push( $tax_query, array(
      'taxonomy' => 'category',
      'field' => 'slug',
      'terms' => $_GET['section'],
    ) );
  }

  if( isset( $_GET['keywords'] ) && $_GET['keywords'] ){
    array_push( $tax_query, array(
      'taxonomy' => 'post_tag',
      'field' => 'slug',
      'terms' => $_GET['keywords'],
    ) );
  }

  if( !empty( $tax_query ) ){
    $args['tax_query'] = $tax_query;
  }

  $query = new WP_Query( $args );

  add_filter( 'excerpt_length', function( $length ) { return 26; }, 999 );
?>
<div class="featured" style="background-image: url('<?php _e( $image );?>')">
  <div class="featured-overlay"></div>
</div>
<div class="container overlay-div">
  <div class="row">
    <div class="col-sm-12">
      <?php _e( do_shortcode('[btp_filters]') );?>
      <?php get_template_part('lib/filters/templates/search-results', null, $query->found_posts );?>
      <?php if( $query->have_posts() ) : ?>
      <div class="orbit-posts-wrapper template-archive">
        <div class="orbit-post-grid">
          <?php while( $query->have_posts() ) : $query->the_post(); ?>
            <?php $post_type = get_post_type();?>
            <article class='post-list <?php _e($post_type);?>'>
              <?php get_template_part( 'template-parts/archive' );?>
            </article>
          <?php endwhile;?>
        </div>
        <?php
          $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
          the_posts_pagination(
            array(
              'mid_size' 	=> 1,
              'prev_text' => __( 'Prev' ),
              'next_text' => __( 'Next' ),
              'screen_reader_text' => __( ' ' ),
            )
          );
          wp_reset_postdata();
        ?>
      </div>
      <?php else: ?>
        <h6 class='text-center not-found-txt'>No posts found</h6>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer();?>
