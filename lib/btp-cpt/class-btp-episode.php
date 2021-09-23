<?php

/**
 * Registers custom post type for Episode.
 * Episode CPT is linked as child of Podcast CPT
 */
class BTP_EPISODE extends BTP_SINGLETON {

    public function __construct() {

        /* Creating Episode CPT using orbit-bundle plugin */
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
                'supports'	=> array( 'title', 'editor', 'thumbnail', 'author' )
            ];
            return $post_types;
        } );


        add_action( 'add_meta_boxes', [ $this, 'addMetaBoxCb' ] );

        add_action( 'save_post', array( $this, 'saveMetaBoxCb' ), 10, 1 );

    }


    /**
     * Callback for add_meta_boxes
     */
    public function addMetaBoxCb()
    {
        $fields = [];

        // attach meta fields callback that needs to be rendered
        $fields['btp-episode-fields'] = [$this, 'renderMetaFields'];

        //inject fields from other place
        $fields = apply_filters( 'btp-episode-meta-box-fields', $fields );

        add_meta_box( 'btp-episode-meta', 'Episode Information', [ $this, 'renderMetaBoxCb' ], ['episode'], 'normal', 'low', $fields );
    }


    /**
     * Set episode meta fields arguments here
     */
    public function episodeMetaFields()
    {
        return [
            [
              'label' => 'Hosted by',
              'key'   => 'btp_episode_host'
            ],
            [
              'label' => 'Episode Number',
              'key'   => 'btp_episode_number'
            ],

            [
              'label' => 'Episode Duration',
              'key'   => 'btp_episode_duration'
            ],

            [
              'label' => 'Episode Url (SoundCloud Embed code)',
              'key'   => 'btp_episode_url',
              'type'  => 'textarea',
            ],

        ];
    }


    /**
     * Helper function which is attached as callback for adding metabox field
     */
    public function renderMetaFields()
    {
        global $post;

        $fields = $this->episodeMetaFields();

        foreach ($fields as $meta) : ?>
            <div style='margin-bottom: 15px;'>
                <label> <?php echo $meta['label']?> </label>
                <?php if( isset($meta['type']) && 'textarea' == $meta['type'] ) { ?>
                    <textarea name="<?php echo $meta['key']?>" cols="30" rows="10"><?php echo get_post_meta($post->ID, $meta['key'], true);?></textarea>
                <?php } else { ?>
                    <input type="text" name="<?php echo $meta['key']?>" value="<?php echo get_post_meta($post->ID, $meta['key'], true)?>">
                <?php } ?>

            </div> <?php
        endforeach;

    }


    /**
     * Callback function for add_meta_box
     */
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


    /**
     * Callback function for save_post
     */
    public function saveMetaBoxCb( $post_id ){

        // Check if our nonce is set.
        if ( ! isset( $_POST['btp_meta_box_nonce'] ) ) return;

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['btp_meta_box_nonce'], 'btp_meta_box' ) ) return;

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        //save injected fields
        do_action( 'btp-episode-save-meta-box', $post_id );

        //save episode's fields
        $this->saveMetaFields($post_id);

    }


    /**
     * Helper function to persist episode meta fields
     */
    public function saveMetaFields($post_id)
    {
        $fields = $this->episodeMetaFields();

        foreach ($fields as $field) {
            $key = $field['key'];
            if( isset( $_POST[$key] ) ){
                update_post_meta($post_id, $key, $_POST[$key] );
            }
        }
    }

}

BTP_EPISODE::getInstance();
