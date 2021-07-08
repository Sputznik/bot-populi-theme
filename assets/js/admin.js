/*
* AUTOCOMPLETE WRAPPER BUILT ON JQUERY AUTOCOMPLETE
*/
jQuery.fn.btp_autocomplete = function(){

	return this.each(function() {

		var $el 	= jQuery( this ),
			$hidden = jQuery( document.createElement('input') ),
			$label	= jQuery( document.createElement('label') ),
			field 	= $el.attr( 'data-field' ),
			$input 	= jQuery( document.createElement('input') );

		// JSON PARSE FROM STRING
		field = typeof field != 'object' ? JSON.parse( field ) : [];

		var init = function(){

			if( field['label'] ){
				$label.html( field['label'] );
				$label.appendTo( $el );
			}


			$hidden.attr( 'type', 'hidden' );
			if( field['slug'] != undefined ){
				$hidden.attr( 'name', field['slug'] );
			}
			if( field['value'] != undefined ){
				$hidden.val( field['value'] );
			}
			$hidden.appendTo( $el );

			$input.attr( 'type', 'text' );
			if( field['placeholder'] != undefined ){
				$input.attr( 'placeholder', field['placeholder'] );
			}
			if( field['autocomplete_value'] != undefined ){
				$input.val( field['autocomplete_value'] );
			}
			$input.appendTo( $el );

			$input.autocomplete({
				minLength: 1,
				delay: 500,
				source: function( request, response ){
					// AJAX REQUEST
					jQuery.ajax({ url: field['url'], dataType: "json", data:{ term: request.term },
						success: function( data ){
							response(data);
						}
					});
				},
				select: function( event, ui ){
                	$hidden.val( ui.item.id );
				},
				change: function( event, ui ){
					if( !ui.item ){
						$hidden.val( '0');
					}
				}
			});
		};

		init();

	});
};


/**
 * handles category featured image events 
 */
jQuery.fn.btp_taxonomy_image = function() {
	
	return this.each(function() {
	
		var $el = jQuery(this),
			$image_container = jQuery('#category-image-container'),
			$delete_btn = $el.next(), 
			$image = jQuery(document.createElement('img'));
		
			
		$image.attr('style', 'max-width:100%');

		$el.click(function(e){
			e.preventDefault();

			btp_tax_media = wp.media({
				title: 'Category Featured Image',
				button: {
					text: 'Select this image'
				},
				multiple: false
			}).on('select', function() {
				var attachment = btp_tax_media.state().get('selection').first().toJSON();
				
				jQuery('#btp_category_image').val(attachment.url);
								
				$image.attr('src', attachment.url);
				$image_container.show().html($image);
				$delete_btn.show();
			})
			.open();

		});

		$delete_btn.click(function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			jQuery('#btp_category_image').val('');
			jQuery('#category-image-container').hide();
			$delete_btn.hide();
		});
	});
};

jQuery( document ).ready( function(){
    jQuery('[data-behaviour~=btp-autocomplete]').btp_autocomplete();
	jQuery('[data-behaviour~=btp-taxonomy-image]').btp_taxonomy_image();
});
