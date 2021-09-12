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


/**  
 * Add extra fields into orbit query attributes
 */
add_filter('orbit_query_atts', function( $atts ){
    $atts['button'] = '0';
    $atts['button_title'] = '';
    $atts['button_slug'] = '';
    $atts['posts_per_frame'] = 6;
    return $atts;
});


/**
 * Returns list of categories the post belongs to
 */
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


/** 
 * Reuturns list of videos exluding the currently passed id 
 */
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

/** RETURNS UNIQUE ID **/
function getUniqueID( $data ){
  return substr( md5( json_encode( $data ) ), 0, 8 );
}


/** 
 * Add og-meta tags on single post template 
 */
function btp_single_template_og_tags() {
    global $post;

    if( is_single() ) {

        $url     = get_post_permalink();
        $title   = get_the_title();     
        $image   = BTP_DIR_URI . '/assets/images/BP_with_tagline.png';
        $desc    = strip_shortcodes( strip_tags( $post->post_content) );
        $desc    = str_replace(array("\n", "\r", "\t"), ' ', $desc);   
        $desc    = substr( $desc, 0, 153) . '...';
        
        if( has_post_thumbnail($post->ID) ) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full', false)[0];
        }

        ob_start(); ?>
        <meta property="og:url" content="<?php _e($url); ?>">
        <meta property="og:title" content="<?php _e($title); ?>">
        <meta property="og:description" content="<?php _e($desc); ?>">
        <meta property="og:type" content="article">
        <meta property="og:image" content="<?php _e($image); ?>">
        <meta property="og:site_name" content="<?php bloginfo(); ?>">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:creator" content="@PopuliBot">
        <meta name="twitter:site" content="@PopuliBot">
        <meta name="twitter:url" content="<?php _e($url); ?>">
        <meta name="twitter:title" content="<?php _e($title); ?>">
        <meta name="twitter:description" content="<?php _e($desc); ?>">
        <meta name="twitter:image" content="<?php _e($image); ?>">
        
        <?php
        ob_end_flush();
    } else {
        return '';
    }
}
add_action('wp_head', 'btp_single_template_og_tags', 4);


/** 
 * Load facebook js sdk for sharing on single post template 
 */
add_action('wp_body_open', function(){ 
    if(is_single() ) {
     echo '
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0" nonce="lI5IEiFW"></script>
        ';
    };
});


/**
 * Return list of social share icons
 */
function btp_get_social_share_links( $aside = true ) { 
    global $post;

    $permalink  = get_the_permalink();
    $title      = get_the_title();
    $desc       = strip_shortcodes( strip_tags( $post->post_content) );
    $desc       = str_replace(array("\n", "\r", "\t"), ' ', $desc);   
    $desc       = substr( $desc, 0, 153) . '...'; 
    
    ob_start(); ?>
    <ul class="btp-social-icons list-unstyled <?php !$aside ? _e('list-inline') : ''; ?>">
        <!-- link -->
        <li class="<?php !$aside ? _e('list-inline-item ') : ''; ?>social-icon">
            <a href="<?php _e($permalink);?>" class="btp-copy-link"><i class="fas fa-link"></i></a>
        </li>
        <!-- facebook -->
        <li class="<?php !$aside ? _e('list-inline-item ') : ''; ?>social-icon" data-href="<?php _e($permalink);?>">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php _e($permalink);?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fab fa-facebook-f"></i></a>
        </li>
        <!-- email -->
        <li class="<?php !$aside ? _e('list-inline-item ') : ''; ?>social-icon">
            <a href="mailto:?&subject=<?php _e($title);?>&body=<?php _e($permalink);?>"><i class="far fa-envelope"></i></a>
        </li>
        <!-- twitter -->
        <li class="<?php !$aside ? _e('list-inline-item ') : ''; ?>social-icon">
            <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php _e($desc);?>&url=<?php _e($permalink);?>&via=PopuliBot"><i class="fab fa-twitter"></i></a>
        </li>
    </ul>
    <?php ob_end_flush();
}
