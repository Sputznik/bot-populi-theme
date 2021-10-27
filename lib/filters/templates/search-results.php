<?php
  $has_params = BTP_SEARCH_FILTERS_FORM::paramsCount( $_GET );
  $search_chips = BTP_SEARCH_FILTERS_FORM::getResultChips( $_GET );
  $total_posts_count = $args;
?>
<?php if( $has_params ):?>
  <div class="search-result-info">
    <h6 class="search-result-txt">
      <?php echo $total_posts_count;?> Search <?php echo ( $total_posts_count <= 1 ? 'result': 'results' ) ?> for
    </h6>
    <div class="search-chips">
      <ul class="list-unstyled">
        <?php foreach( $search_chips as $slug => $value ):?>
          <?php if( !empty( $value ) ):?>
            <li class="label"><?php echo $slug.":"; ?></li>
            <?php if( $slug != 'phrase' && $slug != 'keywords' ):?>
              <li class="param">
                <?php echo str_replace( ["-",'cap'], " ", $value );?>
              </li>
            <?php elseif( $slug == 'keywords' ):?>
              <?php foreach( $value as $tag ): ?>
                <li class="param"><?php echo '# '.$tag;?></li>
              <?php endforeach; ?>
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
