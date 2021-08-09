<?php
    $logo = BTP_DIR_URI . '/assets/images/BP_without_tagline.png';
    $logo_large = BTP_DIR_URI . '/assets/images/BP_with_tagline.png';

?>
<nav class="navbar navbar-expand-md fixed-top" role="navigation">
  <div class="container">
    <button class="navbar-toggler" type="button" >
        <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand" href="<?php _e(home_url()); ?>">
        <img class="logo-large d-none d-md-block d-lg-block" src="<?php _e($logo_large); ?>">
        <img class="logo-mobile d-md-none d-lg-none d-xl-none" src="<?php _e($logo); ?>">

    </a>
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
    <a class="nav-search-item" href="#"><i class="fas fa-search"></i></a>
  </div>
</nav>
