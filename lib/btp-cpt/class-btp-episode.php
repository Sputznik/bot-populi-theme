<?php

/**
 * Registers custom post type (podcast's) Episode
 */
class BTP_EPISODE extends BTP_SINGLETON {

    public function __construct() {
        
        /* Creating cpt using orbit-bundle plugin */
        add_filter( 'orbit_post_type_vars', function( $post_types ){
            $post_types['episode'] = [
                'slug' 		=> 'episode',
                'labels'	=> [
                    'name' 	        => 'Episodes',
                    'singular_name' => 'Episode',
                    'add_new'       => 'Add New Episode',
                    'edit_item'		=> 'Edit Episode',
                    'add_new_item'  => 'Add New Episode',
                    'all_items'     =>  'All Episodes'
                ],
                'taxonomies'	=> [ 'category' ],
                'menu_icon' 	=> 'dashicons-video-alt3',
                'public'		=> true,
                'supports'	=> array( 'title', 'editor', 'thumbnail' )
            ];
            return $post_types;
        } );


        add_action('add_meta_boxes', [ $this, 'addMetaBoxCb' ]);

        add_action( 'save_post', array( $this, 'saveMetaBoxCb' ), 10, 1 );

    }

    public function addMetaBoxCb()      
    {
        $fields = apply_filters( 'btp-episode-meta-box-fields', [] );
        
        $fields['btp-episode-number'] = [$this, 'metaBoxFields'];
        
        add_meta_box( 'btp-episode-meta', 'Episode Information', [ $this, 'renderMetaBoxCb' ], ['episode'], 'normal', 'low', $fields );
    }

    public function metaBoxFields()
    {   
        global $post; 
        $meta_key = 'episode_number'; ?>
        <div style="margin-top: 20px;">
            <label> Episode Number </label>
            <input type="text" name="episode_number" value="<?php echo get_post_meta($post->ID, 'episode_number', true)?>"> 
        </div>    <?php
    }
    
    public function renderMetaBoxCb($post, $meta_box)
    {   ?>
        <div class="form-wrap">
           <div class="orbit-form-group field-text"> <?php
                wp_nonce_field( 'btp_meta_box', 'btp_meta_box_nonce' );
                
                if( isset( $meta_box['args' ] ) && is_array( $meta_box['args'] ) ){
                    foreach ($meta_box['args'] as $slug => $callback ) {
                        if( is_callable( $callback ) ){
                            call_user_func( $callback, $post );
                        }
                    }
                } ?>
           </div>
        </div> <?php
    }

    public function saveMetaBoxCb( $post_id ){
        
        // Check if our nonce is set.
        if ( ! isset( $_POST['btp_meta_box_nonce'] ) ) return;

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['btp_meta_box_nonce'], 'btp_meta_box' ) ) return;

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        do_action( 'btp-episode-save-meta-box', $post_id );

        $this->saveEpisodeNumberMeta($post_id);
        
    }

    public function saveEpisodeNumberMeta($post_id)
    {
        if( isset( $_POST['podcast_id'] ) ){
            update_post_meta($post_id, 'episode_number', $_POST['episode_number'] );
        }
    }


}

BTP_EPISODE::getInstance();