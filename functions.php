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
];

foreach ($inc_files as $file_to_include ) {
    require_once( $file_to_include );
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
