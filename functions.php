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
    $atts['back_btn'] = '0';
    $atts['back_btn_title'] = '';
    $atts['back_btn_slug'] = '';
    return $atts;
});



function getCategories($post_id)
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
function getEpisodesList( $podcast_id ) {
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
