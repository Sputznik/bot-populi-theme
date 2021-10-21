<div class="orbit-dropdown" data-behaviour="ccep-dropdown">
  <?php include( 'button.php' );?>
  <ul class="orbit-dropdown-menu select" data-field-type="select" role="menu" aria-labelledby="menu1">
		<li>
      <input type="radio" name="<?php _e( $args['name'] );?>" id="<?php _e( $args['name']."_default" );?>" value="">
      <label for="<?php _e( $args['name']."_default" );?>"><?php _e( isset( $args['default_option'] ) ? $args['default_option'] : "Select" ); ?></label>
    </li>
		<?php foreach( $args['items'] as $item ): if( isset( $item['slug'] ) && $item['slug'] ):?>
    <li class="checkbox">
      <input type="radio" name="<?php _e( $args['name'] );?>" id="<?php _e( $item['slug'] ); ?>" value="<?php _e( $item['slug'] ); ?>" <?php if( isset( $args['value'] ) && $item['slug'] == $args['value'] ){_e("checked");}?>>
      <label for="<?php _e( $item['slug'] ); ?>"><?php _e( $item['name'] ); ?></label>
    </li>
    <?php endif;endforeach;?>
  </ul>
</div>
