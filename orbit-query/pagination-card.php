<?php if($atts['pagination'] != '0'): ?>
<div class='orbit-btn-load-parent'>
	<button data-behaviour='oq-ajax-loading' data-list="<?php _e('#'.$atts['id']);?>" class="load-more" type="button">
		Load More <i class="fas fa-long-arrow-alt-down"></i>
	</button>
	<?php if( isset($atts['back_btn']) && $atts['back_btn'] != '0' ) : ?>
		<button class="btp-back-btn">
			<a href="<?php _e(home_url($atts['back_btn_slug']));?>"> <?php _e($atts['back_btn_title']);?></a>
			<i class="fas fa-long-arrow-alt-left"></i>
		</button>
	<?php endif; ?>	
</div>
<?php endif;?>