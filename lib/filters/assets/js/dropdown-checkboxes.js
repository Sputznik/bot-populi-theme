jQuery.fn.btp_dropdown_filter = function(){

		return this.each(function(){
			var $el 			= jQuery(this);


			// IF CLICK IS MADE OUTSIDE THE ELEMENT THEN CLOSE THE DROPDOWN
			jQuery( document ).on("click", function( event ){
	    	if( $el !== event.target && !$el.has( event.target ).length ){
	        $el.removeClass('open').toggleCaretClass();
	      }
	    });

			// TOGGLE CARET CLASS
			$el.toggleCaretClass = function(){
				if( !$el.hasClass('open') ){
					$el.find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
				}
				else {
					$el.find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
				}
			};


			// IF SOME OTHER DROPDOWNS ARE OPEN THEN CLOSE THEM
			$el.find('button').click( function(){
				var $this = jQuery( this );

	      $el.toggleClass('open').toggleCaretClass();

			});

			$el.on( 'change', function(){
				var $this = jQuery( this );
				// updateLabel();
				// console.log("Update Label");

				var fieldType = $el.getFieldType( $this );

				if( fieldType == 'select' ){
					updateSelectLabel();
				}
				else{
					updateChipsLabel();
				}

			} );

			$el.getFieldType = function( wrapper ){
				// console.log(wrapper.find("ul[data-field-type]").data('field-type'));
				return wrapper.find("ul[data-field-type]").data('field-type');
			};

			// ON LOAD - DEFAULT
			updateChipsLabel();
			updateSelectLabel();

			function decodeEntities( encodedString ) {
			  var textArea = document.createElement('textarea');
			  textArea.innerHTML = encodedString;
			  return textArea.value;
			};

			function updateSelectLabel(){
				var $select = $el.find('input[type=radio]:checked'),
						value = $select.parent().find('label').html();
				$el.removeClass('open').toggleCaretClass();
      	$el.find('span.btn-label').html( value );

				// console.log($select, value);

			}

			// UPDATE CHECKBOXES
			 function updateChipsLabel(){
				var $checkboxes = $el.find('input[type=checkbox]:checked'),
	        	values        = [];

	      if( !$el.data('btn-label') ){ $el.data('btn-label', $el.find('span.btn-label').html() ); }

	      $checkboxes.each( function(){
	        var $checkbox     = jQuery( this ),
	          checkbox_label  = decodeEntities( $checkbox.parent().find('label').html() ),
						limit						= 10,
						space_index 		= checkbox_label.indexOf(' ');

						// console.log($checkbox.parent());

					if( $checkboxes.length > 1 ){
						// IF SPACE COMES BEFORE THEN BREAK RIGHT FROM THERE
						if( space_index > 1 && space_index < 9 ){ limit = space_index; }

						if( checkbox_label.length > limit ){ checkbox_label =  checkbox_label.substring( 0, limit ) + "..";}
					}

	        values.push( checkbox_label );
	      });

	      if( values.length ){
	        $el.find('span.btn-label').html( values.join( ', ') );
	      }
	      else{
	        $el.find('span.btn-label').html( $el.data('btn-label') );
	      }
			};



		});
};

jQuery(document).ready(function(){
	jQuery('[data-behaviour~=btp-dropdown-filter]').btp_dropdown_filter();
});
