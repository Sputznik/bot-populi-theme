<?php

  $search_query = ! empty( $_GET[ 'q' ] ) ? $_GET[ 'q' ] : '';
  $has_params = isset( $_GET ) && $_GET ? true : false;

  $categories = get_terms( array(
    'taxonomy'          => 'category',
    'hide_empty'        => false,
  ) );

  $tags = get_terms( array(
    'taxonomy'          => 'post_tag',
    'hide_empty'        => false,
  ) );

  $types = array( 'article', 'podcast', 'video' );

?>
<div class="archive-search-wrapper">
  <h1 class="page-title">ARCHIVES</h1>
  <h6 class="page-subtitle">Search for a word, filter using advanced search</h6>
  <form method="GET" class="archive-search" >
    <div class="d-flex flex-row flex-grow-1">
      <button class="btn border-right-0 rounded-0 rounded-right btn-search" type="submit">
        <i class="fa fa-search"></i>
      </button>
      <input class="form-control pl-0 border-left-0 rounded-0 search-input" name="q" placeholder="Search All Archives" value="<?php _e( $search_query ); ?>" autocomplete="off">
    </div>
     <h2 class="filter-title">Filters</h2>
     <div class="sort-wrapper">
       <div class="input-group">

         <!-- CATEGORIES -->
         <select name="category_name">
           <option value="all-topics">All topics</option>
           <?php  foreach( $categories as &$category  ): ?>
             <option value="<?php echo $category->slug; ?>" <?php echo $category->slug == get_query_var( 'category_name', false ) ? 'selected' : null; ?>>
               <?php echo $category->name; ?>
             </option>
           <?php endforeach; ?>
          </select>

          <!-- TYPES -->
          <select name="type">
            <option value="all-types">All types</option>
            <?php  foreach( $types as $type  ): ?>
              <option value="<?php echo $type; ?>" <?php echo $type == get_query_var( 'type', false ) ? 'selected' : null; ?>>
                <?php echo ucwords($type); ?>
              </option>
            <?php endforeach; ?>
           </select>

           <!-- KEYWORDS -->
           <select name="tag">
             <option value="all-keywords">All keywords</option>
             <?php  foreach( $tags as $tag  ): ?>
               <option value="<?php echo $tag->slug; ?>" <?php echo $tag->slug == get_query_var( 'tag', false ) ? 'selected' : null; ?>>
                 <?php echo $tag->name; ?>
               </option>
             <?php endforeach; ?>
            </select>

         <!-- APPLY FILTERS BUTTON -->
         <div class="input-group-prepend">
           <button class="btn btn-outline-secondary btn-sort btn-apply-filters <?php if( $has_params ){ echo "active"; }?>" type="submit">APPLY FILTERS</button>
         </div>

       </div>
     </div>

   </form>

</div>
<div class="btp-filter-separator d-none d-md-block"></div>
<?php
  $search_chips = array(
    'search_query' => $search_query,
    'category'     => isset( $_GET['category_name'] ) ? $_GET['category_name'] : '',
    'type'         => isset( $_GET['type'] ) ? $_GET['type'] : '',
    'tag'          => isset( $_GET['tag'] ) ? $_GET['tag'] : ''
  );
?>
<?php if( $has_params ):?>
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
