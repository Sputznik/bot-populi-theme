<?php
    $logo = BTP_DIR_URI . '/assets/images/logo.png';
?>

<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
    <a class="navbar-brand" href="#"><img src="<?php _e($logo); ?>"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#btp-navbarCollapse" aria-controls="btp-navbarCollapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'bot-populi' ); ?>">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php
    wp_nav_menu( [
        'menu'              => 'btp-header-menu',
        'theme_location'    => 'btp-header-menu',
        'depth'             => 2,
        'container'         => 'div',
        'container_class'   => 'collapse navbar-collapse',
        'container_id'      => 'btp-navbarCollapse',
        'menu_class'        => 'navbar-nav ml-auto',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker(),
        ] );
    ?>
</nav>