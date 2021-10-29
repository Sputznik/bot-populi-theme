<?php

/**
 * Register custom post type for Podcasts
 * Podcasts CPT serves as a parent for Episode CPT
 */
class BTP_PODCAST extends BTP_SINGLETON {

    public function __construct() {

        // hooks into episode cpt metabox
        add_filter( 'btp-episode-meta-box-fields', function( $fields ){
            $fields['btp-podcast'] = [ $this, 'renderMetaBox' ];
            return $fields;
        } );

        // hooks into episode save metabox
        add_action( 'btp-episode-save-meta-box', [ $this, 'saveEpisodeMetaBoxCb' ], 10, 1 );

        // resolves typeahead suggestion data
        add_action( 'wp_ajax_podcast_json', [ $this, 'getJson' ] );

        // creates Podacast CPT using Orbit Bundle Plugin
    	add_filter( 'orbit_post_type_vars', function( $post_types ){
            $post_types['podcast'] = array(
                  'slug' 		=> 'podcast',
                  'labels'	=> [
                      'name'          => 'Podcasts',
                      'singular_name' => 'Podcast',
                      'add_new'       => 'Add New Podcast',
                      'edit_item'	  => 'Edit Podcast Serie',
                      'add_new_item'  => 'Add New Podcast Series',
                      'all_items'     =>  'All Podcasts'
                  ],
                  'public'		=> true,
                  'menu_icon'   => 'dashicons-playlist-video',
                  'supports'	=> [ 'title', 'editor','thumbnail', 'author' ]
              );
            return $post_types;
        } );

        // Podcast metafield usign orbit-bundle plugin
		add_filter( 'orbit_meta_box_vars', function( $meta_box ){
			$meta_box['podcast'] = [
              [
                'id'		=> 'btp-podcast-metafields',
                'title'	    => 'Additional Information',
                'fields'	=> [
                    'btp_podcast_host' => [
                        'type'      => 'text',
                        'text'      => 'Hosted By'
                    ],
                    'btp_podcast_total_episodes' => [
                        'type'      => 'text',
                        'text'      => 'Number Of Episodes'
                    ],
                ]
              ]
            ];
			return $meta_box;
		});

    }


    /**
     * Callback function to display typeahed field for selecting Podcast Series
     */
    function renderMetaBox( $post ){
        $field = array(
            'label'              => 'Select Podcast Series ',
            'slug'	             => 'podcast_id',
            'value'	             => $post->post_parent,
            'placeholder'        => 'Type Series Title',
            'autocomplete_value' => $post->post_parent ? get_the_title( $post->post_parent ) : "",
            'url'	             => admin_url('admin-ajax.php?action=podcast_json')
        );

        echo "<div data-behaviour='btp-autocomplete' data-field='".wp_json_encode( $field )."'></div>";
    }


    /**
     * Returns Podcast Title as Json Array
     */
    function getJson(){
        global $wpdb;
        $search = $_GET['term'];
        $query = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_title LIKE '%".$search."%' AND post_type='podcast' ORDER BY post_title ASC LIMIT 0,10";
        $posts = array();
        foreach($wpdb->get_results($query) as $row){
            array_push( $posts, array( 'id' => $row->ID, 'value'=> $row->post_title ) );
        }
        wp_send_json( $posts );
    }


    /**
     * Callback function to save metabox value hooked in Episode CPT
     */
    public function saveEpisodeMetaBoxCb( $post_id )
    {
        if( isset( $_POST['podcast_id'] ) ){
            global $wpdb;
            $wpdb->update(
                $wpdb->posts,
                [ 'post_parent' => $_POST['podcast_id'] ],
                [ 'ID' => $post_id ],
                [ '%d' ],
                [ '%d' ]
            );
        }
    }

}

BTP_PODCAST::getInstance();
