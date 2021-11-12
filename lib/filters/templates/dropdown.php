<div class="btp-dropdown" data-behaviour="btp-dropdown-filter">
  <?php include( 'button.php' );?>
  <ul class="btp-dropdown-menu select<?php if( isset( $args['class'] )&& $args['class'] ){ _e( " ".$args['class'] ); }?>" data-field-type="select" role="menu" aria-labelledby="selection menu for <?php _e( $args['name']."_default" );?>">
		<li>
      <input type="radio" name="<?php _e( $args['name'] );?>" id="<?php _e( $args['name']."_default" );?>" value="">
      <label for="<?php _e( $args['name']."_default" );?>"><?php _e( isset( $args['default_option'] ) ? $args['default_option'] : "Select" ); ?></label>
    </li>
		<?php foreach( $args['items'] as $item ): if( isset( $item['slug'] ) && $item['slug'] ):?>
    <li class="checkbox">
      <input type="radio" name="<?php _e( $args['name'] );?>" id="<?php _e( $item['slug'] ); ?>" value="<?php _e( $item['slug'] ); ?>" <?php if( isset( $args['value'] ) && $item['slug'] == $args['value'] ){_e("checked");}?>>
      <label for="<?php _e( $item['slug'] ); ?>"><?php echo ucwords( str_replace( "-", " ", $item['name'] ) );?></label>
    </li>
    <?php endif;endforeach;?>
  </ul>
</div>
