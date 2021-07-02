<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#btp-navbar-collapse-1" aria-controls="btp-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'bot-populi' ); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Bot Populi</a>
        <?php
        wp_nav_menu( [
            'menu'              => 'btp-header-menu',
            'theme_location'    => 'btp-header-menu',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse justify-content-end',
            'container_id'      => 'btp-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
            ] );
        ?>
    </div>
</nav>