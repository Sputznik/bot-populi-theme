<?php
  $search_query = ! empty( $_GET[ 'phrase' ] ) ? $_GET[ 'phrase' ] : '';
  $has_params = BTP_SEARCH_FILTERS_FORM::paramsCount( $_GET );
?>
<div class="archive-search-wrapper">
  <h1 class="page-title">ARCHIVES</h1>
  <h6 class="page-subtitle">Explore our past publication here! Search for a word, and filter using advanced search.</h6>
  <form method="GET" class="archive-search" action="<?php _e( $this->getCurrentURL() );?>">
    <div class="d-flex flex-row flex-grow-1">
      <button class="btn border-right-0 rounded-0 rounded-right btn-search" type="submit">
        <i class="fa fa-search"></i>
      </button>
      <input class="form-control pl-0 border-left-0 rounded-0 search-input" name="phrase" placeholder="Search All Archives" value="<?php _e( $search_query ); ?>" autocomplete="off">
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
