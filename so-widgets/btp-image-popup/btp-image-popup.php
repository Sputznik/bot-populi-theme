<?php
/*
	Widget Name: BTP Image Popup
	Description: Image grid with popup.
	Author: Stephen Anil, Sputznik
	Author URI:	https://sputznik.com
	Widget URI:
	Video URI:
*/
class BTP_Image_Popup extends SiteOrigin_Widget {

	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'btp-image-popup',
			// The name of the widget for display purposes.
			__('BTP Image Popup', 'siteorigin-widgets'),
			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Image grid with popup.'),
				'help'        => '',
			),
			//The $control_options array, which is passed through to WP_Widget
			array(),
			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'popup_type' => array(
	        'type'    => 'select',
	        'label'   => __( 'Choose Type', 'siteorigin-widgets' ),
	        'options' => array(
						'btp-user-popup'					=> 'User',
						'btp-organization-popup'	=> 'Organization',
					),
					'state_emitter' => array(
	        	'callback' 	=> 'select',
	        	'args' 			=> array( 'popup_type' )
	    		),
	      ),
				'btp_img_grid' => array(
					'type' 	=> 'repeater',
					'label' => __( 'Panels' , 'siteorigin-widgets' ),
					'item_label' => array(
						'selector' => "[id*='name']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'image' => array(
							'type' 		=> 'media',
							'label' 	=> __( 'Choose Image', 'siteorigin-widgets' ),
							'choose' 	=> __( 'Choose image', 'siteorigin-widgets' ),
							'update' 	=> __( 'Set image', 'siteorigin-widgets' ),
							'library' 	=> 'image',
							'fallback' 	=> false
						),
						'name' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Name', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'description' => array(
			        'type' => 'tinymce',
			        'label' => __( 'Description', 'siteorigin-widgets' ),
			        'default' => '',
			        'rows' => 10,
			        'default_editor' => 'tinymce'
				    ),
						'website' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Website', 'siteorigin-widgets' ),
							'default' 	=> '',
							'state_handler' => array(
				        'popup_type[btp-user-popup]' => array('hide'),
				        'popup_type[btp-organization-popup]' => array('show')
				    	),
						),
					)
				),
			),
			//The $base_folder path string.
			get_template_directory()."/so-widgets/btp-image-popup"
		);
	}

	function get_template_name($instance) {
		return 'template';
	}
	function get_template_dir($instance) {
		return 'templates';
	}
  function get_style_name($instance) {
      return '';
  }
}
siteorigin_widget_register('btp-image-popup', __FILE__, 'BTP_Image_Popup');
