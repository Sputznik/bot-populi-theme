<?php

/**
 * Creates Custom Post Type for Videos
 */
class BTP_VIDEO extends BTP_SINGLETON {

    public function __construct() {
        
        /* Creating cpt using orbit-bundle plugin */
        add_filter( 'orbit_post_type_vars', function( $post_types ){
            $post_types['video'] = [
                'slug' 		=> 'video',
                'labels'	=> [
                    'name' 	        => 'Videos',
                    'singular_name' => 'Video',
                    'add_new'       => 'Add New Video',
                    'edit_item'		=> 'Edit Video',
                    'add_new_item'  => 'Add New Video',
                    'all_items'     =>  'All Videos'
                ],
                'taxonomies'	=> [ 'category' ],
                'menu_icon' 	=> 'dashicons-video-alt2',
                'public'		=> true,
                'supports'	=> array( 'title', 'editor', 'thumbnail' )
            ];
            return $post_types;
        } );


        // Vidoes metafields usign orbit-bundle plugin
		add_filter( 'orbit_meta_box_vars', function( $meta_box ){
			$meta_box['video'] = [
              [
                'id'		=> 'btp-video-metafields',
                'title'	=> 'Additional Information',
                'fields'	=> [
                    'btp_video_byline' => [
                        'type'      => 'text',
                        'text'      => 'Byline'
                    ],

                    'btp_video_url' => [
                        'type'      => 'textarea',
                        'text'      => 'Video Embed Code/URL'
                    ],
                ]
              ]
            ];
			return $meta_box;
		});
    }

}

BTP_VIDEO::getInstance();