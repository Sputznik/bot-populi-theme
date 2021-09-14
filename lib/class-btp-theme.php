<?php

/**
 * Bootstraps theme specific functionalities
 */
class BTP_THEME extends BTP_SINGLETON {

    /**
     * class constructor
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueueScriptsCb' ] );
        add_action( 'after_setup_theme', [ $this, 'afterSetupThemeCb' ] );
        add_filter( 'document_title_separator', [ $this, 'documentTitleSeparator'] );
        add_action( 'widgets_init', [ $this, 'registerSidebars' ] );

        // enqueue scripts for wp admin backend
        add_action( 'admin_enqueue_scripts', array( $this, 'adminScriptsCb' ) );

        // update language_attributes for single page template
        add_filter( 'language_attributes', [$this, 'ogPrefix'] );

        // Post Summary metafield usign orbit-bundle plugin
		add_filter( 'orbit_meta_box_vars', function( $meta_box ){
			$meta_box['post'] = [
              [
                'id'		=> 'btp-post-metafields',
                'title'	=> 'Article Additional Information',
                'fields'	=> [
                    'btp_post_summary' => [
                    'type'      => 'rich_text',
                    'text'      => 'Summary'
                    ],
                ]
              ]
            ];
			return $meta_box;
		});

        /* ADD SOW FROM THE THEME */
        add_action('siteorigin_widgets_widget_folders', function( $folders ){
          $folders[] = get_template_directory() . '/so-widgets/';
          return $folders;
        });
        
    }


    /**
     * Callback Function for enequeing scripts & styles
     */
    public function enqueueScriptsCb()
    {
        // Register Styles
        wp_register_style('bootstrap', BTP_DIR_URI . '/assets/css/bootstrap.min.css', [], false, 'all');
        wp_register_style('font-awesome', BTP_DIR_URI . '/assets/css/font-awesome-5-15-3/css/all.min.css', false, null );
        wp_register_style('btp-style', BTP_DIR_URI . '/assets/css/style.css', ['bootstrap'], filemtime( BTP_DIR_PATH . '/assets/css/style.css' ), 'all');
        wp_register_style('btp-sow', BTP_DIR_URI . '/assets/css/sow.css', [], filemtime( BTP_DIR_PATH . '/assets/css/sow.css' ), 'all');

        // Enqueue Styles
        wp_enqueue_style('bootstrap');
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('btp-style');
        wp_enqueue_style('btp-sow');


        //Register Scripts
        wp_register_script('bootstrap-script', BTP_DIR_URI . '/assets/js/bootstrap.bundle.min.js', ['jquery'], false, true);
        wp_register_script('btp-script', BTP_DIR_URI . '/assets/js/main.js', [], filemtime( BTP_DIR_PATH . '/assets/js/main.js' ), true);
        wp_register_script('btp-image-popup', BTP_DIR_URI . '/assets/js/btp-image-popup.js', [], filemtime( BTP_DIR_PATH . '/assets/js/btp-image-popup.js' ), true);

        wp_localize_script( 'btp-script', 'btp_settings', [
            'ajax' => admin_url( 'admin-ajax.php' ),
            'logo' => [ 'medium' => BTP_DIR_URI . '/assets/images/bp_without_tagline.png',
                        'large' => BTP_DIR_URI . '/assets/images/bp_with_tagline.png',
                      ]
            ]
        );


        //Enqueue Scripts
        wp_enqueue_script('bootstrap-script');
        wp_enqueue_script('btp-script');
        wp_enqueue_script('btp-image-popup');
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
        add_theme_support( 'title-tag' );

        // Opting out of the block-based widgets editor
        remove_theme_support( 'widgets-block-editor' );

        // Hide admin bar
        show_admin_bar(false);

    }

    public function documentTitleSeparator( $sep )
    {
        $sep = "&raquo;";

        return $sep;
    }


    function registerSidebars() {
        register_sidebar(
            array(
                'id'            => 'footer-sidebar',
                'name'          => __( 'Footer Sidebar' ),
                'description'   => __( 'Content goes into site footer.' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );
    }

    /**
     * callback function for language_attributes filter
     */
    function ogPrefix( $attribute ) {
        if( is_single() ) {
            $attribute .= ' prefix="og: http://ogp.me/ns#"';
        }

        return $attribute;
    }


}

BTP_THEME::getInstance();
