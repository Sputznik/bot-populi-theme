<?php
    $logo = BTP_DIR_URI . '/assets/images/bp_without_tagline.png';
    $logo_large = BTP_DIR_URI . '/assets/images/bp_with_tagline.png';

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
    <a class="nav-search-item" href="#" data-toggle="modal" data-target="#searchModal"><ion-icon name="search-outline"></ion-icon></a>
  </div>
</nav>
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content vh-100">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h1 class="title mt-5">Search</h1>

        <form method="GET" action="<?php bloginfo('url');?>">
          <div class="row no-gutters">
            <div class="col">
              <input class="form-control border-right-0 rounded-0" name="s" placeholder="Enter search query">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="button">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
