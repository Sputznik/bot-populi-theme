<?php

/**
 * Define Constants
 */
if( !defined( 'BTP_DIR_PATH' ) ) {
    define( 'BTP_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if( !defined( 'BTP_DIR_URI' ) ) {
    define( 'BTP_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}


/**
 * Include Files
 */
$inc_files = [
    'lib/class-btp-singleton.php',
    'lib/class-btp-theme.php',
    'lib/btp-cpt/btp-cpt.php',
    'lib/class-btp-taxonomy-field.php',
    'lib/class-btp-shortcode.php',
];

foreach ($inc_files as $file_to_include ) {
    require_once( $file_to_include );
}


// ADD EXTRA FIELDS TO THE ORBIT QUERY ATTS
add_filter('orbit_query_atts', function( $atts ){
    $atts['button'] = '0';
    $atts['button_title'] = '';
    $atts['button_slug'] = '';
    $atts['posts_per_frame'] = 6;
    return $atts;
});



function btp_get_categories($post_id)
{
    $categories = get_the_category($post_id);

    if( $categories && count($categories)) {
        echo '<ul class="category-pills">';
        foreach ($categories as $cat) {
            echo '<li>'.$cat->name.'</li>';
        }
        echo '</ul>';
    }
}



/**
 * Helper function that dump and dies for debugging
 */
function dd($data, $die = true)
{
    echo "<pre>"; print_r($data); echo "</pre>";

    if( $die ) {
        wp_die();
    }

}


/**
 * Returns list of episodes for a given podcast series
 */
function btp_get_episodes_list( $podcast_id ) {
    if( ! $podcast_id ) {
        return false;
    }
    
    $episodes = get_children( [
        'post_parent' => $podcast_id,
        'order' => 'ASC',
    ], ARRAY_A );

    foreach ($episodes as $key => $episode) {
        $episodes[$key]['episode_number'] = get_post_meta($episode['ID'], 'btp_episode_number', true);
    }

    return $episodes;
}

/** Reuturns list of videos exluding the currently passed id */
function btp_get_videos( $id ) {   
    
    $args = [
        'post_type' => 'video',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'post__not_in' => [$id],
    ];

    $query = new WP_Query($args);

    if( isset($query->posts) ) {
        return $query->posts;
    }

    return [];
    
}
