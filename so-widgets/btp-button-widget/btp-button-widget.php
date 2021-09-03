<?php
/*
	Widget Name: BTP Button Widget
	Description: Button that opens a modal box.
	Author: Stephen Anil, Sputznik
	Author URI:	https://sputznik.com
	Widget URI:
	Video URI:
*/
class BTP_Button_Widget extends SiteOrigin_Widget {

	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'btp-button-widget',
			// The name of the widget for display purposes.
			__('BTP Button Widget', 'siteorigin-widgets'),
			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Button that opens a modal box.'),
				'help'        => '',
			),
			//The $control_options array, which is passed through to WP_Widget
			array(),
			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'modal_title' => array(
          'type'    => 'text',
          'label'   => __('Modal title','siteorigin-widgets'),
          'default' => '',
        ),
				'btn_text' => array(
          'type'    => 'text',
          'label'   => __('Button Text','siteorigin-widgets'),
          'default' => '',
        ),
				'image' => array(
					'type' 		=> 'media',
					'label' 	=> __( 'Choose Image', 'siteorigin-widgets' ),
					'choose' 	=> __( 'Choose image', 'siteorigin-widgets' ),
					'update' 	=> __( 'Set image', 'siteorigin-widgets' ),
					'library' 	=> 'image',
					'fallback' 	=> false
				),
				'description' => array(
					'type' => 'tinymce',
					'label' => __( 'Description', 'siteorigin-widgets' ),
					'default' => '',
					'rows' => 10,
					'default_editor' => 'tinymce'
				),

			),
			//The $base_folder path string.
			get_template_directory()."/so-widgets/btp-button-widget"
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
siteorigin_widget_register('btp-button-widget', __FILE__, 'BTP_Button_Widget');
