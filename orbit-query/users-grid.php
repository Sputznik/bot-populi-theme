<?php global $orbit_templates; ?>
<ul class="btp-orbit users-grid list-unstyled">
  <?php foreach ($this->query->results as $user) : $orbit_templates->set_user($user); ?>
    <li>
      <a href="<?php _e(do_shortcode('[orbit_user field=url]')); ?>">
        <?php _e(do_shortcode('[orbit_user field=avatar avatar_size=320]')); ?>
        <div class='orbit-user-name'>
          <?php _e(do_shortcode('[orbit_user field=name]')); ?>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
</ul>