<?php

  $search_query = ! empty( $_GET[ 'q' ] ) ? $_GET[ 'q' ] : '';
  $has_params = isset( $_GET ) && $_GET ? true : false;

?>
<div class="archive-search-wrapper">
  <h1 class="page-title">ARCHIVES</h1>
  <h6 class="page-subtitle">Search for a word, filter using advanced search</h6>
  <form method="GET" class="archive-search">
    <div class="d-flex flex-row flex-grow-1">
      <button class="btn border-right-0 rounded-0 rounded-right btn-search" type="submit">
        <i class="fa fa-search"></i>
      </button>
      <input class="form-control pl-0 border-left-0 rounded-0 search-input" name="q" placeholder="Search All Archives" value="<?php _e( $search_query ); ?>" autocomplete="off">
    </div>
    <h2 class="filter-title">Filters</h2>

    <div class="sort-wrapper">

      <?php
        // GET ALL THE FILTERS
        $filters = $this->getFilters();

        foreach ( $filters as $key => $atts ) {
          /* SET FORM NAME AND FORM VALUE */
      		$atts['name'] = $atts['typeval'];
      		if( isset( $_GET[ $atts['name'] ] ) ){
      			$atts['value'] = $_GET[ $atts['name'] ];
      		}
          get_template_part('lib/filters/templates/'.$atts['form'], null, $atts);

        }
      ?>

      <!-- APPLY FILTERS BUTTON -->
      <button class="btn btn-outline-secondary btn-apply-filters <?php if( $has_params ){ echo "active"; }?>" type="submit">APPLY FILTERS</button>
    </div>
  </form>

</div>
<div class="btp-filter-separator d-none d-md-block"></div>
<?php
  $search_chips = array(
    'search_query' => $search_query,
    'category'     => isset( $_GET['category'] ) ? $_GET['category'] : '',
    'type'         => isset( $_GET['type'] ) ? $_GET['type'] : '',
    // 'tag'          => isset( $_GET['post_tag'] ) ? $_GET['post_tag'] : '' render multiple tags
  );
?>
<?php if( $search_chips['search_query'] || $search_chips['category'] || $search_chips['type'] ):?>
  <div class="search-result-info">
    <h6 class="search-result-txt">Search results for</h6>
    <div class="search-chips">
      <ul class="list-unstyled">
        <?php foreach( $search_chips as $slug => $value ):?>
          <?php if( !empty( $value ) ):?>
            <?php if( $slug != 'search_query' ):?>
              <li class="param"><?php echo str_replace( "-", " ", $value );?></li>
            <?php else:?>
              <li class="query"><?php echo $value;?></li>
            <?php endif;?>
          <?php endif;?>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
  <div class="btp-filter-separator d-none d-md-block"></div>
<?php endif;?>
