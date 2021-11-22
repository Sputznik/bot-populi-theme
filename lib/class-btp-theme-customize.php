<?php

class BTP_CUSTOMIZE {

  function __construct(){
    add_action( 'customize_register', [ $this, 'btp_customize_register' ] );
  }

  function btp_customize_register( $wp_customize ){

    $wp_customize->add_panel( 'btp_theme_panel', array(
      'priority' 		  => 30,
      'capability' 	  => 'edit_theme_options',
      'theme_supports'=> '',
      'title' 		    => 'Theme Options',
      'description' 	=> '',
    ) );

    // 404 TEMPLATE
    $wp_customize->add_section( 'btp_404_section' , array(
      'title'       	=> __( '404 Template', 'sp' ),
      'priority'    	=> 30,
      'description' 	=> 'Change 404 Template',
      'panel'			    => 'btp_theme_panel'
    ) );

    $wp_customize->add_setting( 'btp_theme[404_template]', array(
      'default' 		=> 'default',
      'transport'   => 'refresh',
      'type'			  => 'option'
    ) );

    $wp_customize->add_control( 'btp_theme[404_template]', array(
      'type' 		  => 'select',
      'label'    	=> '404 Template',
      'section'  	=> 'btp_404_section',
      'settings' 	=> 'btp_theme[404_template]',
      'choices' 	=> $this->get_error_template()
    ) );

  }

  // RETURNS ALL THE PUBLISHED PAGES FROM BACKEND
  function get_error_template(){

    $pages_list = array();
		$pages = get_pages( array('post_status'  => 'publish') );

		$pages_list['default'] = 'Default';

		foreach ( $pages as $page ) {
			$pages_list[$page->post_name] = $page->post_title;
		}

		return $pages_list;
	}

  function get_option(){

    return get_option( 'btp_theme' );

  }

}

global $btp_customize;

$btp_customize = new BTP_CUSTOMIZE;
