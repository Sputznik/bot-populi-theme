jQuery.fn.btp_image_popup = function() {

	return this.each(function() {

		var $el           = jQuery(this),
        $image        = $el.find('.thumbnail-bg'),
				imageUrl			=	$image.attr('style'),
				popupType			=	$el.data('behaviour'),
        name          = $el.find('.name').text(),
        bio           = $el.find('.bio').html(),
				web  					= $el.data('website');

    // CREATES DYNAMIC USER MODAL
		$el.on( 'click', function() { $el.createModal(); });

    // BTP USER MODAL LAYOUT
    $el.createModal = function() {

      html = `
      <div class="modal fade btp-img-modal" id="${popupType}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
							<h4 class="headline">${popupType == 'btp-user-popup' ? 'About the team' : 'About the Organisation'}</h4>
              <a id="close" data-toggle="modal" data-target="#${popupType}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
            </div>
            <div class="modal-body">
              <div class="btp-card-body">
                <div class="thumbnail-bg" style="${imageUrl}"></div>
                <div class="meta">
                  <div class="bio">${bio}</div>
									${web ? `<a class="btn-web" href="${web}" target="_blank">
											<span>See Website</span>
											<i class="fas fa-long-arrow-alt-right"></i>
										</a>` : ''}
                </div>
              </div>
            </div><!-- Modal Body -->
          </div><!-- Modal Content -->
        </div><!-- Modal Dialog -->
      </div>
      `;

      jQuery("body").append(html);
			jQuery(`#${popupType}`).modal('show');
    }

    // REMOVES MODAL FROM THE DOM
    jQuery(document).on('hidden.bs.modal', function () {
			jQuery(`#${popupType}`).remove();
      jQuery('.modal-backdrop.in').remove();
		});


	}); //End each()

};

jQuery(document).ready(function () {

	jQuery('div[data-behaviour~=btp-user-popup]').btp_image_popup();
	jQuery('div[data-behaviour~=btp-organization-popup]').btp_image_popup();

});
