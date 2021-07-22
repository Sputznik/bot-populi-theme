<?php
    $logo = BTP_DIR_URI . '/assets/images/logo.png';
    $logo_mobile = BTP_DIR_URI . '/assets/images/logo-mobile.png';
?>

<nav class="navbar navbar-expand-md fixed-top" role="navigation">
    <button class="navbar-toggler" type="button" >
        <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand" href="<?php _e(home_url()); ?>"><img src="<?php _e($logo_mobile); ?>"></a>
    <?php
    $html = "<li class='li-close-btn'>&times;</li>";

    wp_nav_menu( [
        'menu'              => 'btp-header-menu',
        'theme_location'    => 'btp-header-menu',
        'depth'             => 2,
        'container'         => 'div',
        'container_class'   => 'collapse navbar-collapse d-flex justify-content-center btp-navbar-collapse',
        'container_id'      => '',
        'menu_class'        => 'navbar-nav ml-md-auto ml-lg-auto',
        'items_wrap'        => '<ul id="menu-header" class="%2$s">%3$s'.$html.'</ul>',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker(),
        ] );
    ?>
    <a href="#"><i class="fas fa-search"></i></a>
</nav>