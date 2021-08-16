<!-- BTP SOW IMAGE POPUP -->
<div class="btp-img-grid">
  <?php
  $popup_type = $instance['popup_type'];
  foreach( $instance['btp_img_grid'] as $item ): $image = wp_get_attachment_url( $item['image'] );
    $web_url = ( $popup_type == 'btp-organization-popup' && !empty( $item['website'] ) ) ? $item['website'] : '';
    ?>
    <div class="btp-img-card">
      <div data-target="#<?php _e( $popup_type );?>" data-behaviour="<?php _e( $popup_type );?>" <?php if( $web_url ){ echo "data-website='".$web_url."'"; }?>>
        <div class="btp-card-body">
          <div class="thumbnail-bg" style="background-image: url( '<?php _e( $image );?> ');"></div>
          <div class="meta">
            <h5 class="name"><?php _e( $item['name'] );?></h5>
          </div>
          <div class="bio" style="display:none;height:0;">
            <?php echo $item['description'];?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach;?>
</div>
