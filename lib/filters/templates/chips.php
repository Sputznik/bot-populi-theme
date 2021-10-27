<div class="btp-dropdown" data-behaviour="btp-dropdown-filter">
  <?php include( 'button.php' );?>
  <ul class="btp-dropdown-menu dropdown-lg chips" data-field-type="chips" role="menu" aria-labelledby="menu1">
    <?php foreach( $args['items'] as $item ): if( isset( $item['slug'] ) && $item['slug'] ):?>
    <li class="checkbox">
      <input type="checkbox" name="<?php _e( $args['name'] );?>[]" id="<?php _e( $item['slug'] ); ?>"
        value="<?php _e( $item['slug'] ); ?>"
        <?php if( isset( $args['value'] ) && in_array( $item['slug'], $args['value'] ) ){ _e("checked"); }?>>
      <label for="<?php _e( $item['slug'] ); ?>"><?php echo '# '.$item['name']; ?></label>
    </li>
    <?php endif; endforeach;?>
  </ul>
</div>
