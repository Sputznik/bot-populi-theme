<?php

/**
 * Adds custom fields into taxonmoy's create and edit screen
 */
class BTP_TAXONOMY_FIELD extends BTP_SINGLETON {

    public function __construct() {
        
        /* if inside WordPress administration interface page */
        if( is_admin() ) {

            add_action( 'admin_enqueue_scripts', [ $this, 'enqueueMediaScript' ] );

            /* Add field into category */
            add_action( 'category_add_form_fields', [ $this, 'categoryCreateScreen' ], 10, 1 );
            add_action( 'category_edit_form_fields', [ $this, 'categoryEditScreen' ], 10, 2  );

            // save custom fields for category
            add_action( 'created_category', [ $this, 'saveCategoryField' ], 10, 1 );
            add_action( 'edited_category', [ $this, 'updateCategoryField' ], 10, 1 );
        }

        /* Allow HTML in term (category, tag) descriptions */
        $this->allowHtmlInDescription();

    }

    /**
     * Callback function to enqueue wp media scripts
     */
    public function enqueueMediaScript()
    {
        wp_enqueue_media();
    }


    /**
     * Allow HTML in term (category, tag) descriptions
     */
    public function allowHtmlInDescription()
    {
        // prevents HTML from being stripped from term descriptions
        foreach ( array( 'pre_term_description' ) as $filter ) {
            remove_filter( $filter, 'wp_filter_kses' );
            if ( ! current_user_can( 'unfiltered_html' ) ) {
                add_filter( $filter, 'wp_filter_post_kses' );
            }
        }
        
        // prevents HTML being stripped out when using the term description function
        // foreach ( array( 'term_description' ) as $filter ) {
        //     remove_filter( $filter, 'wp_kses_data' );
        // }
    }


    /**
     * Callback function that renders field into Category Create Screen
     */
    public function categoryCreateScreen( $taxonomy )
    { ?>
        <div class="form-field" style="margin-top:35px">
            <div id="category-image-container" style="padding:0px 16px 10px 0px;"></div>
            <p>
                <a href="#" data-behaviour=btp-taxonomy-image class="btp_cat_image_btn button button-secondary"><?php _e('Set Featured Image'); ?></a>
                &nbsp; &nbsp;
                <a href="#" data-behaviour=btp-taxonomy-image class="btp_cat_image_delete" style="display:none"><?php _e('Remove Featured Image'); ?></a>
            </p>
            <input type="hidden" name="btp_category_image" id="btp_category_image" value="" />
        </div> <?php       
    }


    /**
     * Callback function that renders field into Category Edit Screen
     */
    public function categoryEditScreen( $term, $taxonomy )
    { ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
            <label for="btp_category_image">Featured Image</label>
            </th>
            <td>
            <?php $image_url = get_term_meta ( $term -> term_id, 'btp_category_image', true ); ?>
            <div id="category-image-container">
                <?php if ( $image_url ) : ?>
                    <img src="<?php _e( $image_url );?>" alt="cat_featured_img" style="max-width:100%">
                <?php endif; ?>
            </div>
            <p>
                <a href="#" data-behaviour=btp-taxonomy-image class="btp_cat_image_btn button button-secondary"><?php _e('Set Featured Image'); ?></a>
                &nbsp; &nbsp;
                <a href="#" data-behaviour=btp-taxonomy-image class="btp_cat_image_delete" style="<?php $image_url ? '' : _e('display:none');?>"><?php _e('Remove Featured Image'); ?></a>
                <input type="hidden" name="btp_category_image" id="btp_category_image" value="<?php $image_url ? _e($image_url) : '';?>" />
            </p>
            </td>
        </tr> <?php            
    }


    /**
     * Callback function for created_category hook
     */
    public function saveCategoryField( $term_id )
    {
        if( isset( $_POST['btp_category_image'] ) && '' !== $_POST['btp_category_image'] ){
            $image = $_POST['btp_category_image'];
            add_term_meta( $term_id, 'btp_category_image', $image, true);
        }
    }


    /**
     * Callback function for edited_category hook
     */
    public function updateCategoryField( $term_id )
    {
        if( isset( $_POST['btp_category_image'] ) && '' !== $_POST['btp_category_image'] ){
            $image = $_POST['btp_category_image'];
            update_term_meta( $term_id, 'btp_category_image', $image );
        } else {
            update_term_meta( $term_id, 'btp_category_image', '' );
        }
    }
}

BTP_TAXONOMY_FIELD::getInstance();