<!-- BTP SOW BUTTON WIDGET -->
<?php
  $image_url = !empty( $instance['image'] ) ? wp_get_attachment_url( $instance['image'] ) : '';
  $widget_id = getUniqueID( $instance );
  $modal_title = !empty( $instance['modal_title'] ) ? $instance['modal_title'] : "Contribute";
?>
<?php if( !empty( $instance['btn_text'] ) && $instance['btn_text'] ): ?>
<span data-toggle='modal' class="btp-modal-btn" data-target="<?php _e( '#modal-'.$widget_id );?>">
  <span><?php _e( $instance['btn_text'] );?></span>
  <ion-icon name="arrow-forward-outline"></ion-icon>
</span>
<div id="<?php _e( 'modal-'.$widget_id );?>" class="modal fade btp-img-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      <div class="modal-header">
        <h4 class="headline"><?php _e( $modal_title );?></h4>
        <a id="close" data-toggle="modal" data-target="<?php _e( '#modal-'.$widget_id );?>" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
      </div>
      <div class="modal-body">
        <div class="btp-card-body">
          <div class="thumbnail-bg" style="background-image: url(<?php _e( $image_url );?>);"></div>
          <div class="meta">
            <div class="bio"><?php _e( $instance['description'] );?></div>
          </div>
        </div>
      </div><!-- Modal Body -->
		</div>
	</div>
</div>
<?php endif; ?>
