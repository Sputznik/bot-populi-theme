<?php

/**
 * Main class
 */
class BTP_THEME extends BTP_SINGLETON {

    /**
     * class constructor
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'registerStylesCb' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'registerScriptsCb' ] );
        add_action( 'after_setup_theme', [ $this, 'afterSetupThemeCb' ] );
        
        // enqueue scripts for wp admin backend
        add_action( 'admin_enqueue_scripts', array( $this, 'adminScriptsCb' ) );


        // Post Summary metafield usign orbit-bundle plugin
		add_filter( 'orbit_meta_box_vars', function( $meta_box ){
			$meta_box['post'] = [
              [
                'id'		=> 'btp-post-metafields',
                'title'	=> 'Article Additional Information',
                'fields'	=> [
                    'btp_post_summary' => [
                    'type'      => 'textarea',
                    'text'      => 'Summary'
                    ],
                ]
              ]
            ];
			return $meta_box;
		});

    }


    /**
     * Callback Function for enequeing stylesheets
     */
    public function registerStylesCb()
    {
        // Register Styles
        wp_register_style('bootstrap', BTP_DIR_URI . '/assets/css/bootstrap.min.css', [], false, 'all');
        wp_register_style('font-awesome', BTP_DIR_URI . '/assets/css/font-awesome-5-15-3/css/all.min.css', false, null );
        wp_register_style('btp-style', BTP_DIR_URI . '/assets/css/style.css', ['bootstrap'], filemtime( BTP_DIR_PATH . '/assets/css/style.css' ), 'all');
        
        // Enqueue Styles
        wp_enqueue_style('bootstrap');
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('btp-style');
        
    }


    /**
     * Callback Function for enequeing scripts
     */
    public function registerScriptsCb()
    {
        //Register Scripts
        wp_register_script('bootstrap-script', BTP_DIR_URI . '/assets/js/bootstrap.bundle.min.js', ['jquery'], false, true);        
        wp_register_script('btp-script', BTP_DIR_URI . '/assets/js/main.js', [], filemtime( BTP_DIR_PATH . '/assets/js/main.js' ), true);

        
        //Enqueue Scripts
        wp_enqueue_script('bootstrap-script');
        wp_enqueue_script('btp-script'); 
    }
   

    /**
     * Callback function to enqueue scripts in wp dashboard 
     */
    public function adminScriptsCb($hook)
    {
        
        wp_enqueue_script(
            'btn-admin',
            BTP_DIR_URI .'/assets/js/admin.js',
            [ 'jquery', 'jquery-ui-autocomplete' ],
            1.0,
            true
        );
    }


    /**
     * Callback funciton for After Theme Setup hook
     */
    public function afterSetupThemeCb()
    {
        // Register Theme Menus 
        register_nav_menus( [
            'btp-header-menu' => esc_html__('Header Menu', 'bot-populi'),
            'btp-footer-menu' => esc_html__('Footer Menu', 'bot-populi'),
        ] );

        // Load Boostrap Navwalker class    
        require_once BTP_DIR_PATH . '/lib/class-wp-bootstrap-navwalker.php';

        // Register Theme Supports
        add_theme_support( 'post-thumbnails' );
        
    }


}

BTP_THEME::getInstance();