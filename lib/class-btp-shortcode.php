<?php

class BTP_SHORTCODE extends BTP_SINGLETON {
    public function __construct() {
        add_shortcode( 'btp_back_btn', [$this, 'btp_back_btn_cb'] );
    }


    public function btp_back_btn_cb($atts)
    {
        $args = shortcode_atts( array(
            'text'          => 'Go Back',
            'slug'           => '#',
            'outline_color' => '#9F00C5',
            'bg_color'      => 'transparent',
            'color'         => '#9F00C5'
        ), $atts );

        ob_start(); ?>

        <button class="btp-btn">
			<a href="<?php _e($args['slug']);?>"><?php _e($args['text']);?></a>
			<ion-icon name="arrow-back-outline"></ion-icon>
		</button>

        <?php return ob_end_flush();
    }
}

BTP_SHORTCODE::getInstance();
